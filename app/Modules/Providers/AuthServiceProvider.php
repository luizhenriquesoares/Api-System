<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 25/02/16
 * Time: 10:25
 */

namespace App\Modules\Providers;

use App\Modules\Models\Role;
use App\Modules\Models\User;
use App\Modules\Policies\AbstractUserPolicy;
use App\Modules\Policies\RolePolicy;
use App\Modules\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

/**
 * Class AuthServiceProvider
 * @package App\Modules\Providers
 */
class AuthServiceProvider extends AbstractUserPolicy
{
    /**
     * Regras de autorização
     * @var array $policies
     */
    protected $policies =   [
                                User::class => UserPolicy::class,/*
                                Role::class => RolePolicy::class*/
                            ];

    /**
     * @param GateContract $gate
     */
    public function boot(GateContract $gate)
    {
        /*$this->registerPolicies($gate);

        $rules = ['store', 'update', 'show', 'trash', 'destroy'];

        $this->defineRules($gate, $rules);*/

    }
}