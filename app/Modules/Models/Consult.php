<?php
namespace App\Modules\Models;


use App\Modules\Credit\Http\Controllers\ApiCredit\Types\AssertivaController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Consult
 * @package App\Modules\Models
 */
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
    protected $client;
    /**
     * Consult constructor.
     * @param AssertivaController $client
     */
    public function __construct(array $attributes = array(), AssertivaController $client = null)
    {
        /* override your model constructor */
        parent::__construct($attributes);
        $this->client = $client;

    }
    /**
     * @param $data Pegar dados se Cpf Existir no banco
     */
    public function getCpf($data)
    {
        $earliestdate = DB::table('test_consult')
            ->select('*')
            ->where(['cpf' => $data])->get();
        return $earliestdate;
    }
    /**
     * @param $data
     * @return \Closure
     * Salva ou Atualiza os dados da consulta no Banco de Dados
     */
    public function saveOrUpdate($data, $result)
    {
        if($this->getCpf($data)) {
            $result = (array) $result;
            $this->update($result);
        } else {
            $result = (array) $result;
            $create = $this->create($result);
        }
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
         * Retorna uma consulta do BD
         * Método crossingData Retorna os dados validados com regra de
         * cruzamento dos dados
         */
        if ($this->getMonths($data)) {
            $consult = $this->getConsultDB($data);
            return response()->json($consult);
        } else {
                /**
                 * CPF não existente no banco ou se cadastro existe a mais de 6 meses
                 * Método newConsultSimplesAssertiva e newConsultSimplesCRM
                 * Retorna uma nova consulta da API
                 * Método crossingData Retorna os dados validados com regra de
                 * cruzamento dos dados
                 */
                $assertiva = $this->client->newConsultSimple($data);
                //$this->saveOrUpdate($data, $assertiva);
                return response()->json($assertiva);
            }
       }

}