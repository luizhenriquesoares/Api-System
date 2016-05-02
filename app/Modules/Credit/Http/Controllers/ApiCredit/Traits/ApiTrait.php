<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 24/04/2016
 * Time: 18:45
 */
namespace App\Modules\Credit\Http\Controllers\ApiCredit\Traits;

use App\Modules\Models\Api;
use GuzzleHttp\Client;

/**
 * Class AssertivaTrait
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Traits
 */
trait ApiTrait
{
    protected $api;
    
    protected $client;
    /**
     * AssertivaTrait constructor.
     * @param Client $client
     */
    public function __construct(Client $client, Api $api)
    {
        $this->client = $client;
        $this->api    = $api;
    }
    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
     public function postRequest($data)
    {
        $api = $this->api->getApi();

        try {
            $response = $this->client->request('POST', $api->url . '&documento=' . $data)->getBody();
            return $response;
        } catch (\Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }
    }
    /**
     * @param $data
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getRequest($data)
    {
        $api = $this->api->getApi();

        try {
            $response = $this->client->request('GET', $api->url . '&documento=' . $data)->getBody();
            return $response;
        } catch (\Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }

    }
}