<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 15:43
 */

namespace App\Modules\Traits;

/**
 * Class ProviderCoreMethods
 *
 * @package App\Modules\Traits
 */
trait ProviderCoreMethods
{
    /**
     * Inclui o arquivo de rotas
     * @param $module
     * @return void
     */
    final private function setFileRoute($module)
    {
        /* @var string $file */
        $file = app_path() . "/Modules/" . ucwords($module) . "/routes.php";

        if(is_file($file))
        {
            include_once $file;
        }
    }


    /**
     * Inclui o arquivo de constantes
     * @param $module
     * @return void
     */
    final private function setFileConstants($module)
    {

        /* @var string $dir */
        $dir =  app_path() . "/Modules/" . ucwords($module) . "/Http/Constants";

        foreach(glob("{$dir}/*.php") as $file)
        {
            if(is_file($file))
            {
                include_once $file;
            }
        }
    }

    /**
     * Seta as constantes padrão
     */
    final private function setDefaultConstants()
    {
        /* @var string $file */
        $file =  app_path() . "/Modules/Constants/default.php";

        if(is_file($file))
        {
            include_once $file;
        }
    }

    /**
     * @param $modules
     */
    final private function loadKernel($modules)
    {
        foreach($modules as $module)
        {
            /* @var string $file  */
            $file =  app_path() . "/Modules/" . ucwords($module) . "/Kernel.php";
            if(is_file($file))
            {
                $Kernel =  "\\App\\Modules\\".ucwords($module)."\\Kernel";
                $this->app->singleton(\Illuminate\Contracts\Http\Kernel::class, $Kernel);
            }
        }
    }
}