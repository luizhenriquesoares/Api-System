<?php

namespace App\Modules\CRM\Http\Controllers;

use App\Modules\CRM\Modules\CRM\Http\Controllers\Controller;
use App\Modules\Models\User;

class IndexController extends Controller
{
    public function index()
    {
//        $user = User::first();
//        $user->password = bcrypt("123456");
//        $user->api_token = bcrypt("123456");
//        $user->save();
        return User::all();
    }
}
