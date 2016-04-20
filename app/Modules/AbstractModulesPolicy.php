<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 25/02/16
 * Time: 11:18
 */

namespace App\Modules;
use App\Modules\Models\User;

/**
 * Class AbstractModulesPolicy
 * @package App\Modules
 */
abstract class AbstractModulesPolicy
{
    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function trash(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function show(User $user)
    {
        if($user->authorizations->count())
            return (boolean) ((int) $user->id === (int) $user->authorizations->users_id);
    }
}