<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:09
 */

namespace App\Modules\Traits;

use Illuminate\Http\Request;

/**
 * Class AbstractMethods
 *
 * @package App\Modules\Traits
 */
trait AbstractMethods
{
    /**
     * Remove completamente o item passado
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return mixed
     */
    abstract protected function destroy(Request $request, $id);

    /**
     * Restaura o item
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $id
     *
     * @return mixed
     */
    abstract protected function restore(Request $request, $id);
}