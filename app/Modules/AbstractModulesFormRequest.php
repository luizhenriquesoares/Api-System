<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 14:11
 */

namespace App\Modules;

use App\Modules\Contracts\DefaultMethodsFormRequest;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AbstractModulesFormRequest
 * @package App\Modules
 */
abstract class AbstractModulesFormRequest extends FormRequest implements DefaultMethodsFormRequest
{
}