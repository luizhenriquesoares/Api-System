<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:09
 */

namespace App\Modules\Contracts;


interface DefaultCrudActionsContract
{
    /**
     * Cria
     * @return mixed
     */
    public function create();

    /**
     * Editar
     * @param $id
     * @return mixed
     */
    public function edit($id);
}