<?php

use app\models\Api;

//$data = $api->getCalls(['period_from' => '09.09.2024 00:00', 'period_to' => '09.10.2024 23:59']);
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
$data = $api->getServiceCategories(['show_deleted' => true]);

echo "<pre>";
print_r($data);
echo "</pre>";

?>
