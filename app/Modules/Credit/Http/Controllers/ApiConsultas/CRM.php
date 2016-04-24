<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:11
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiConsultas\Traits\CRMTrait;
use App\Modules\CRM\Modules\CRM\Http\Controllers\Controller;


class CRM extends Controller implements ApiInterface
{
    use CRMTrait;
    /**
     * @param $data
     * @return mixed
     * Fazer uma nova consulta na api CRM e retorna json
     */
    public function newConsultSimple($data)
    {
        $CRM        = $this->getCRM($data);
        $itemCRM    = json_decode($CRM);
        return $itemCRM;
    }
    /**
     * @param $CRM
     * @return mixed
     * Método que retorna o tratamento dos dados, envia para o processamento de validação
     */
    public function dataProcessing($CRM)
    {
        $CRM->name          = strtoupper($CRM->name);
        $CRM->profissao     = strtoupper($CRM->profissao);
        $CRM->name          = trim($CRM->name);
        $CRM->profissao     = trim($CRM->profissao);
        $CRM->name          = ltrim ($CRM->name);
        $CRM->profissao     = ltrim ($CRM->profissao);

        return $CRM;
    }


}