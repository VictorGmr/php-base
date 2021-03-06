<?php


namespace Modules\Core\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Livewire;
use Nwidart\Modules\Facades\Module;
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;

class LivewireComponentServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerModuleComponents();

        $this->registerCustomModuleComponents();
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

    protected function registerModuleComponents()
    {
        $modules = Module::toCollection();
        $modulesLivewireNamespace = 'Http\\Livewire';

        $modules->each(function ($module) use ($modulesLivewireNamespace) {
            $directory = (string)Str::of($module->getPath())
                ->append('/' . $modulesLivewireNamespace)
                ->replace(['\\'], '/');

            $namespace = 'Modules' . '\\' . $module->getName() . '\\' . $modulesLivewireNamespace;
            $this->registerComponentDirectory($directory, $namespace, $module->getLowerName() . '::');
        });
    }

    protected function registerCustomModuleComponents()
    {
        $modules = collect([]);

        $modules->each(function ($module, $moduleName) {
            $moduleLivewireNamespace = $module['namespace'] ?? 'Http\\Livewire';

            $directory = (string)Str::of($module['path'] ?? '')
                ->append('/' . $moduleLivewireNamespace)
                ->replace(['\\'], '/');

            $namespace = ($module['module_namespace'] ?? $moduleName) . '\\' . $moduleLivewireNamespace;

            $lowerName = $module['name_lower'] ?? strtolower($moduleName);

            $this->registerComponentDirectory($directory, $namespace, $lowerName . '::');
        });
    }

    protected function registerComponentDirectory($directory, $namespace, $aliasPrefix = '')
    {
        $filesystem = new Filesystem();

        if (!$filesystem->isDirectory($directory)) {
            return false;
        }

        collect($filesystem->allFiles($directory))
            ->map(function (SplFileInfo $file) use ($namespace) {
                return (string)Str::of($namespace)
                    ->append('\\', $file->getRelativePathname())
                    ->replace(['/', '.php'], ['\\', '']);
            })
            ->filter(function ($class) {
                return is_subclass_of($class, Component::class) && !(new ReflectionClass($class))->isAbstract();
            })
            ->each(function ($class) use ($namespace, $aliasPrefix) {
                $alias = $aliasPrefix . Str::of($class)
                        ->after($namespace . '\\')
                        ->replace(['/', '\\'], '.')
                        ->explode('.')
                        ->map([Str::class, 'kebab'])
                        ->implode('.');

                Livewire::component($alias, $class);
            });
    }
}
