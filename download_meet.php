<?php
// Initialize curl session
$recording_id = $_POST['dataId'];
$meter_domain = "gayu.metered.live";
$secretKey = "ZjbXQJiPTOZ6EW-fcSjlCiC8p5MAoBtLE02coFbwCm_J1Yg4";
$ch = curl_init();
$url = 'https://'.$meter_domain.'/api/v1/recording/'.$recording_id.'/download?secretKey='.$secretKey;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json'

));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$result = curl_exec($ch);


$success = 0;
$result_arr = [];

if ($result === false) {
    $result_arr = curl_error($ch);
} else {
    $success = 1;
    $result_arr = $result;
}


curl_close($ch);


$return_arr = ["success" => $success, "result_arr" => $result_arr];


echo json_encode($return_arr);
exit;
?>
