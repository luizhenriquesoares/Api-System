<?php
namespace App\Modules\Models;

use App\Modules\Credit\Http\Controllers\ApiConsultas\ApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consult extends Model
{
    protected $table = 'consultas';

    protected $fillable = [
        'cpf',
        'name',
        'created_at',
        'updated_at'
    ];

    // Pegar dados se Cpf Existir no banco

    public function getCpf($data)
    {
        $earliestdate = DB::table('consultas')
            ->select('*')
            ->where(['cpf' => $data])->get();
    }
   //  Salva ou Atualiza os dados da consulta no Banco de Dados

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

    // se for maior que 6 meses faz uma nova consulta

    public function getMonths($data)
    {
        $mostDate  = DB::table('consultations')
            ->select('*')
            ->where('cpf', '=', $data)
            ->having('updated_at', '<=' , new \DateTime('-6 months'))
            ->get();
    }

    // pegar consulta se CPF existe na base dados

    public function getConsultDB($data)
    {
        $earliestdate = DB::table('consultations')
            ->select('*')
            ->where(['cpf' => $data])->get();

        if($earliestdate) {
            return $earliestdate;
        }
    }

  // Fazer uma nova consulta na api Assertiva e retorna json

    public function newConsultSimplesAssertiva($data)
    {
        $Assertiva     = ApiController::getAssertiva($data);
        $itemAssertiva = json_decode($Assertiva);
        
        return $itemAssertiva;
    }

    // Fazer uma nova consulta na api Serasa e retorna json

    public function newConsultSimplesSerasa($data)
    {
        $Serasa     = ApiController::getSerasa($data);
        $itemSerasa = json_decode($Serasa);
        
        return $itemSerasa;
    }

    // Método que retorna o tratamento dos dados, envia para o processamento de validação

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

    // Método que retorna o tratamento dos dados, envia para o processamento de validação

    public function dataProcessingSerasa($Serasa)
    {
        $Serasa->name          = strtoupper($Serasa->name);
        $Serasa->profissao     = strtoupper($Serasa->profissao);
        $Serasa->name          = trim($Serasa->name);
        $Serasa->profissao     = trim($Serasa->profissao);
        $Serasa->name          = ltrim ($Serasa->name);
        $Serasa->profissao     = ltrim ($Serasa->profissao);
        
        return $Serasa;
    }

    // Método que retorna o Cruzamento das Informaçoes

    public function crossingData($Serasa, $Assertiva)
    {
        if($Serasa->cpf  != $Assertiva->cpf) {
            $cpf          = $Assertiva->cpf . ": 'Uma inconsistência no cpf foi encontrada'";
        } else {
            $cpf          = $Assertiva->cpf;
        }
        if($Serasa->name != $Assertiva->name) {
            $name         = $Assertiva->name . ": 'Uma inconsistência no nome foi encontrada'";
        } else {
            $name         = $Assertiva->name;
        }
        $result = new Consult();
        $result->cpf       = $cpf;
        $result->name      = $name;

        return $result;
    }

    // Método que retorna os dados Processados

    public function dataProcessed($Serasa, $Assertiva)
    {
        $Assertiva     = $this->dataProcessingAssertiva($Assertiva);
        $Serasa        = $this->dataProcessingSerasa($Serasa);
        $data          = $this->crossingData($Assertiva, $Serasa);

        return $data;
    }
}