<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:28
 */

namespace App\Modules\Traits;


use App\Modules\Composers\ComposeShare;
use App\Modules\Home\Http\Traits\Auth\UserData;

/**
 * Class Helper
 *
 * @package App\Modules\Traits
 */
trait Helper
{
    /**
     * @var UserData
     */
    use UserData;

    /**
     * Carrega as configurações do projeto
     */

    protected function loadProjectConfig()
    {
        if(method_exists($this, 'getRouter') && ($this->getRouter()->getCurrentRoute()))
        {
            $getRoute           = $this->getRouter()->getCurrentRoute()->getActionName();
            $currentRoute       = explode("\\", $getRoute);
            $module             = (string) $currentRoute[2];
            $currentRoute       = explode("@", end($currentRoute));

            $controller         = strtolower(str_replace("Controller", "", $currentRoute[0]));
            $action             = end($currentRoute);

            $this->route        = (object) $currentRoute;
            $this->controller   = $controller;
            $this->action       = $action;
            $this->module       = ($module == "Controllers") ? "" : $module;
            $this->page         = "{$this->module}::{$controller}.{$action}";
            $this->layout       = "{$this->module}::{$this->layout}";
            $this->base         = "{$this->module}::";
            $this->routeAlias   = strtolower($this->module) . ".{$controller}.{$action}";
            $this->parent       = (is_null($this->parent)) ? NULL : $this->parent;
            $this->hasParent    = false;


            /** Inicia as page metas */
            $this->pageMeta = ['title' => 'Default', 'description' => 'default'];

            /** Inicia o carregamento de classes pais */
            $this->_initParent();

            return $this;
        }
    }

	protected function setViewVariables($properties = [])
    {

        if(\Session::has('properties') && (boolean) count($properties) === false)
	    {
		    $properties = \Session::get('properties');
	    }

	    $this->helper =   (object) [
									    'layout'        => $this->layout,
									    'module'        => $this->module,
									    'controller'    => $this->controller,
									    'action'        => $this->action,
									    'namespace'     => $this->namespace,
									    'route'         => $this->route,
									    'page'          => $this->page,
									    'base'          => $this->base,
                                        'routeAlias'    => $this->routeAlias,
                                        'parent'        => $this->parent,
									    'actionTable'   => strtolower($this->module.'.'.$this->controller),
                                        'hasParent'     => $this->hasParent,
									    'properties'    =>  $properties
								    ];

        ComposeShare::compose('helper', $this->helper);
    }

    /**
     * @param $string
     * @return string
     */

    final private function organizeString($string)
    {
        if(strripos($string, "::") >= 0)
        {
            return (string) str_replace("::", "", $string);
        }
        return $string;
    }

    /**
     * @param array $attr
     */
    protected function setViewHelperNewProperties(Array $attr = array())
    {
        $this->helper->properties = $attr;
        ComposeShare::compose('helper', $this->helper);
    }

    /**
     * Carrega as configurações da class parent setada
     */
    protected function _initParent()
    {
        //dd($this->parent);
        if(!is_null($this->parent))
        {
            $class              = explode('\\', $this->parent);
            $this->parent       = str_replace('controller', '', strtolower(end($class)));
            $this->page         = "{$this->module}::{$this->parent}.{$this->controller}.{$this->action}";
            $this->routeAlias   = strtolower($this->module) . ".{$this->parent}.{$this->controller}.{$this->action}";
            $this->hasParent     = true;
        }
    }
}