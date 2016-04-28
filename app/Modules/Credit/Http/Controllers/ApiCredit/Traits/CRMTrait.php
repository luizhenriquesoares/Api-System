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
   public function postCRM($data)
   {
       try {
            $response = $this->client->request('POST',ServiceContainerController::CRM . '?empresa=' . ServiceContainerController::CRMCOMPANY  . '&usuario='  .
                   ServiceContainerController::CRMUSER . '&senha='   . ServiceContainerController::CRMPASSWORD .'&documento=' . $data)->getBody();
            return $response;
       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }
    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
   public function getCRM($data)
   {
        try {
            $response = $this->client->request('GET',ServiceContainerController::CRM . '?empresa=' . ServiceContainerController::CRMCOMPANY  . '&usuario='  .
                   ServiceContainerController::CRMUSER . '&senha='   . ServiceContainerController::CRMPASSWORD .'&documento=' . $data)->getBody();
            return $response;
       } catch (\Exception $e) {
           echo 'Exceção capturada: ', $e->getMessage(), "\n";
       }
   }

}