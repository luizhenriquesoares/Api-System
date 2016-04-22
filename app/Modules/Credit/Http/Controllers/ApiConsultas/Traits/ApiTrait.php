<?php

namespace App\Modules\Credit\Http\Controllers\ApiConsultas\Traits;

use App\Modules\Credit\Http\Controllers\ApiConsultas\ServiceContainerController;
use GuzzleHttp\Client;


trait ApiTrait
{

    public static function postAssertiva($data)
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
    public static function getAssertiva($data)
    {
        try {
            $assertiva = new Client();
            $response = $assertiva->request('GET', ServiceContainerController::ASSERTIVA . $data);
            $result = $response->getBody();
//            dd($response->getBody());
            return $result;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
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