<?php

namespace App\Modules\Credit\Http\Controllers;


use App\Modules\Models\Consult;
use App\Modules\Credit\Http\Controllers\ApiConsultas\ConsultController;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $validate;


    public function index(ConsultController $validate, $param)
    {
        $this->validate = $validate;
        $data = $this->validate->getConsultSimplesPF($param);
        $this->data = $data;

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $data = Consult::create($request->all());

        return response()->json(['result' => false]);
    }

}
