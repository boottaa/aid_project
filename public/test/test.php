<?php
// Replace with the real server API key from Google APIs
require __DIR__.'/../../vendor/autoload.php';


// API access key from Google API's Console
//AIDVPS
//define('API_ACCESS_KEY','AAAAXCCLNmI:APA91bFfH3ODGU5AOiYi9laZorBx5q1iHeSc7Xe1CcJeKcYbiajMlVeh0Ar3VgfOBPB8VklkIvloXY4ai6e7yGUn5m0AjGJEfVFdhin18IsikLoO6E_F415xzdJMZe5hnHunodSKbS5D');

// TEST https://peter-gribanov.github.io/serviceworker/   https://github.com/peter-gribanov/serviceworker
//define('API_ACCESS_KEY','AAAAaGQ_q2M:APA91bGCEOduj8HM6gP24w2LEnesqM2zkL_qx2PJUSBjjeGSdJhCrDoJf_WbT7wpQZrynHlESAoZ1VHX9Nro6W_tqpJ3Aw-A292SVe_4Ho7tJQCQxSezDCoJsnqXjoaouMYIwr34vZTs');

$url = 'https://fcm.googleapis.com/fcm/send';
$registrationIds = array($_GET['id']);
// prepare the message
$message = array(
    'title'     => 'This is a title.',
    'body'      => 'Here is a message.',
    'vibrate'   => 1,
    'sound'      => 1
);
$fields = [
//    "registration_ids" => [
//        "YOUR-TOKEN-ID-1",
//        "YOUR-TOKEN-ID-2",
//        "YOUR-TOKEN-ID-3",
//    ],
//    "to" => "/topics/foo-bar",
    "registration_ids" => [
        "ffquIwrs5dA:APA91bH7sCiONJETz4JPhwOLnh4BRiSUDoemq_tHxsFqZPUVLA5Ym6Tp7VtxbBZw2kPkWxxh3ZWZH3r3a0G92p0sPGoDGHnTChOs01Y5LHiH_sdmrJ7-qMnF29T1u2Xx6acU7FbIlPV6"
    ],
    'notification' => [
        'title' => 'Ералаш',
        'body' => sprintf('Начало в %s.', date('H:i')),
        'icon' => 'https://eralash.ru.rsz.io/sites/all/themes/eralash_v5/logo.png?width=192&height=192',
        'click_action' => 'http://eralash.ru/',
    ],
];
$headers = array(
    'Authorization: key='.API_ACCESS_KEY,
    'Content-Type: application/json'
);
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL,$url);
curl_setopt( $ch,CURLOPT_POST,true);
curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);
echo $result;


?>