<?php

namespace App\Modules\Credit\Http\Controllers;
    
use App\Modules\Models\Consult;
use Illuminate\Http\Request;


class FrontController extends Controller
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
     * @param $data
     * @return mixed
     */
    public function index($data)
    {
        $cpf  = $this->consult->formatCpf($data);
        $data = $this->consult->localizaSimples($cpf);
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
