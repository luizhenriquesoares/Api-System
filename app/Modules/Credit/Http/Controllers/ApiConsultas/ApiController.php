<?php

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiConsultas\Traits\ApiTrait;
use Illuminate\Routing\Controller;


abstract class ApiController extends Controller implements ApiInterface
{

    private $assertiva;

    private $serasa;

    use ApiTrait;

    public function __construct()
    {
        $assertiva = ServiceContainerController::inicializationAssertiva();
        $serasa    = ServiceContainerController::inicializationSerasa();

    }

}