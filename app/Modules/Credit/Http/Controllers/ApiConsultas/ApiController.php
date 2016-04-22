<?php

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiConsultas\Traits\ApiTrait;
use Illuminate\Routing\Controller;


abstract class ApiController extends Controller implements ApiInterface
{
    /**
     * @var $assertiva
     */
    private $assertiva;

    /**
     * @var $crm
     */
    private $crm;

    use ApiTrait;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $assertiva = ServiceContainerController::inicializationAssertiva();
        $crm       = ServiceContainerController::inicializationCRM();

    }

}