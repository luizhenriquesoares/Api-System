<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 13:53
 */

namespace App\Modules\Traits;


use App\Modules\Models\Search;

/**
 * Class Attributes
 *
 * @package App\Modules\Traits
 */
trait Attributes
{

    /**
     * Módulo atualmente inicializado
     * @var String $module
     */

    protected $module;

    /**
     * Controlador atualmente carregado
     * @var String $controller
     */

    protected $controller;

    /**
     * Ação atualmente carregada
     * @var String $action
     */

    protected $action;

    /**
     * Classe pai de alguma classe adjacente
     * @var String $parent
     */
    protected $parent;

    /**
     * Layout utilizado
     * @var String $layout layout.default
     */

    protected $layout = 'layouts.default';

    /**
     * Namespace do arquivo atual
     * @var String $namespace
     */

    protected $namespace;

    /**
     * Rota atual
     * @var String $route
     */

    protected $route;

    /**
     * Página atual
     * @var String $page
     */

    protected $page;

    /**
     * Meta dados da página
     * @var String $pageMeta
     */

    protected $pageMeta;

    /**
     * Base do modulo
     * @var String $base Module::
     */
    protected $base;

    /**
     * Modelo de busca
     * @var $search Search
     */
    protected $search;

    /**
     * Código de busca
     * @var integer
     */
    protected $searchCode;

    /**
     * Helper data
     * @var \stdClass
     */
    protected $helper;

    /**
     * Alias da rota
     * @var $routeAlias
     */
    protected $routeAlias;

    /**
     * Se há parent
     * @var boolean $hasParent
     */
    protected $hasParent;

    /**
     * Se possui acesso ao manager
     * @var boolean $manager
     */
    protected $manager;
}