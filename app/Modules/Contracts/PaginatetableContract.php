<?php
/**
 * Created by PhpStorm.
 * User: geovanny
 * Date: 11/03/16
 * Time: 22:50
 */

namespace App\Modules\Contracts;
use Illuminate\Http\Request;

/**
 * Interface PaginatetableContract
 *
 * @package App\Modules\Contracts
 */
interface PaginatetableContract
{
    /**
     * Página atual
     * @param integer $page
     *
     * @return mixed
     */
    public function paginate(Request $request);
}