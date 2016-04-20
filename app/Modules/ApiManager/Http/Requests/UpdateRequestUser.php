<?php
/**
 * Created by PhpStorm.
 * User: lourivaldo
 * Date: 29/01/16
 * Time: 10:57
 */

namespace App\Modules\ApiManager\Http\Requests;


use App\Modules\AbstractModulesFormRequest;

/**
 * Class UpdateRequestUser
 * @package App\Modules\Manager\Http\Requests
 */
class UpdateRequestUser extends AbstractModulesFormRequest
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
            'email'     => 'email|min:10|string',
            'password'  => 'min:8|string',
            'api_token'  => 'required|min:60|max:60|string',
        ];
    }
}