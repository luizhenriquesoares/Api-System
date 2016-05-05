<?php

namespace App\Modules\Credit\Http\Controllers;
    
use App\Modules\Models\Consult;

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
     * Injeção de dependência com Modelo Consult, Construtor inicializa Consult
     * 
     * FrontController constructor.
     * @param Consult $consult
     */
    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }
    
    /**
     * Action Index , chama método localiza Simples do Modelo Consult e retorna Json
     * 
     * @param $data
     * @return mixed
     */
    public function index($data)
    {
        $data = $this->consult->localizaSimples($data);
        return $data;
    }
}

