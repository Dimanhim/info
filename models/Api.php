<?php

namespace app\models;

use yii\base\Model;
use app\components\RnovaApi;
use yii\web\NotFoundHttpException;

class Api extends Model
{
    public $user;
    public $keys;
    private $api;

    // PEOPLE
    private $request_url;
    private $apiKey;

    public function __construct($user = null)
    {
        $this->user = $user;
        $this->keys = include ('../config/keys.php');
        $this->keys = array_merge($this->keys, include('../config/projects.php'));

        if(!isset($this->keys[$this->user])) throw new NotFoundHttpException('Не существуют данные апи для '.$user);

        $this->request_url = $this->keys[$this->user]['url'] ? $this->keys[$this->user]['url'].'/api/public/' : 'https://app.rnova.org/api/public/' ;
        $this->apiKey = $this->keys[$this->user]['apiKey'];
        $this->api = new RnovaApi($this->request_url, $this->apiKey);
    }

    public function getPatient($params = [])
    {
        $data = $this->api->getRequest('getPatient', $params);
        return $data;
    }

    public function getAdvChannels($params = [])
    {
        $data = $this->api->getRequest('getAdvChannels', $params);
        return $data;
    }

    public function getClinics()
    {
        $data = $this->api->getRequest('getClinics');
        return $data;
    }

    public function getAppointments($params = [])
    {
        $data = $this->api->getRequest('v2/getAppointments', $params);
        return $data;
    }

    public function getInvoices($params = [])
    {
        $data = $this->api->getRequest('v2/getInvoices', $params);
        return $data;
    }

    public function getServiceCategories($params = [])
    {
        $data = $this->api->getRequest('getServiceCategories', $params);
        return $data;
    }

    public function getCalls($params = [])
    {
        $data = $this->api->getRequest('getCalls', $params);
        return $data;
    }

    public function getUsers($params = [])
    {
        $data = $this->api->getRequest('getUsers', $params);
        return $data;
    }

}
