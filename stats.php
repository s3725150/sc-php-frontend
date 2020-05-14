<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="stylesheets/styles.css">
</head>
<body>
<h1> Steam Chat </h1>
<?php

$postRequest = array(
    'steamId' => $_POST['steamId']
);

$cURLConnection = curl_init('35.239.38.150/addUser');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);


//Sort through the data
$parsed_json = json_decode($apiResponse, true);
echo '<br>';
echo $parsed_json['name'];
echo '<br>';
echo 'Playtime in hours: ';
echo $parsed_json['playtime'];
echo '<br>';
echo '<div>';
echo '<img style="display:inline-block;margin: 1px;" src='. $parsed_json['avatar'] . '>'; 
echo '</div>';
?>
</body>
</html>
