<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 13:50
 */

namespace App\Modules\Traits;

/**
 * Class Engine
 *
 * @package App\Modules\Traits
 */
trait Engine
{
    /**
     * Traits
     */
    use Attributes, Helper, GettersSetters;

    /**
     * Initializing data information
     */
    public function init()
    {
        /**
         * Carrega um conjunto de configurações essênciais
         * para o funcionamento do projeto
         *
         * @global $this Helper
         */

         $this->loadProjectConfig();

        /**
         * Envia para as views um conjunto de variáveis
         * que irão auxiliar no endereçamento do projeto
         *
         * @global $this Helper
         */

        $this->setViewVariables();

        /**
         * Middleware de Autenticação
         */

        $this->middleware('auth.apiManager');
    }
}