<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 28/01/16
 * Time: 14:48
 */

namespace App\Modules\ApiManager\Http\Traits\Utils;


trait FlashMessages
{

    /**
     * Mensagem de retorno
     * @var $message array
     */
    private $message = [];

    /**
     * Importância da mensagem
     * @var $important bool
     */
    private $important = false;

    /**
     * Classe CSS do retorno
     * @var $class string
     */
    private $class;

    public function setMessage($message, $success, $important)
    {
        $this->message[$success]        = $message;
        $this->important                = $important;
    }

    /**
     * @param string $type
     * @param string $success
     * @return $this
     */
    public function getMessage($type = 'store', $success = 'success')
    {
        $this->getTypeMessage($type, $success);
        return $this->message;
    }

    /**
     * @param $type
     * @param $success
     */
    final private function getTypeMessage($type, $success)
    {
        switch(strtolower($type)):

            case "store":

                if($success == 'success')
                {
                    $this->message['msg']       = "Registro inserido com sucesso.";
                    $this->message['success']   = true;
                }
                else
                {
                    $this->message['success']   = false;
                    $this->message['msg']       = "Registro não pode ser inserido.";
                }
                break;

            case "update":

                if($success == 'success')
                {
                    $this->message['msg']       = "Registro alterado com sucesso.";
                    $this->message['success']   = true;
                }
                else
                {
                    $this->message['success']   = false;
                    $this->message['msg']       = "Registror não pode ser alterado.";
                }

                break;

            case "destroy":

                if($success == 'success')
                {
                    $this->message['success']   = true;
                    $this->message['msg']       = "Registro removido com sucesso.";
                }
                else
                {
                    $this->message['success']   = false;
                    $this->message['msg']       = "Registro não pode ser removido.";
                }

            break;

            case "trash":

                if($success == 'success')
                {
                    $this->message['success']   = true;
                    $this->message['msg']       = "Registro enviado para lixeira com sucesso";
                }
                else
                {
                    $this->message['success']   = false;
                    $this->message['msg']       = "Registro não pode ser enviado para lixeira.";
                }

            break;

            default:
                $this->message['success']   = true;
                $this->message['msg']       = "Operação realizada com sucesso.";
                break;

        endswitch;

        if($success == 'success')
            $this->class = 'alert alert-success';
        else
            $this->class = 'alert alert-danger';

    }
}