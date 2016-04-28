<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 13:55
 */

namespace App\Modules\Traits;

/**
 * Class GettersSetters
 *
 * @package App\Modules\Traits
 */
trait GettersSetters
{
    /**
     * Obtém o nome do módulo
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Obtém o model setado no controller
     * @return mixed
     */
    public function getModelController()
    {
        return $this->model;
    }

}