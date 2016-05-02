<?php

namespace App\Modules\Credit\Http\Controllers;
    
use App\Modules\Models\Consult;
use Illuminate\Http\Request;

/**
 * Class ApiController
 * @package App\Modules\Credit\Http\Controllers
 */
class ApiController extends Controller
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
        $data = $this->consult->localizaSimples($data);
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
