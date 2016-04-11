<?php


namespace App\Http\Controllers\ApiConsultas;

use App\Consult;
use App\Http\Controllers\ApiConsultas\Interfaces\ConsultInterface;
use App\Http\Controllers\Controller;

class ConsultController extends Controller implements ConsultInterface
{
    private $consult;

    public function __construct(Consult $consult)
    {
        $this->consult = $consult;
    }
    
    public function getConsultSimplesPF($data)
    {
        if($this->consult->getMonths($data)) {
            
            $assertiva = $this->consult->newConsultSimplesAssertiva($data);
            $serasa    = $this->consult->newConsultSimplesSerasa($data);
            $result    = $this->consult->dataProcessed($assertiva, $serasa);
            $result    = (array) $result;

            $this->consult->saveOrUpdate($data);
            
            return $result;

        } else {

            if($data   = $this->consult->getConsultDB($data)) {
                return $data;

        } else{

            $assertiva = $this->consult->newConsultSimplesAssertiva($data);
            $serasa    = $this->consult->newConsultSimplesSerasa($data);
            $result    = $this->consult->dataProcessed($assertiva, $serasa);
            $result    = (array) $result;

            $this->consult->saveOrUpdate($data);
                
                return $result;
            }
        }

    }
    
}