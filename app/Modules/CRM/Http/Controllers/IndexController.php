<?php

namespace App\Modules\CRM\Http\Controllers;

use App\Modules\CRM\Modules\CRM\Http\Controllers\Controller;
use App\Modules\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        return User::all();;
    }
}
