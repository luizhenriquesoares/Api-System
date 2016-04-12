<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:45
 */

namespace App\Modules;

use App\Modules\Traits\Behaviors;
use App\Modules\Traits\ProviderCoreMethods;
use Illuminate\Routing\Controller;
use Illuminate\Support\ServiceProvider;

/**
 * Class ModulesServiceProvider
 * @package App\Modules
 */
class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Traits provider e behaviors
     * @var Traits\ProviderCoreMethods | Traits\Behaviors
     */

    use ProviderCoreMethods, Behaviors;

    /**
     * Register the service provider.
     * @return void
     */

    public function register()
    {
        $modules    =   config("modules.module");
        foreach($modules as $module)
        {
            $this->app->bind('App\\Modules\\' . ucwords($module));
            $this->setFileRoute($module);
            $this->loadViewsFrom(__DIR__  . "/" . ucwords($module) . "/Http/Scripts/Views", $module);
        }
    }

    /**
     * Booting, inicia o provider.
     */

    public function boot()
    {
        /** @var array $modules */
        $modules        =   config('modules.module');

        /** Carrega o kernel do módulo */
        $this->loadKernel($modules);

        /**
         * @var $app AbstractModulesController
         */
        $this->app->afterResolving(Controller::class, function($app) use ($modules)
        {
            if(method_exists($app, 'getModule'))
            {
                foreach($modules as $module)
                {
                    if(is_null($app->getModule()))
                        $this->setDefaultConstants();

                    if($app->getModule() === $module)
                        $this->setFileConstants($module);
                }

                /** Quando uma pesquisa for realizada, o contador inicia */
                $this->countSearchs();

                /** Inicia logs de acordo com a configuração ativada no .env para LOGGING_MANAGER */
                $this->logging($app);
            }
        });
    }

    /**
     * @param      $app
     */
    private function logging($app)
    {
        /** @var boolean $isActive .env file */
        $isActive = (boolean) env('LOGGING_MANAGER');

        if($isActive)
        {
            if(method_exists($app, 'getModelController') && property_exists($app, 'model'))
            {
                /** @var AbstractModulesModel $model */
                $model = $app->getModelController();

                $model::created(function($model)
                {
                    \Auth::user()->authorizations()->create(['fk_id' => $model->id, 'table' => $model->getTable(), 'action' => 'store']);
                });

                $model::updated(function($model)
                {
                    \Auth::user()->authorizations()->create(['fk_id' => $model->id, 'table' => $model->getTable(), 'action' => 'update']);
                });

                $model::deleted(function($model)
                {
                    \Auth::user()->authorizations()->create(['fk_id' => $model->id, 'table' => $model->getTable(), 'action' => 'delete']);
                });

                $model::restored(function($model)
                {
                    \Auth::user()->authorizations()->create(['fk_id' => $model->id, 'table' => $model->getTable(), 'action' => 'restore']);
                });
            }
        }
    }
}
