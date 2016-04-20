<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:11
 */

namespace App\Modules\Contracts;


interface DefaultMethodsFormRequest
{

    /**
     * Autorização para utilização da requisição via formulário
     * @return boolean
     */

    public function authorize();

    /**
     * Retorna as regras de validação de campo
     * @return array
     */

    public function rules();

}