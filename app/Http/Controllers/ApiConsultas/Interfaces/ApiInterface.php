<?php
/**
 * Created by PhpStorm.
 * User: Yoda
 * Date: 03/04/2016
 * Time: 13:52
 */


namespace App\Http\Controllers\ApiConsultas\Interfaces;

interface ApiInterface
{

    public static function getAssertiva($data);
    public static function getSerasa($data);
    public static function postAsseriva($data);
    public static function postSerasa($data);
}