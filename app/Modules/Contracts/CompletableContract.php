<?php
/**
     * Created by PhpStorm.
     * User: geovanny
     * Date: 06/03/16
     * Time: 10:31
     */

namespace App\Modules\Contracts;



use Illuminate\Http\Request;

interface CompletableContract
{
    /**
     * Auto complete
     *
     * @return mixed
     */
    public function complete(Request $request);
}