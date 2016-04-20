<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 12/02/16
 * Time: 10:50
 */

namespace App\Modules\Exceptions\CreateException;

/**
 * Class RuntimeCreateException
 * @package App\Modules\Exceptions\CreateException
 */
class RuntimeCreateException extends \Exception
{
    /**
     * RuntimeCreateException constructor.
     * @param int|string $message
     * @param int|string $code
     */
    public function __construct($message    = CreateErrorBag::CODE_ERROR_DEFAULT,
                                $code       = CreateErrorBag::MESSAGE_ERROR_DEFAULT)
    {
        parent::__construct($message, $code);
    }
}