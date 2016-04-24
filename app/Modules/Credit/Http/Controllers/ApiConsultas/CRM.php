<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 15:11
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ApiInterface;
use App\Modules\CRM\Modules\CRM\Http\Controllers\Controller;
use GuzzleHttp\Client;

class CRM extends Controller implements ApiInterface
{
    /**
     * @var Assertiva
     */
    protected $assertiva;
    /**
     * CRM constructor.
     * @param Assertiva $assertiva
     * @param CRM $CRM
     */
    public function __construct(Assertiva $assertiva, CRM $CRM)
    {
        $this->assertiva = $assertiva;
    }
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

    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public static function getCRM($data)
    {
        try {
            $crm = new Client();
            $response = $crm->request('GET', ServiceContainerController::CRM . $data);
            $result1 = $response->getBody();
            return $result1;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public static function postCRM($data)
    {
        try {
            $serasa = new Client();
            $response = $serasa->request('POST', ServiceContainerController::CRM . $data);
            $result1 = $response->getBody();
            return $result1;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /*
   public static function postCRM($data)
   {
       try {
            $url = ServiceContainerController::SERASA     . '?empresa=' . ServiceContainerController::SERASACOMPANY  . '&usuario='  .
                   ServiceContainerController::SERASAUSER . '&senha='   . ServiceContainerController::SERASAPASSWORD .'&documento=' . $data;
           $serasa = new Client();
           return $serasa->request('POST', $url)->getBody();

       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";

       }
   }

   public static function getCRM($data)
   {
       try {
           $url = ServiceContainerController::SERASA     . '?empresa=' .   ServiceContainerController::SERASACOMPANY  . '&usuario='  .
                  ServiceContainerController::SERASAUSER . '&senha='   .   ServiceContainerController::SERASAPASSWORD .'&documento=' . $data;
           $serasa = new Client();
           return $serasa->request('GET', $url)->getBody();

       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }*/


}