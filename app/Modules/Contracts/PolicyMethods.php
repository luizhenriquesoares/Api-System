<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 25/02/16
 * Time: 10:56
 */

namespace App\Modules\Contracts;

use App\Modules\Models\Authorization;
use App\Modules\Models\User;

/**
 * Interface PolicyMethods
 * @package App\Modules\Contracts
 */
interface PolicyMethods
{
    /**
     * Regras para salvamento
     *
     * @param User $user
     * @param Authorization $authorization
     * @return mixed
     */
    public function store(User $user, Authorization $authorization);

    /**
     * Regras para atualização
     *
     * @param User $user
     * @param Authorization $authorization
     * @return mixed
     */
    public function update(User $user, Authorization $authorization);

    /**
     * Regras para remover completamente
     *
     * @param User $user
     * @param Authorization $authorization
     * @return mixed
     */
    public function destroy(User $user, Authorization $authorization);

    /**
     * Regras para enviar para o lixo
     *
     * @param User $user
     * @param Authorization $authorization
     * @return mixed
     */
    public function trash(User $user, Authorization $authorization);

    /**
     * Regras para visualização
     *
     * @param User $user
     * @param Authorization $authorization
     * @return mixed
     */
    public function show(User $user, Authorization $authorization);
}