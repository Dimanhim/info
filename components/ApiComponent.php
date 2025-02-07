<?php

namespace app\components;

use app\components\BaseComponent;
use yii\base\Component;
use app\components\RnovaApi;

class ApiComponent extends BaseComponent
{
    private $api;

    const STATUS_ID_WRITED = 1;     // записан
    const STATUS_ID_WAIT   = 2;     // ожидает
    const STATUS_ID_BUSY   = 3;     // на приеме  upcoming

    /**
     *
     */
    public function init()
    {
        $this->api = new RnovaApi($_ENV['MIS_REQUEST_API_URL'], $_ENV['MIS_API_KEY']);
        return parent::init();
    }

    public function getClinics()
    {
        return $this->api->getRequest('getClinics');
    }

    public function getAppointments($params = [])
    {
        return $this->api->getRequest('getAppointments', $params);
    }

    public function getPatient($params = [])
    {
        return $this->api->getRequest('getPatient', $params);
    }

    public function confirmAppointment($params = [])
    {
        return $this->api->getRequest('confirmAppointment', $params);
    }

    public function cancelAppointment($params = [])
    {
        return $this->api->getRequest('cancelAppointment', $params);
    }

    public function uploadFile($params = [])
    {
        return $this->api->getRequest('uploadFile', $params);
    }
}
