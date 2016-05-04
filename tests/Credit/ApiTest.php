<?php

/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 04/05/16
 * Time: 11:43
 */
use App\Modules\Models\Api;

class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function verificaSeOStatusDaApiForIgualAUmRetornaTrue()
    {
        $mock = $this->getMockBuilder('Api')
            ->setMethods(['getApi'])
            ->getMock();
        $mock->method('getApi')
            ->willReturn(true);

        $consult = new Api();
        $this->assertEquals($mock->getApi(), $consult->getApi());
    }
}