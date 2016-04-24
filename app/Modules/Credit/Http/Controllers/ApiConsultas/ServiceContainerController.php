<?php


namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use Illuminate\Routing\Controller;

class ServiceContainerController extends Controller
{
    const ASSERTIVACOMPANY  = 'PSV-TURISMO';
    const ASSERTIVAUSER     = 'PSV-WS';
    const ASSERTIVAPASSWORD = 'elomilhas@2016';

    const CRMCOMPANY     =   '';
    const CRMUSER        =   '';
    const CRMPASSWORD    =   '';

    /*const ASSERTIVA         = 'http://portal.assertivasolucoes.com.br/api/1.0.0/localize/json/pf?';
    const SERASA            = '';*/

    const ASSERTIVA         = 'http://localhost/Estudos/TestarApi/public/api/assertiva/';
    const CRM               = 'http://localhost/Estudos/TestarApi/public/api/serasa/';

    
}