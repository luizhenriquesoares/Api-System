<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:08
 */

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Types;

use App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiCredit\Traits\ApiTrait;
use App\Modules\Test\Credit\Http\Controllers\Controller;

/**
 * Class AssertivaController
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Types
 */
class AssertivaController extends Controller implements ApiInterface
{
    use ApiTrait;
    /**
     * @param $data
     * @return mixed
     * Fazer uma nova consulta na api Assertiva e retorna json
     */
    public function newConsultSimple($data)
    {
       /* $result = new \stdClass();
        $result->cpf  = "101.808.704-40";
        $result->name = "Luiz Henrique Soares";
        $result->data = '23/03/1991';
        $result->signo ='Touro';
        $result->sexo = "Masculino";
        $result->mae  = "Monica Maria Brito Botelho";
        $result->rg   = "454544";
        $result->telFixo1 = "(81)3432-3911";
        $result->telFixo2 = "(81)3432-3232";
        $result->telFixo3 = "(81)3432-3232";
        $result->telFixo4 = "(81)3432-3232";
        $result->logradouro = "Rua Maria da Conceição Viana, N1360";
        $result->complemento = "apt 202";
        $result->bairro = "Jardim Atlãntico";
        $result->cidade = "Olinda";
        $result->uf = "PE";
        $result->cep = "53050-110";
        $result->email1 = "luizhenriquesoares91@gmail.com";
        $result->email2 = "luizhenrique0377@outlook.com";
        $result->email3 = "luizhenrique0377@outlook.com";
        $result->email4 = "luizhenrique0377@outlook.com";
        $result->profissao = 'Analista de Sistemas';
        $result->empresa = "PSV Turismo";
        $result->renda = "Até 2 SM";
        $result->created_at = date("Y-m-d H:i:s");
        $result->updated_at = date("Y-m-d H:i:s");

        return $result;*/

        $Assertiva = $this->getRequest($data);
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