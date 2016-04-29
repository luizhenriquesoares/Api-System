<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 20/04/16
 * Time: 11:05
 */
namespace App\Modules\Test\Credit\Http\Controllers;


class FrontController extends Controller
{
    /**
     * @var bool $result
     */

    protected $result;
    /**
     * @param $cpf
     */

    public function index($cpf)
    {
        dd($cpf);
    }
}

