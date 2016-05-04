<?php

/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 02/05/16
 * Time: 11:29
 */
use App\Modules\Models\Consult;

class ConsultTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function verificaSeCpfEhValido()
    {
        $consult = new Consult();
        $cpf     = $consult->validateCpf('101.808.704-40');
        $this->assertEquals(true, $cpf);
    }
    /**
     * @test
     */
    public function verificaSeCpfEhFormatado()
    {
        $consult = new Consult();
        $cpf     = $consult->formatCpf('10180870440');
        $this->assertEquals('101.808.704-40', $cpf);
    }
    /**
     * @test
     */
    public function verificaMetodoLocalizaSimples()
    {
            $mock = $this->getMockBuilder('Consult')
                         ->setMethods(['getMonths'])
                         ->getMock();

            $mock->method('getMonths')
                 ->willReturn(true);

            $this->assertEquals(true, $mock->getMonths());
    }
    /**
     * @test
     */
    public function verificaSeMetodoPegarCpfRetornaTrue()
    {
        $mock = $this->getMockBuilder('Consult')
                     ->setMethods(['getCpf'])
                     ->getMock();
        $mock->method('getCpf')
             ->willReturn(true);
        
        $consult = new Consult();
        $this->assertEquals($mock->getCpf(), $consult->getCpf('101.808.704-40'));
    }
    /**
     * @test
     */
    public function verificaSeforMaiorQue6MesesFazUmaNovaConsulta()
    {
        $mock = $this->getMockBuilder('Consult')
            ->setMethods(['getMonths'])
            ->getMock();
        $mock->method('getMonths')
            ->willReturn(true);

        $consult = new Consult();
        $this->assertEquals($mock->getMonths(), $consult->getMonths('101.808.704-40'));
    }
}