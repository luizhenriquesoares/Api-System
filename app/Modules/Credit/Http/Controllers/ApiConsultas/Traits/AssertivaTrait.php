<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 18:45
 */

namespace App\Modules\Credit\Http\Controllers\ApiConsultas\Traits;


use App\Modules\Credit\Http\Controllers\ApiConsultas\ServiceContainerController;
use GuzzleHttp\Client;

trait AssertivaTrait
{
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