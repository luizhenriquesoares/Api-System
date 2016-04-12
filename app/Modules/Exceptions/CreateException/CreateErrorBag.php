<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 12/02/16
 * Time: 10:51
 */

namespace App\Modules\Exceptions\CreateException;


/**
 * Class CreateErrorBag
 * @package App\Modules\Exceptions\CreateException
 */
class CreateErrorBag
{
    /**
     * Mensagem padrão de error
     * @const MESSAGE_ERROR_DEFAULT
     * @var string MESSAGE_ERROR_DEFAULT
     */
    const MESSAGE_ERROR_DEFAULT = 'Não foi possível concluir a sua solicitação.';

    /**
     * Mensagem código padrão de error
     * @const CODE_ERROR_DEFAULT
     * @var string CODE_ERROR_DEFAULT
     */
    const CODE_ERROR_DEFAULT    = 0001;

    /**
     * CreateErrorBag constructor.
     */
    private function __construct() {}

}