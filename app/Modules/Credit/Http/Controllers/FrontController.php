<?php

namespace App\Modules\Credit\Http\Controllers;

use App\Modules\Credit\Http\Controllers\ApiConsultas\Interfaces\ConsultInterface;
use App\Modules\Models\Consult;
use Illuminate\Http\Request;


class FrontController extends Controller implements ConsultInterface
{
    /**
     * @var Consult
     */
    private $consult;

    /**
     * FrontController constructor.
     * @param Consult $consult
     */
    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }
    /**
     * @return string
     */
    public function index()
    {
        return 'teste';
    }
    /**
     * @param $data
     * @return mixed
     */
    public function simplesPF($data)
    {
        $data = $this->consult->dataprocessedSimpleQuery($data);
        return $data;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $data = Consult::create($request->all());

        return response()->json(['result' => false]);
    }

}
