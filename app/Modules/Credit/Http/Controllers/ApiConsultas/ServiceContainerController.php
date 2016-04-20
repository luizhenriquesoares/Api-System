<?php


namespace App\Modules\Credit\Http\Controllers\ApiConsultas;


use GuzzleHttp\Client;
use Illuminate\Routing\Controller;

class ServiceContainerController extends Controller
{
    const ASSERTIVACOMPANY  = 'PSV-TURISMO';
    const ASSERTIVAUSER     = 'PSV-WS';
    const ASSERTIVAPASSWORD = 'elomilhas@2016';

    const SERASACOMPANY     = 'PSV-TURISMO';
    const SERASAUSER        =  'PSV-WS';
    const SERASAPASSWORD    = 'elomilhas@2016';

    const ASSERTIVA         = 'http://portal.assertivasolucoes.com.br/api/1.0.0/localize/json/pf?';
    const SERASA            = 'http://portal.assertivasolucoes.com.br/api/v2/credito/json/simples/pf';


    public static function inicializationAssertiva()
    {
        $assertiva = new Client([
            'base_url' => self::ASSERTIVA,
            'timeout' => 60,
        ]);
    }

    public static function inicializationSerasa()
    {
        $serasa = new Client([
            'base_url' => self::SERASA,
            'timeout' => 60,
        ]);
    }
    
}