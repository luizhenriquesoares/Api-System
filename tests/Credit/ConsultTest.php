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
        $formatCpf = $this->getMockBuilder(Consult::class)
            ->getMock();
        $formatCpf->method('formatCpf')
            ->willReturn('101.808.704-40');
        
        $getConsultDB = $this->getMockBuilder(Consult::class)
            ->getMock();
        $getConsultDB->method('getConsultDB')
            ->willReturn('101.808.704-40');

        $getMonths = $this->getMockBuilder(Consult::class)
            ->getMock();
        $getMonths->method('getMonths')
            ->willReturn('101.808.704-40');

        $consult = new Consult();

       // $this->assertEquals(true,$consult->localizaSimples('101.808.704-40'));

    }
}