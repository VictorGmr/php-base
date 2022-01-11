<?php

namespace Modules\AuthFortify\Providers;

use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Features;
use Livewire\Livewire;
use Modules\AuthFortify\Actions\Fortify\CreateCompanySession;
use Modules\AuthFortify\Actions\Fortify\CreateNewUser;
use Modules\AuthFortify\Actions\Fortify\ResetUserPassword;
use Modules\AuthFortify\Actions\Fortify\UpdateUserPassword;
use Modules\AuthFortify\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\FortifyServiceProvider;
use Modules\AuthFortify\Entities\User;

class AuthFortifyServiceProvider extends FortifyServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'AuthFortify';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'authfortify';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        //$this->registerLivewireComponents();

        if (class_exists('Breadcrumbs')) {
            require module_path($this->moduleName, 'Breadcrumbs').'/user.php';
        }

        /**
         * Fortify
         */
        Fortify::ignoreRoutes();
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        /**
         * authenticateThrough
         */
        Fortify::authenticateThrough(function (Request $request) {
            return array_filter([
                config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
                Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
                CreateCompanySession::class,
            ]);
        });

        /**
         * authenticateUsing
         */

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->active &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        /**
         * Views
         */
        Fortify::loginView(function () {
            return view('authfortify::auth.login');
        });

        Fortify::registerView(function () {
            return view('midone.login.register');
        });

        Fortify::twoFactorChallengeView(function () {
            return view('authfortify::auth.two-factor-challenge');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('authfortify::auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('authfortify::auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function () {
            return view('authfortify::auth.verify-email');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    public function registerLivewireComponents()
    {
        foreach (config('authfortify.livewire') as $livewire) {
            Livewire::component('authfortify::'.$livewire['alias'], $livewire['class']);
        }
    }
}
