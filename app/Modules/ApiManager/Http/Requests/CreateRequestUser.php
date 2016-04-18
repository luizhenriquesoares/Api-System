<?php
/**
 * Created by PhpStorm.
 * User: lourivaldo
 * Date: 27/01/16
 * Time: 14:44
 */

namespace App\Modules\ApiManager\Http\Requests;


use App\Modules\AbstractModulesFormRequest;

/**
 * Class CreateRequestUser
 * @package App\Modules\Manager\Http\Requests
 */
class CreateRequestUser extends AbstractModulesFormRequest
{

    /**
     * Autorização para utilização da requisição via formulário
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna as regras de validação de campo
     * @return array
     */
    public function rules()
    {
        return [
            'name'  => 'required|min:6|string',
            'email'     => 'required|email|min:10|string',
            'password'  => 'required|min:8|string',
            'api_token'  => 'required|min:60|max:60|string',
        ];
    }
}