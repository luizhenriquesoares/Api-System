<?php
namespace App\Modules\Models;


use App\Modules\Credit\Http\Controllers\ApiConsultas\AssertivaController;
use App\Modules\Credit\Http\Controllers\ApiConsultas\CRMController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    /**
     * @var CRM
     */
    protected $CRM;
    /**
     * @var Assertiva
     */
    protected $assertiva;
    /**
     * Consult constructor.
     */
    public function __construct(AssertivaController $assertiva, CRMController $CRM)
    {
        $this->CRM = $CRM;
        $this->assertiva = $assertiva;
    }
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
     * @param $Assertiva
     * @param $CRM
     * @return Consult Método que retorna o Cruzamento das Informaçoes
     */
    public function crossingData($Assertiva, $CRM)
    {
        $CRM       = $this->CRM->dataProcessing($CRM);
        $Assertiva = $this->assertiva->dataProcessing($Assertiva);

        if(empty($CRM->name)){
        }

        if($CRM->cpf          != $Assertiva->cpf) {
            $cpf               = $Assertiva->cpf . ": 'Uma inconsistência no cpf foi encontrada'";
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

        $result = new \stdClass();
        $result->cpf            = $cpf;
        $result->name           = $name;
        $result->idade          = $idade;
        $result->profissao      = $profissao;

        return $result;
    }
    /**
     * @param $data
     * @return mixed
     * Métodos dados processados Consulta Simples
     */
    public function localizaSimples($data)
    {
        /**
         * Método getMonths verifica se cadastro existe a de menos 6 meses
         * Método newConsultSimplesAssertiva e newConsultSimplesCRM
         * Retorna uma nova consulta da API
         * Método crossingData Retorna os dados validados com regra de
         * cruzamento dos dados
         */
        if ($this->getMonths($data)) {
            $assertiva = $this->assertiva->newConsultSimple($data);
            $CRM       = $this->CRM->newConsultSimple($data);
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
                $assertiva = $this->assertiva->newConsultSimple($data);
                $CRM       = $this->CRM->newConsultSimple($data);
                $result    = $this->crossingData($assertiva,$CRM);
                return response()->json($result);
            }
       }

}