<?php
require_once("tools.php");
topNav('Steam Chat');

$cURLConnection = curl_init();
curl_setopt($cURLConnection, CURLOPT_URL, '35.239.38.150/popularGame');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

$parsed_json= json_decode($apiResponse, true);
?>

<section>
  <div> Hi! Here try using my steamId - 76561198038149325 </div>
  <div>
    <span>
      <?php
        echo 'Total Users of Steam Chat:  ' . $parsed_json['total_users'];
      ?>
    </span>
    <div>
      <div>Most Popular Game</div>
      <div>
        <table><tr>
          <td>
            <?php
              echo '<img src="' . $parsed_json['popular_game'][0]['img_logo_url'] . '" alt="' . $parsed_json['popular_game'][0]['name'] . '">';
            ?>
          </td>
          <td>
            <table>
              <tr><td>
                <?php
                  echo $parsed_json['popular_game'][0]['name'];
                ?>
              </td></tr>
              <tr><td>
                <?php
                  echo $parsed_json['popular_game'][0]['playtime'];
                ?>
              </td></tr>
              <tr><td>
                <?php
                  echo $parsed_json['popular_game'][0]['count'];
                ?>
              </td></tr>
            </table>
          </td>
        </tr></table>
      </div>
    </div>
  </div>
</section>
<div>
<form class = steamIdForm action="/search.php" method="post">
    <div>
      <label for="steamId">Steam ID:</label><br>
      http://steamcommunity.com/profiles/
      <input type="text" id="steamId" name="steamId" required><br>
    </div>
    <input type="submit" class = "button" value="Chat About Games!">
    <input type="submit" class = "button"value="Wasted on Steam?" formaction="/stats.php">
  </form>
</div>

<?php
bottomFooter();
?>
