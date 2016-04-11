<?php
namespace App;
use App\Http\Controllers\ApiConsultas\ApiController;
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

    public function monthsRule($data)
    {
        $mostDate  = DB::table('consultations')
            ->select('*')
            ->where('cpf', '=', $data)
            ->having('updated_at', '<=' , new \DateTime('-6 months'))
            ->get();
    }

    public function getCpf($data)
    {
        $earliestdate = DB::table('consultations')
            ->select('*')
            ->where(['cpf' => $data])->get();
    }

    public function saveOrUpdate($data)
    {
        return function($result) use ($data) {
            if($this->getCpf($data)) {
                $update  = Consult::update($result);
                dd($update);
            } else {
                $create  = Consult::create($result);
            }
        };
    }

    public function getConsult($data)
    {
        // se for maior que 6 meses faz uma nova consulta

        if ($mostDate  = DB::table('consultations')
            ->select('*')
            ->where('cpf', '=', $data)
            ->having('updated_at', '<=' , new \DateTime('-6 months'))
            ->get()) {

            $Assertiva      =    $this->newConsultSimplesAssertiva($data);
            $Serasa         =    $this->newConsultSimplesSerasa($data);
            $result         =    $this->crossingData($Assertiva, $Serasa);
            $result = (array) $result;

            //$this->saveOrUpdate($data);

            return $result;

        } else {

            // se for menor  que 6 meses faz consulta no BD
            // se cpf não existir, faz nova consulta

            if($earliestdate = $this->getCpf($data)) {
                return $earliestdate;
            }

            if($earliestdate == false){
                $Assertiva      =    $this->newConsultSimplesAssertiva($data);
                $Serasa         =    $this->newConsultSimplesSerasa($data);
                $result         =    $this->dataProcessed($Assertiva, $Serasa);
                $result = (array) $result;

                dd('menor que 6');

                //$data = $this->saveOrUpdate($result);

                return $result;
            }
        }
    }

    public function newConsultSimplesAssertiva($data)
    {
        $Assertiva     = ApiController::getAssertiva($data);
        $itemAssertiva = json_decode($Assertiva);
        
        return $itemAssertiva;
    }

    public function newConsultSimplesSerasa($data)
    {
        $Serasa     = ApiController::getSerasa($data);
        $itemSerasa = json_decode($Serasa);
        
        return $itemSerasa;
    }

    // Métod que retorna o tratamento dos dados, envia para o processamento de validação

    public function dataProcessingAssertiva(\stdClass $Assertiva)
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

    public function crossingData(\stdClass $Serasa, \stdClass $Assertiva)
    {
        if($Serasa->cpf != $Assertiva->cpf) {
            $cpf         = $Assertiva->cpf . ": 'Uma inconsistência no cpf foi encontrada'";
        } else {
            $cpf         = $Assertiva->cpf;
        }
        if($Serasa->name != $Assertiva->name) {
            $name         = $Assertiva->name . ": 'Uma inconsistência no nome foi encontrada'";
        } else {
            $name         = $Assertiva->name;
        }

        $this->cpf       = $cpf;
        $this->name      = $name;

        return $this;
    }

    // Método que retorna os dados Processados

    public function dataProcessed($Serasa, $Assertiva)
    {
        $Assertiva     = $this->dataProcessingAssertiva($Assertiva);
        $Serasa        = $this->dataProcessingSerasa($Serasa);
        $Serasa        = $this->dataProcessingSerasa($Serasa);
        $data          = $this->crossingData($Assertiva, $Serasa);

        return $data;
    }
}