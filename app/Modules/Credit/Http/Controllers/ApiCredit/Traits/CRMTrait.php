<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 19:54
 */

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Traits;


use App\Modules\Credit\Http\Controllers\ApiCredit\Utils\ServiceContainerController;
use GuzzleHttp\Client;

trait CRMTrait
{
    /**
     * AssertivaTrait constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getCRM($data)
    {
        try {
            $response = $this->client->request('GET', ServiceContainerController::CRM . $data)->getBody();
            return $response;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function postCRM($data)
    {
        try {
            $response = $this->client->request('POST', ServiceContainerController::CRM . $data)->getBody();
            return $response;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /*
   public static function postCRM($data)
   {
       try {
            $response = $this->client->request('POST',ServiceContainerController::SERASA . '?empresa=' . ServiceContainerController::SERASACOMPANY  . '&usuario='  .
                   ServiceContainerController::SERASAUSER . '&senha='   . ServiceContainerController::SERASAPASSWORD .'&documento=' . $data)->getBody();
            return $response;
       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }

   public static function getCRM($data)
   {
        try {
            $response = $this->client->request('GET',ServiceContainerController::SERASA . '?empresa=' . ServiceContainerController::SERASACOMPANY  . '&usuario='  .
                   ServiceContainerController::SERASAUSER . '&senha='   . ServiceContainerController::SERASAPASSWORD .'&documento=' . $data)->getBody();
            return $response;
       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }*/


}