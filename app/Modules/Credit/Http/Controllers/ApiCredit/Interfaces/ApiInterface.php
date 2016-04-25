<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 03/04/2016
 * Time: 13:52
 */

namespace App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces;

interface ApiInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function newConsultSimple($data);

    /**
     * @param $data
     * @return mixed
     */
    public function dataProcessing($data);
}