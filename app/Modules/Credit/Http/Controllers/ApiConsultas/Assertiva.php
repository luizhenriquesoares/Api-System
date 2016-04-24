<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:08
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\Test\Credit\Http\Controllers\Controller;
use GuzzleHttp\Client;

class Assertiva extends Controller implements ApiInterface
{
    /**
     * @var CRM
     */
    protected $CRM;

    /**
     * Assertiva constructor.
     * @param Assertiva $assertiva
     * @param CRM $CRM
     */
    public function __construct(Assertiva $assertiva, CRM $CRM)
    {
        $this->assertiva = $assertiva;
        $this->CRM = $CRM;
    }

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

    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function postAssertiva($data)
    {
        try {
            $assertiva = new Client();
            $response = $assertiva->request('POST', ServiceContainerController::ASSERTIVA . $data);
            $result = $response->getBody();
            return $result;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getAssertiva($data)
    {
        try {
            dd($data);
            $assertiva = new Client();
            $response = $assertiva->request('GET', ServiceContainerController::ASSERTIVA . $data);
            $result = $response->getBody();
            dd($result);
            return $result;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
    /* public static function postAssertiva($data)
   {
       try {
           $url = ServiceContainerController::ASSERTIVA     .'?empresa='. ServiceContainerController::ASSERTIVACOMPANY  . '&usuario='  .
                  ServiceContainerController::ASSERTIVAUSER . '&senha=' . ServiceContainerController::ASSERTIVAPASSWORD .'&documento=' . $data;
           $assertiva = new Client();
           return $assertiva->request('POST', $url)->getBody();

       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }

   public static function getAssertiva($data)
   {
       try {
           $url = ServiceContainerController::ASSERTIVA     .   '?empresa=' . ServiceContainerController::ASSERTIVACOMPANY  . '&usuario='  .
                  ServiceContainerController::ASSERTIVAUSER . '  &senha='   . ServiceContainerController::ASSERTIVAPASSWORD .'&documento=' . $data;
           $assertiva = new Client();
           return $assertiva->request('GET', $url)->getBody();

       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }



}