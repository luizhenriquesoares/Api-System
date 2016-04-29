<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 29/04/16
 * Time: 11:34
 */
namespace App\Modules\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Api
 * @package App\Modules\Models
 */
class Api extends Model
{
    /**
     * @var string table Api Config
     */
    protected $table = 'api_credit';

    protected $fillable = ['name','url','company','user','password'];
    /**
     * @return retorna tabela de configuração da APICredit 
     * Se Status For ativado = 1
     */
    public function getApi()
    {
        $data = Api::where('status', '=', '1')->first();
    }
    
    

}