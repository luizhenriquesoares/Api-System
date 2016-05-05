<?php
/**
 * Created by PhpStorm.
 * User: Luiz Henrique Soares
 * Date: 04/05/16
 * Time: 12:13
 */
namespace App\Modules\Credit\Http\Controllers\ApiCredit\Contracts;
use App\Modules\Models\Api;
use GuzzleHttp\Client;

/**
 * Class ApiAbstract
 * @package App\Modules\Credit\Http\Controllers\ApiCredit\Contracts
 */
abstract class ApiAbstract
{
    /**
     * @var Api
     */
    protected $api;
    /**
     * @var Client
     */
    protected $client;
    /**
     * ApiAbstract constructor.
     * 
     * @param Client $client
     * @param Api $api
     */
    public function __construct(Client $client, Api $api)
    {
        $this->client = $client;
        $this->api    = $api;
    }
    /**
     * Método faz uma Request por Post na API
     * 
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
     * Método faz uma Request por GET na API
     * 
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