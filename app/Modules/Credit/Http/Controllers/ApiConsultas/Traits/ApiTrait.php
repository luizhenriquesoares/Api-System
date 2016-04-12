<?php

namespace App\Modules\Credit\Http\Controllers\ApiConsultas\Traits;

use App\Modules\Credit\Http\Controllers\ApiConsultas\ServiceContainerController;
use GuzzleHttp\Client;


trait ApiTrait
{
    public static function postAssertiva($data)
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

    public static function postSerasa($data)
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

    public static function getSerasa($data)
    {
        try {
            $url = ServiceContainerController::SERASA     . '?empresa=' .   ServiceContainerController::SERASACOMPANY  . '&usuario='  .
                   ServiceContainerController::SERASAUSER . '&senha='   .   ServiceContainerController::SERASAPASSWORD .'&documento=' . $data;
            $serasa = new Client();
            return $serasa->request('GET', $url)->getBody();

        } catch (\Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }
    }



}