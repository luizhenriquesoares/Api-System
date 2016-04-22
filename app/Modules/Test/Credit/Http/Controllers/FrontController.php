<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 20/04/16
 * Time: 11:05
 */
namespace App\Modules\Test\Credit\Http\Controllers;

use App\Modules\Models\TestConsult;

class FrontController extends Controller
{
    /**
     * @var bool $result
     */

    protected $result;
    /**
     * @param $cpf
     */

    public function index($cpf)
    {
<<<<<<< HEAD
        $cpf = TestConsult::where('cpf', '=', $cpf);

        $result = false;

        if($cpf) {
            $result = new \stdClass();
            $result->cpf  = "101.808.704-40";
            $result->nome = "Luiz Henrique Soares";
            $result->dataNascimento = '24';
            $result->sexo = "Masculono";
            $result->mae  = "Monica Maria Brito Botelho";
            $result->rg   = "454544";
            $result->telFixo1 = "(81)3432-3911";
            $result->telFixo2 = "(81)3432-3232";
            $result->telFixo3 = "(81)3432-3232";
            $result->logradouro = "Rua Maria da Conceição Viana, N1360";
            $result->complemento = "apt 202";
            $result->bairro = "Jardim Atlãntico";
            $result->cidade = "Olinda";
            $result->uf = "PE";
            $result->cep = "53050-110";
            $result->email1 = "luizhenriquesoares91@gmail.com";
            $result->email2 = "luizhenrique0377@outlook.com";
            $result->profissao = 'Analista de Sistemas';
            $result->empresa = "PSV Turismo";
            $result->renda = "Até 2SM";
        }
        return response()->json($result);

=======
        dd($cpf);
>>>>>>> funcionalidade
    }
}

