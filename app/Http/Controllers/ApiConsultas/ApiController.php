<?php

namespace App\Http\Controllers\ApiConsultas;

use App\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Http\Controllers\ApiConsultas\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

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