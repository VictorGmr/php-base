<?php

namespace Modules\SystemConfig\View\Composers;

use Modules\SystemConfig\Faker;
use Illuminate\View\View;

class LoggedInUserComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('loggedin_user', request()->user());
    }
}
