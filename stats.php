<?php
require_once("tools.php");
topNav('Steam Chat - My Stats');

$postRequest = array(
    'steamId' => $_POST['steamId']
);

$cURLConnection = curl_init('35.239.38.150/myStats');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);
?>

<section>
<?php
//Sort through the data
$parsed_json = json_decode($apiResponse, true);
echo '<div>';
echo '<img style="display:inline-block;margin: 1px;" src='. $parsed_json['avatar'] . '>'; 
echo '</div>';
echo '<br>';
echo $parsed_json['name'];
echo '<br>';
echo 'Playtime in hours: ';
echo $parsed_json['playtime'];
echo '<br>';
echo 'Total Owned Games: ';
echo $parsed_json['total'];
echo '<br>';
echo 'Unplayed Games (<10mins): ';
echo $parsed_json['unplayed'];
echo '<br>';
echo 'Thats ';
echo $parsed_json['unplayed_percent'];
echo '% of your games that are practically unplayed!';
echo '<br>';
echo '<br>';
echo 'These are you 10 most played games:';
echo '<br>';
echo '<br>';

foreach($parsed_json['topPlayed'] as $value)
{
  echo $value['name'];
  echo '   -   Playtime: ';
  echo $value['playtime'];
  echo '<br>';
}
?>
<div>
<form class = steamIdForm action="/compare.php" method="post">
    <?php
      echo '<input type="hidden" id="steamId" name="steamId" value="' . $_POST['steamId'] . '" required><br>';
    ?>
    <input type="submit" class = "button" value="Compare with friends">
  </form>
</div>
</section>

<?php
bottomFooter();
?>