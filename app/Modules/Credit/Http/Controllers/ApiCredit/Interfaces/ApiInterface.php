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
     * @param $data
     * @return mixed
     */
<<<<<<< HEAD
    public  function newConsultSimple($data);
=======
    public function newConsultSimple($data);
>>>>>>> refatoração

    /**
     * @param $data
     * @return mixed
     */
    public function dataProcessing($data);
}