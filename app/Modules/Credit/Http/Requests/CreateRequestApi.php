<?php

namespace App\Http\Requests;

use App\Http\Requests\Request as Request1;

class CreateRequestApi extends Request1
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cpf',
            'name',
            'create',
            'modified'
        ];
    }
}
