<?php

/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 02/05/16
 * Time: 12:14
 */
use App\Modules\Credit\Http\Controllers\ApiCredit\Traits\ApiTrait;
use App\Modules\Credit\Http\Controllers\ApiCredit\Types\AssertivaController;
use GuzzleHttp\Client;
use App\Modules\Models\Api;
use App\Modules\Credit\Http\Controllers\ApiCredit\Interfaces\ApiInterface;
/**
 * Class AssertivaTest
 */
/*class AssertivaTest extends \PHPUnit_Framework_TestCase*/
{
    
   
   /* public function verificaSeAssertivaControllerImplementaInteface()
    {
        $assertiva = new AssertivaController();
        $this->assertInstanceOf($assertiva, ApiInterface::class );
    }*/

  /* public function verificaSeAConsultaNaApiRetornaTrue()
    {
        $mock = $this->getMockForTrait(ApiTrait::class, $arguments = array(), Client::class, Api::class);

        $mock->expects($this->any())
             ->method('getRequest')
             ->willReturn(true);

        $assertiva = new AssertivaController(Client::class, Api::class);
        $result = $assertiva->newConsultSimple($mock);
        $this->assertEquals(true, $result);
    }*/

}

