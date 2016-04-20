<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 19/01/16
 * Time: 08:17
 */

namespace App\Modules\Providers;

use Illuminate\Support\ServiceProvider;

class ComposeServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */

    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     *  Compor a navegaçao
     */

    public function composeNavigation()
    {
        $modules = config('module.modules');

        foreach($modules as $module)
            view()->composer("{$module}::layouts.default", 'App\Modules\Composers\ComposerShare');
    }
}