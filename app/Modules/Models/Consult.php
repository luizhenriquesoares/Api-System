<?php
namespace App\Modules\Models;

use App\Modules\Credit\Http\Controllers\ApiConsultas\ApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Empty_;

class Consult extends Model
{
    protected $table = 'test_consult';

    protected $fillable = [
        'cpf',
        'name',
        'idade',
        'profissao',
        'created_at',
        'updated_at'
    ];
<<<<<<< HEAD

=======
>>>>>>> funcionalidade
    /**
     * @param $data Pegar dados se Cpf Existir no banco
     */
    public function getCpf($data)
    {
        $earliestdate = DB::table('test_consult')
            ->select('*')
            ->where(['cpf' => $data])->get();
    }
    /**
     * @param $data
     * @return \Closure
     * Salva ou Atualiza os dados da consulta no Banco de Dados
     */
    public function saveOrUpdate($data)
    {
        return function($result) use ($data) {
            if($this->getCpf($data)) {
                $update  = Consult::update($result);
            } else {
                $create  = Consult::create($result);
            }
        };
    }
    /**
     * @param $data
     * @return mixed
     * Se for maior que 6 meses faz uma nova consulta
     */
    public function getMonths($data)
    {
        $mostDate  = DB::table('test_consult')
            ->select('*')
            ->where('cpf', '=', $data)
            ->having('updated_at', '>=' , new \DateTime('-6 months'))
            ->get();
        if($mostDate) {
            return $mostDate;
        }
    }
    /**
     * @param $data
     * @return mixed
     * Pegar consulta se CPF existe na base dados
     */
    public function getConsultDB($data)
    {
        $earliestdate = DB::table('test_consult')
            ->select('*')
            ->where(['cpf' => $data])->get();

        if($earliestdate) {
            return $earliestdate;
        }
    }
    /**
     * @param $data
     * @return mixed
     * Fazer uma nova consulta na api Assertiva e retorna json
     */
<<<<<<< HEAD
    public function newConsultSimplesAssertiva($data)
=======
    public static function newConsultSimplesAssertiva($data)
>>>>>>> funcionalidade
    {
        $Assertiva     = ApiController::getAssertiva($data);
        $itemAssertiva = json_decode($Assertiva);
        return $itemAssertiva;
    }
    /**
     * @param $data
     * @return
<<<<<<< HEAD
     * mixed Fazer uma nova consulta na api Serasa e retorna json
     */
    public function newConsultSimplesSerasa($data)
=======
     * mixed Fazer uma nova consulta na api CRM e retorna json
     */
    public function newConsultSimplesCRM($data)
>>>>>>> funcionalidade
    {
        $CRM        = ApiController::getCRM($data);
        $itemCRM    = json_decode($CRM);
        return $itemCRM;
    }
    /**
     * @param $Assertiva
     * @return mixed
     * Método que retorna o tratamento dos dados, envia para o processamento de validação
     */
    public function dataProcessingAssertiva($Assertiva)
    {
        $Assertiva->name       = strtoupper($Assertiva->name);
        $Assertiva->profissao  = strtoupper($Assertiva->profissao);
        $Assertiva->name       = trim($Assertiva->name);
        $Assertiva->profissao  = trim($Assertiva->profissao);
        $Assertiva->name       = ltrim ($Assertiva->name);
        $Assertiva->profissao  = ltrim ($Assertiva->profissao);
        
        return $Assertiva;
    }
    /**
<<<<<<< HEAD
     * @param $Serasa
     * @return mixed
     * Método que retorna o tratamento dos dados, envia para o processamento de validação
     */
    public function dataProcessingSerasa($Serasa)
=======
     * @param $CRM
     * @return mixed
     * Método que retorna o tratamento dos dados, envia para o processamento de validação
     */
    public function dataProcessingCRM($CRM)
>>>>>>> funcionalidade
    {
        $CRM->name          = strtoupper($CRM->name);
        $CRM->profissao     = strtoupper($CRM->profissao);
        $CRM->name          = trim($CRM->name);
        $CRM->profissao     = trim($CRM->profissao);
        $CRM->name          = ltrim ($CRM->name);
        $CRM->profissao     = ltrim ($CRM->profissao);
        
        return $CRM;
    }
    /**
<<<<<<< HEAD
     * @param $Serasa
     * @param $Assertiva
     * @return Consult Método que retorna o Cruzamento das Informaçoes
     */
    public function crossingData($Serasa, $Assertiva)
    {
        if($Serasa->cpf  != $Assertiva->cpf) {
            $cpf          = $Assertiva->cpf . ": 'Uma inconsistência no cpf foi encontrada'";
=======
     * @param $CRM
     * @param $Assertiva
     * @return Consult Método que retorna o Cruzamento das Informaçoes
     */
    public function crossingData($Assertiva, $CRM)
    {
        $CRM       = $this->dataProcessingCRM($CRM);
        $Assertiva = $this->dataProcessingAssertiva($Assertiva);

        if(empty($CRM->name)){

        }

        if($CRM->cpf          != $Assertiva->cpf) {
            $cpf               = $Assertiva->cpf . ": 'Uma inconsistência no cpf foi encontrada'";
>>>>>>> funcionalidade
        } else {
            $cpf               = $Assertiva->cpf;
        }
        if($CRM->name         != $Assertiva->name) {
            $name              = $Assertiva->name . ": 'Uma inconsistência no nome foi encontrada'";
        } else {
            $name              = $Assertiva->name;
        }
        if($CRM->idade        != $Assertiva->idade) {
            $idade             = $Assertiva->idade . ": 'Uma inconsistência no nome foi encontrada'";
        } else {
            $idade             = $Assertiva->idade;
        }
        if($CRM->profissao    != $Assertiva->profissao) {
            $profissao         = $Assertiva->profissao . ": 'Uma inconsistência no nome foi encontrada'";
        } else {
            $profissao         = $Assertiva->profissao;
        }

        $result = new Consult();
        $result->cpf            = $cpf;
        $result->name           = $name;
        $result->idade          = $idade;
        $result->profissao      = $profissao;

        return $result;
    }
    /**
<<<<<<< HEAD
     * @param $Serasa
=======
     * @param $
>>>>>>> funcionalidade
     * @param $Assertiva
     * @return Consult
     * Método que retorna os dados Processados
     */
<<<<<<< HEAD
    public function dataProcessed($Serasa, $Assertiva)
=======
    public function dataProcessed($CRM, $Assertiva)
>>>>>>> funcionalidade
    {
        $Assertiva     = $this->dataProcessingAssertiva($Assertiva);
        $CRM           = $this->dataProcessingCRM($CRM);
        $data          = $this->crossingData($Assertiva, $CRM);
        return $data;
    }
<<<<<<< HEAD

=======
>>>>>>> funcionalidade
    /**
     * @param $data
     * @return Consult
     * Método de Processamento de dados de consultas simples
     */
    public function dataProcessingSimpleQuery($data)
    {
        $consultAssertiva     = $this->newConsultSimplesAssertiva($data);
        $consultCRM           = $this->newConsultSimplesCRM($data);
        $dataAssertiva        = $this->dataProcessingAssertiva($consultAssertiva);
        $dataCRM              = $this->dataProcessingCRM($consultCRM);
        $data                 = $this->crossingData($dataAssertiva, $dataCRM);
        return $data;
    }
<<<<<<< HEAD

=======
>>>>>>> funcionalidade
    /**
     * @param $data
     * @return mixed
     * Métodos dados processados Consulta Simples
     */
    public function dataprocessedSimpleQuery($data)
    {
        /**
         * Método getMonths verifica se cadastro existe a de menos 6 meses
         * Método newConsultSimplesAssertiva e newConsultSimplesCRM
         * Retorna uma nova consulta da API
         * Método crossingData Retorna os dados validados com regra de
         * cruzamento dos dados
         */
        if ($this->getMonths($data)) {
<<<<<<< HEAD
            $result = $this->newConsultSimplesAssertiva($data);
            $this->saveOrUpdate($data);
            return response()->json($result);
        } else {
            if ($data = $this->getConsultDB($data)) {
                return response()->json($data);
            } else {
                $result = $this->newConsultSimplesAssertiva($data);
                $this->saveOrUpdate($data);
=======
            $assertiva = $this->newConsultSimplesAssertiva($data);
            $CRM       = $this->newConsultSimplesCRM($data);
            $result    = $this->crossingData($assertiva,$CRM);
            return response()->json($result);
        } else {
                /**
                 * CPF não existente no banco ou se cadastro existe a mais de 6 meses
                 * Método newConsultSimplesAssertiva e newConsultSimplesCRM
                 * Retorna uma nova consulta da API
                 * Método crossingData Retorna os dados validados com regra de
                 * cruzamento dos dados
                 */
                $assertiva = $this->newConsultSimplesAssertiva($data);
                $CRM       = $this->newConsultSimplesCRM($data);
                //dd($CRM->cpf);
                $result    = $this->crossingData($assertiva,$CRM);
>>>>>>> funcionalidade
                return response()->json($result);
            }
       }
}