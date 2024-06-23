<?php
// Initialize curl session
$meter_domain = "gayu.metered.live";
$secretKey=  "ZjbXQJiPTOZ6EW-fcSjlCiC8p5MAoBtLE02coFbwCm_J1Yg4";
$currentDate = date("j_F_Y_Hi");

$ch = curl_init();
$yourData = array(
	"roomName" => "room_".$currentDate,
	// "roomName" => "room1",
	"privacy"=> "public",
	"expireUnixSec" => 1735689600,
	"ejectAtRoomExp"=> false,
	"notBeforeUnixSec"=> 0,
	"maxParticipants"=> 0,
	"autoJoin"=> false,
	"enableRequestToJoin"=> true,
	"enableChat"=> true,
	// "enableRecording"=> true,
	"recordRoom"=> true,
	"enableScreenSharing"=> true,
	"joinVideoOn"=> false,
	"joinAudioOn"=> false,
	"ejectAfterElapsedTimeInSec"=> 0,
	"meetingJoinWebhook"=> "string",
	"endMeetingAfterNoActivityInSec"=> 0,
	"audioOnlyRoom"=> false
);
// Set curl options
curl_setopt($ch, CURLOPT_URL, 'https://'.$meter_domain.'/api/v1/room?secretKey='.$secretKey); // Set the URL
curl_setopt($ch, CURLOPT_POST, true); // Set as POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($yourData)); // Set POST data (if needed)
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Accept: application/json'
	// Add more headers as needed
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
// Execute the curl session
$result = curl_exec($ch);

// Check for errors
$success = 0;
$result_arr = [];
if ($result === false) {
	// echo 'Curl error: ' . curl_error($ch);
	$result_arr = curl_error($ch);
} else {
	// Process the response
	$success = 1;
	$result_arr = $result;
	// print_r($result_arr);
	// email code here
	// create link -
}

// Close the curl session
curl_close($ch);
$return_arr = ["success"=>$success,"result_arr"=>$result_arr];
echo json_encode($return_arr);
exit;

?>
