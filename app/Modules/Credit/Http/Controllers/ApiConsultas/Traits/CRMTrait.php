<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 19:54
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas\Traits;

use App\Modules\Credit\Http\Controllers\ApiConsultas\ServiceContainerController;
use GuzzleHttp\Client;

trait CRMTrait
{
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