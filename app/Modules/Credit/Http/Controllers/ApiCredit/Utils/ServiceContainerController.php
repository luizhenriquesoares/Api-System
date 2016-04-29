<?php

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Utils;

use App\Modules\Credit\Http\Controllers\Controller;
use App\Modules\Models\Api;

/**
 * Class ServiceContainerController
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Utils
 */
class ServiceContainerController extends Controller
{
    protected $api;
    /**
     * ServiceContainerController constructor.
     * @param Api $api
     */
    public function __construct(Api $api)
    {
        $this->api = $api;
    }
    /**
     *  Método para Setar as Variáveis de Configuração da APICredit
     */
    public function setConfig()
    {
        $data = $this->api->getApi();
    }
    /**
     * Constantes Para Configuração
     */
    const ASSERTIVACOMPANY  = 'PSV-TURISMO';
    const ASSERTIVAUSER     = 'PSV-WS';
    const ASSERTIVAPASSWORD = 'elomilhas@2016';
    const ASSERTIVA         = 'http://portal.assertivasolucoes.com.br/api/1.0.0/localize/json/pf';
   
}