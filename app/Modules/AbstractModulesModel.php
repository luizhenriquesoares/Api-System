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

    public function isActive()
    {
        return (boolean) ((int) $this->status == 1);
    }

}