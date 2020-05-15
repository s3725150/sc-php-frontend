<?php
require_once("tools.php");
topNav('Steam Chat - My Games');

echo $_POST['steamId'];

// Post to steam microservice and get list of games owned by user
$postRequest = array(
    'steamId' => $_POST['steamId']
);

$cURLConnection = curl_init('35.239.38.150/gameList');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);
?>

<input type="text" id="searchInput" onkeyup="searchGames()" placeholder="Search for a game..">
<div id = gamesContainer>
  <ul id="gamesList">
  <?php
  //Sort through the data
  $parsed_json = json_decode($apiResponse, true);
  $parsed_json = $parsed_json['games'];
  foreach($parsed_json as $key => $value)
  {
    if($value['img_logo_url'] != '')
    {
      echo '<li><a href="/chat.php?appId=' . $value['appid'] . '" onclick="post">';
      echo '<img src="http://media.steampowered.com/steamcommunity/public/images/apps/' . $value['appid'] . '/' . $value['img_logo_url'] . '.jpg" alt="'.$value['name'].'">'; 
      echo '</a></li>';
    }
  }
  ?>
  </ul>
</div>

<?php
bottomFooter();
?>

<script>
function searchGames() {
  // Declare variables
  var input, filter, ul, li, img, i, altTxtValue;
  input = document.getElementById('searchInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("gamesList");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    img = li[i].getElementsByTagName("img")[0];
    altTxtValue = img.alt;
    if (altTxtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>
