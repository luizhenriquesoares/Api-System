<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:11
 */

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Types;

use App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces\ApiInterface;
use App\Modules\Credit\Http\Controllers\ApiCredit\Traits\CRMTrait;
use App\Modules\CRM\Modules\CRM\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * Class CRMController
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Types
 */
class CRMController extends Controller implements ApiInterface
{
    use CRMTrait;
    /**
     * @param $data
     * @return mixed
     * Faz uma consulta no banco de dados do CRM e retorna
     * dados do cliente
     */
    public function newConsultSimple($data)
    {
        $result = DB::table('elomilhas.providers')
            ->join('users', 'created_by',  '=', 'users.id')
            ->select('*')
            ->where(['cpf' => $data])->first();
        if($result) {
            dd($result);
        }
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