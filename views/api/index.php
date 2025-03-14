<?php

use app\models\Api;

$data = $api->getCalls(['period_from' => '05.09.2024 00:00', 'period_to' => '07.09.2024 23:59']);
/*echo "<pre>";
print_r($data);
echo "</pre>";
exit;*/
$custom = [];
if($data && $data['data']) {
    foreach($data['data'] as $item) {
        $date = date('d.m.Y', strtotime($item['time']));
        if(!isset($custom[$date])) {
            $custom[$date] = 0;
        }
        $custom[$date]++;
    }
}
echo "<pre>";
print_r($custom);
echo "</pre>";
exit;
//$data = $api->getClinics();
//$data = $api->getUsers();
//$data = $api->getAdvChannels();
/*$data = $api->getAppointments(['date_from' => '01.12.2024 00:00', 'date_to' => '31.12.2024 23:59', 'status' => '1,2,3,4']);
$customData = [];
if($data && $data['error'] == 0) {
    foreach($data['data'] as $item) {
        if($item['original_author_id'] == 6691) {
            $customData[] = $item;
        }
    }
}*/
//$data = $api->getServiceCategories(['show_deleted' => true]);
//$data = $api->getAppointments(['appointment_id' => 21889861]);


echo "<pre>";
print_r($data);
echo "</pre>";

?>
