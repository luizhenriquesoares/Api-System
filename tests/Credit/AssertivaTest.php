<?php

/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 02/05/16
 * Time: 12:14
 */
use App\Modules\Credit\Http\Controllers\ApiCredit\Traits\ApiTrait;
use App\Modules\Credit\Http\Controllers\ApiCredit\Types\AssertivaController;

/**
 * Class AssertivaTest
 */
class AssertivaTest extends \PHPUnit_Framework_TestCase
{
   
  /*  public function verificaSeAConsultaNaApiRetornaTrue()
    {
        $mock = $this->getMockForTrait(ApiTrait::class)->getMock();

        $mock->method('getRequest')
          ->willReturn(true);

        $assertiva = new AssertivaController();
        $result = $assertiva->newConsultSimple($mock);
        $this->assertEquals(true, $result);
    }*/

}

