<?php

namespace App\Modules\ApiManager\Http\Controllers;

use App\Modules\AbstractModulesController;
use App\Modules\Models\User;

class UserController extends AbstractModulesController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = User::all();
        dd($data);
        return view($this->page,$data);
    }
}
