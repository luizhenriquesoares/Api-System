<?php


namespace App\Modules\Credit\Http\Controllers\ApiConsultas;


use GuzzleHttp\Client;
use Illuminate\Routing\Controller;

class ServiceContainerController extends Controller
{
    const ASSERTIVACOMPANY  = 'PSV-TURISMO';
    const ASSERTIVAUSER     = 'PSV-WS';
    const ASSERTIVAPASSWORD = 'elomilhas@2016';

    const CRMCOMPANY     =   '';
    const CRMUSER        =   '';
    const CRMPASSWORD    =   '';

<<<<<<< HEAD
    const ASSERTIVA         = 'http://portal.assertivasolucoes.com.br/api/1.0.0/localize/json/pf?';
    const SERASA            = 'http://portal.assertivasolucoes.com.br/api/v2/credito/json/simples/pf';
=======
    /*const ASSERTIVA         = 'http://portal.assertivasolucoes.com.br/api/1.0.0/localize/json/pf?';
    const SERASA            = '';*/

    const ASSERTIVA         = 'http://localhost/dev-luiz/Estudos/TestarApi/public/api/assertiva/';
    const CRM               = 'http://localhost/dev-luiz/Estudos/TestarApi/public/api/serasa/';
>>>>>>> funcionalidade


    public static function inicializationAssertiva()
    {
        $assertiva = new Client([
            'base_url' => self::ASSERTIVA,
            'timeout' => 60,
        ]);
    }

    public static function inicializationCRM()
    {
        $crm = new Client([
            'base_url' => self::CRM,
            'timeout' => 60,
        ]);
    }
    
}