<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 21/03/16
 * Time: 09:11
 */

namespace App\Modules\Contracts;
use Illuminate\Http\Request;

/**
 * Interface ScopesContract
 * @package App\Modules\Contracts
 */
interface ScopesContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function scope(Request $request);
}