<?php

namespace App\Http\Controllers;


use App\Consult;
use App\Http\Controllers\ApiConsultas\ConsultController;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $validate;

    public function __construct(ConsultController $validate)
    {
        $this->validate = $validate;
    }

    public function index($param)
    {
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
