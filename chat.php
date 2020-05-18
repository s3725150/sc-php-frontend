<?php
session_start();
// Post to chat microservice and get chatRoom data
$postRequest = array(
    'steamId' => $_SESSION['steamId'],
    'appId' => $_GET['appId'],
    'gameName' => $_SESSION['gameName']
);

$cURLConnection = curl_init('http://localhost:5000/chatRoom');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

curl_exec($cURLConnection);
curl_close($cURLConnection);

$parsed_json = json_decode($apiResponse, true);
if($parsed_json == "error"){
    header("Location: /");
}

require_once("tools.php");
topNav('Steam Chat - Chat');
echo "App ID= " . $_GET['appId'] . "</br>";
echo "Steam ID= " . $_SESSION['steamId'] . "</br>";
echo "Game Name=" . $_SESSION['gameName'];
echo '  // ToDO';
bottomFooter();
?>
