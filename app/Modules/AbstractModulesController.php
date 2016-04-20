<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 11:47
 */

namespace App\Modules;

use App\Modules\Contracts\DefaultActionsContract;
use App\Modules\Traits\Engine;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/**
 * Class AbstractModulesController
 * @package App\Modules
 */

abstract class AbstractModulesController extends Controller implements DefaultActionsContract
{

    use Engine, AuthorizesRequests,
        DispatchesJobs, ValidatesRequests;

    /**
     * AbstractModulesController constructor.
     */
    public function __construct()
    {
        $this->init();

        // Sharing is caring
        View::share('user', Auth::guard()->user());
    }
}