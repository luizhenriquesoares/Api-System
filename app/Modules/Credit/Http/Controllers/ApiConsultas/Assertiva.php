<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:08
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiConsultas\Traits\AssertivaTrait;
use App\Modules\Test\Credit\Http\Controllers\Controller;


class Assertiva extends Controller implements ApiInterface
{
    use AssertivaTrait;
    /**
     * @param $data
     * @return mixed
     * Fazer uma nova consulta na api Assertiva e retorna json
     */
    public function newConsultSimple($data)
    {
        $Assertiva = $this->getAssertiva($data);
        $itemAssertiva = json_decode($Assertiva);
        return $itemAssertiva;
    }

    /**
     * @param $Assertiva
     * @return mixed
     * Método que retorna o tratamento dos dados, envia para o processamento de validação
     */
    public function dataProcessing($Assertiva)
    {
        $Assertiva->name = strtoupper($Assertiva->name);
        $Assertiva->profissao = strtoupper($Assertiva->profissao);
        $Assertiva->name = trim($Assertiva->name);
        $Assertiva->profissao = trim($Assertiva->profissao);
        $Assertiva->name = ltrim($Assertiva->name);
        $Assertiva->profissao = ltrim($Assertiva->profissao);

        return $Assertiva;
    }

}