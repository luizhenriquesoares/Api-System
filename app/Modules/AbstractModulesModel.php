<?php
/**
 * Created by PhpStorm.
 * User: geovannylcoutinho
 * Date: 18/01/16
 * Time: 13:28
 */

namespace App\Modules;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Class AbstractModulesModel
 * @package App\Modules
 */
abstract class AbstractModulesModel extends Model
{
    /**
     * Campos configuráveis para serem condicionados a uma pesquisa com termo LIKE para comparação
     *
     * @var array
     */
    protected $completables = [];

    /**
     * Campos pesquisáveis
     *
     * @var array
     */
    protected $searchables = [];

    /**
     * Exclusão Lógica
     * @var SoftDeletes
     */

    use SoftDeletes;

    /**
     * Mutators [Modificadores]
     * @var array
     */

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Obtém o model com Namespace
     * @param $model
     * @return string
     */
    protected function getModel($model)
    {
        return __NAMESPACE__ . "\\" . $model;
    }

    /**
     * Obtém todos os dados ativos
     *
     * @param $query AbstractModulesModel
     * @return mixed
     */
    public function scopeAllActive($query)
    {
        return $query->where('status', '=', ATIVO)->get();
    }

	/**
	 * Obtém a data convertendo-a em \DateTime
	 * @param $value
	 *
	 * @return \DateTime
	 */
    public function getCreatedAtAttribute($value)
    {
        $date = new \DateTime($value);
        return $date->format('d/m/Y H:i');
    }

	/**
	 * Obtém a data convertendo-a em \DateTime
	 *
	 * @param $value
	 *
	 * @return \DateTime
	 */
    public  function  getDeletedAtAttribute($value)
    {
        return new \DateTime($value);
    }

	/**
	 * Obtém a data convertendo-a em \DateTime
	 *
	 * @param $value
	 *
	 * @return \DateTime
	 */
    public function getUpdatedAtAttribute($value)
    {
        $date = new \DateTime($value);
        return $date->format('d/m/Y H:i');
    }

    /**
     * @param $query   Builder
     * @param $request
     *
     * @return mixed
     */
    public function scopeCompletable($query, Request $request)
    {
        foreach($this->searchables as $i => $seachable)
        {
            if($i>1)
                $query .= $query->orWhere($seachable, 'LIKE', "%{$request->input('q')}%");
            else
                $query->where($seachable, 'LIKE', "%{$request->input('q')}%");
        }
        return $query->get($this->completables);
    }

    /**
     * @param $query Builder
     * @param array $conditions
     * @param array $args
     * @return mixed
     */
    public function scopeDoPaginationConditions($query, $conditions = [], $args = [])
    {
        if(count($args) > 0)
        {
           if(isset($args['start']) && isset($args['length']) && !isset($args['search']))
           {
               return $query->skip($args['start'])
                           ->take($args['length'])
                           ->where($conditions['default']['column'], $conditions['default']['operator'], $conditions['default']['value'])->get();
           }

            if(isset($args['search']) && !(isset($args['start']) && isset($args['length'])))
            {
                return $query->orWhere(function($query) use ($conditions, $args)
                                        {
                                            $search = $args['search'];
                                            foreach($conditions as $key => $condition)
                                            {
                                                if($key != "default")
                                                {
                                                    $query->orWhere($condition['column'], $condition['operator'], "%{$search}%");
                                                }
                                            }
                                        })->where($conditions['default']['column'],
                                                $conditions['default']['operator'],
                                                $conditions['default']['value'])
                                        ->get();
            }

        }
    }

    public function isActive()
    {
        return (boolean) ((int) $this->status == 1);
    }

}