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
        if($this->consult->getMonths($data)) {
            $assertiva = $this->consult->newConsultSimplesAssertiva($data);
            $serasa    = $this->consult->newConsultSimplesSerasa($data);
            $result    = $this->consult->dataProcessed($assertiva, $serasa);
            $result    = (array) $result;

            $this->consult->saveOrUpdate($data);

            return response()->json($result);

        } else {
     ''
            if($data = $this->consult->getConsultDB($data)) {
                return response()->json($data);
            } else{
                $assertiva = $this->consult->newConsultSimplesAssertiva($data);
                $serasa    = $this->consult->newConsultSimplesSerasa($data);
                $result    = $this->consult->dataProcessed($assertiva, $serasa);
                $result    = (array) $result;

                $this->consult->saveOrUpdate($data);

                return response()->json($result);
            }
        }

    }
    public function store(Request $request)
    {
        $data = Consult::create($request->all());

        return response()->json(['result' => false]);
    }

}


