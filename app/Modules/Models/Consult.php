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

    protected $fillable = ['cpf', 'name', 'data', 'signo', 'sexo', 'mae', 'rg', 'telFixo1', 'telFixo2', 'telFixo3', 'telFixo4', 'logradouro', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'email1', 'email2', 'email3', 'email4', 'profissao', 'empresa', 'renda', 'created_at', 'updated_at' ];

    protected $client;
    /**
     * Consult constructor.
     * @param AssertivaController $client
     */
    public function __construct(array $attributes = array(), AssertivaController $client = null)
    {
        // override your model constructor 
        parent::__construct($attributes);
        $this->client = $client;
    }
    /**
     * @param $cpf
     * @return bool
     * Método Valida Tamanho, Confere Primeiro Digito Verificador, Calcula Segundo dígido Verificador
     */
    public function validateCpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
        if (strlen($cpf) != 11)
            return false;
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
            $soma += $cpf{$i} * $j;
        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
    /**
     * @param $cpf
     * @return string
     * Método recebe CPF e Formatar no Padrão xxx.xxx.xxx-xx, caso já seja formatado
     * ele Retorna ele mesmo
     */
    public function formatCpf($cpf)
    {
        if($true = $this->validateCpf($cpf)){
            if (strlen($cpf) == 14){
                return $cpf;
            } else {
                $partOne     = substr($cpf, 0, 3);
                $partTwo     = substr($cpf, 3, 3);
                $partThree   = substr($cpf, 6, 3);
                $partFour    = substr($cpf, 9, 2);
                $mountCPF = "$partOne.$partTwo.$partThree-$partFour";

                return $mountCPF;
            }
        } else {
            dd('cpf é invalido');
        }
    }
    /**
     * @param $data Pegar dados se Cpf Existir no banco
     */
    public function getCpf($data)
    {
        $earliestdate = DB::table('test_consult')
            ->select('*')
            ->where(['cpf' => $data])->first();
        return $earliestdate;
    }
    /**
     * @param $data
     * @return $result
     * Salva ou Atualiza os dados da consulta no Banco de Dados
     */
    public function saveOrUpdate($data, $result)
    {
            if($consult = $this->getCpf($data)) {
                $this->destroy($consult->id);
                $result = (array) $result;
                $this->create($result);
            } else {
                $result = (array) $result;
                $this->create($result);
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
            ->where(['cpf' => $data])->first();
        if($earliestdate) {
            $data = (object) $earliestdate;
            return $data;
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
         * Método Validar CPF e Formatar no Padrão xxx.xxx.xxx-xx
         */
        $data = $this->formatCpf($data);
        /**
         * Método getMonths     verifica se cadastro existe a de menos 6 meses
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
                $this->saveOrUpdate($data, $assertiva);
                return response()->json($assertiva);
            }
       }
}