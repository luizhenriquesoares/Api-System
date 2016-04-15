<?php

namespace App\Modules\Credit\Http\Controllers;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ConsultInterface;
use App\Modules\Models\Consult;
use Illuminate\Http\Request;


class FrontController extends Controller implements ConsultInterface
{
    private $consult;

    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }

    public function simplesPF($data)
    {
        $data = $this->consult->dataprocessedSimpleQuery($data);
        return $data;
    }
    public function store(Request $request)
    {
        $data = Consult::create($request->all());

        return response()->json(['result' => false]);
    }

}
