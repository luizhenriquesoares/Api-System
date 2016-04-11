<?php


namespace App\Http\Controllers\ApiConsultas;

use App\Consult;
use App\Http\Controllers\ApiConsultas\Interfaces\ConsultInterface;
use App\Http\Controllers\Controller;

class ConsultController extends Controller implements ConsultInterface
{
    private $consult;

    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }

    public function getConsultSimplesPF($data)
    {
        $data = $this->consult->getConsult($data);

        return $data;

    }
}