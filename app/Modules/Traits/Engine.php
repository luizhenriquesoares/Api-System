<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 13:50
 */

namespace App\Modules\Traits;

use App\Modules\Models\Search;
use App\Modules\Home\Http\Traits\Utils\FlashMessages;

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
    use Attributes, Helper, GettersSetters, FlashMessages;

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

        $this->middleware('auth');

        /**
         * Compartilhar informações do usuário entre as views
         *
         * @use UserData
         */
        $this->shareData();

        /**
         * @var $this->search Search
         */
        $this->search       = new Search();

        /**
         * Obtenção do código de busca
         */
        $this->searchCode   =   \Session::get('searchs_id');

        /**
         * Captura e salva dados de acesso do cliente
         */
        //$this->getClientData();
    }
}