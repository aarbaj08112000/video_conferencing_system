<?php
// Initialize curl session
$meter_domain = "gayu.metered.live";
$secretKey = "ZjbXQJiPTOZ6EW-fcSjlCiC8p5MAoBtLE02coFbwCm_J1Yg4";

$currentDate = date("j_F_Y_Hi");

$ch = curl_init();

// Set curl options
curl_setopt($ch, CURLOPT_URL, 'https://' . $meter_domain . '/api/v1/recordings?secretKey=' . $secretKey); // Set the URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
// Execute the curl session
$result = curl_exec($ch);

// Check for errors
$success = 0;
$result_arr = [];
if ($result === false) {
    // echo 'Curl error: ' . curl_error($ch);
    $result_arr['error'] = curl_error($ch);
} else {
    // Process the response
    $success = 1;
    $result_arr = json_decode($result, true);

    // Handle JSON decoding error
    if ($result_arr === null) {
        $result_arr['error'] = 'Error decoding JSON response';
    }
}

// Close the curl session
curl_close($ch);

$return_arr = ["success" => $success, "result_arr" => $result_arr];
echo json_encode($return_arr);
exit;
?>
