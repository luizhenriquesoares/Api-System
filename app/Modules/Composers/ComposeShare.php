<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 19/01/16
 * Time: 07:48
 */

namespace App\Modules\Composers;

use Illuminate\Support\Facades\View;

class ComposeShare
{
    /**
     * Compartilhar variavel diante de todas as views
     * @param $varName
     * @param $data
     * @return mixed
     */
    public static function compose($varName, $data)
    {
        return View::share($varName, $data);
    }

    /**
     * Obter índice de um determinado array
     * @param array $args
     * @param $key
     * @return null
     */
    public static function getVar(Array $args = array(), $key)
    {
        return (array_key_exists($key, $args)) ? $args[$key] : NULL;
    }
}