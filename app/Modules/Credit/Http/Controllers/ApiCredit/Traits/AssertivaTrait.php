<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 18:45
 */

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Traits;

use App\Modules\Credit\Http\Controllers\ApiCredit\Utils\ServiceContainerController;
use GuzzleHttp\Client;

trait AssertivaTrait
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
    public function postAssertiva($data)
    {
        try {
            $response = $this->client->request('POST', ServiceContainerController::ASSERTIVA . $data)->getBody();
            return $response;

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
            $response = $this->client->request('GET', ServiceContainerController::ASSERTIVA . $data)->getBody();
            return $response;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
/* public static function postAssertiva($data)
{
   try {
       $response = $this->client->request('POST',ServiceContainerController::ASSERTIVA  .'?empresa='. ServiceContainerController::ASSERTIVACOMPANY  . '&usuario='  .
              ServiceContainerController::ASSERTIVAUSER . '&senha=' . ServiceContainerController::ASSERTIVAPASSWORD .'&documento=' . $data)->getBody();
       return $reponse;
   } catch (\Exception $e) {
       echo 'Exceção capturada: ', $e->getMessage(), "\n";
   }
}

public static function getAssertiva($data)
{
   try {
       $response = $this->client->request('GET',ServiceContainerController::ASSERTIVA .'?empresa='. ServiceContainerController::ASSERTIVACOMPANY  . '&usuario='  .
              ServiceContainerController::ASSERTIVAUSER . '&senha=' . ServiceContainerController::ASSERTIVAPASSWORD .'&documento=' . $data)->getBody();
       return $reponse;
   } catch (\Exception $e) {
       echo 'Exceção capturada: ', $e->getMessage(), "\n";
   }
}