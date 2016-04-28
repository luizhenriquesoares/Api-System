<?php
/**
 * Created by PhpStorm.
 * User: geovanny
 * Date: 25/03/16
 * Time: 17:44
 */

namespace App\Modules\Traits;

use App\Modules\Models\Config;
use App\Modules\Models\Counter;
use App\Modules\Models\Search;

/**
 * Class Behaviors
 *
 * @package App\Modules\Traits
 */
trait Behaviors
{
    /**
     * Inicia o contador de consultas por usuários
     */
    private function countSearchs()
    {
        /** @var Search $model */
        $model = Search::class;

        $model::created(function($data)
        {
            $config = Config::with(['users' => function ($query) {
                $query->where('id', '=', \Auth::user()->id);
            }])->get();

            $attributes = ['configs_id' => $config->first()->id, 'users_id' => \Auth::user()->id];

            $this->countCreate($attributes);

        });
    }

    /**
     * @param array $attributes
     *
     * @return static
     */
    final private function countCreate(Array $attributes = [])
    {
        try
        {
            $counter = new Counter();

            $model = $counter->getByComposeKey($attributes);

            if($model->count() > 0)
            {
                $model->first()->quantity += 1;
                return $model->first()->update();
            }
            else
            {
                return $counter->create($attributes);
            }
        }
        catch(\Exception $e)
        {
            echo "Exception - Behaviors - CountCreate";
            dd($e);
        }
    }
}