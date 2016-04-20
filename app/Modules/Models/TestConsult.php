<?php

/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 20/04/16
 * Time: 11:18
 */

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestConsult extends Model
{
    /**
     * @var string
     */
    protected $table = "test_consult";
    /**
     * @var array
     */
    protected $fillable =  [
        'cpf'
    ];
}