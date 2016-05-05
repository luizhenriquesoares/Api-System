<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 03/04/2016
 * Time: 13:52
 */
namespace App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces;
/**
 * Interface ApiInterface
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces
 */
interface ApiInterface
{
    /**
     * Implementa uma nova consulta do Tipo simples cadastral
     * 
     * @param $data
     * @return mixed
     */
    public function newConsultSimple($data);
    
    /**
     * Implementa uma método que retorna os dados tratatos pronto e processados 
     * 
     * @param $data
     * @return mixed
     */
    public function dataProcessing($data);
}       