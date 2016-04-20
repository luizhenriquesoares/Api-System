<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 25/02/16
 * Time: 14:23
 */

namespace App\Modules\Policies;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AbstractUserPolicy extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register the application's policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function registerPolicies(GateContract $gate)
    {
        foreach ($this->policies as $key => $value) {
            $gate->policy($key, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register() { }

    /**
     * Define as regras
     *
     * @param $gate
     * @param $rules
     */
    protected function defineRules($gate, $rules)
    {
        for($i = 0; $i < count($rules); $i++)
        {
            foreach($this->policies as $key => $policy)
            {
                $gate->define($rules[$i], $policy . '@' . $rules[$i]);
            }
        }
    }
}
