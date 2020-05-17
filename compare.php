<?php
// Post to steam microservice and get global stats
$postRequest = array(
    'steamId' => $_POST['steamId']
);

$cURLConnection = curl_init('35.239.38.150/globalStats');
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

$parsed_json = json_decode($apiResponse, true);
if($parsed_json == "error"){
    header("Location: /login.php");
}

require_once("tools.php");
topNav('Steam Chat - Compare Stats');
?>
<section id = globalStats>
    <table>
        <tr>
            <th>Top 10 Games Owned</th>
            <th>Top 10 Hours Wasted</th>
            <th>Top 10 Library Played</th>
        </tr>
        <tr>
            <td>
                <?php
                    foreach($parsed_json['global_game_count'] as $value)
                    {
                    echo '<div>';
                    echo '<table><tr>';
                    echo '<td><img style="display:inline-block;margin: 1px;" src='. $value['avatar_url'] . '></td>'; 
                    echo '<td><table>';
                    echo '<tr><td>' . $value['steamId'] . '</td></tr>';
                    echo '<tr><td>' . $value['game_count'] . ' games owned</td></tr>';
                    echo '</table></td>';
                    echo '</tr></table>';
                    echo '</div>';
                    }
                ?>
            </td>
            <td>
                <?php
                    foreach($parsed_json['global_playtime'] as $value)
                    {
                    echo '<div>';
                    echo '<table><tr>';
                    echo '<td><img style="display:inline-block;margin: 1px;" src='. $value['avatar_url'] . '></td>'; 
                    echo '<td><table>';
                    echo '<tr><td>' . $value['steamId'] . '</td></tr>';
                    echo '<tr><td>' . $value['playtime'] . ' hours wasted</td></tr>';
                    echo '</table></td>';
                    echo '</tr></table>';
                    echo '</div>';
                    }
                ?>
            </td>
            <td>
                <?php
                    foreach($parsed_json['global_play_percent'] as $value)
                    {
                    echo '<div>';
                    echo '<table><tr>';
                    echo '<td><img style="display:inline-block;margin: 1px;" src='. $value['avatar_url'] . '></td>'; 
                    echo '<td><table>';
                    echo '<tr><td>' . $value['steamId'] . '</td></tr>';
                    echo '<tr><td>' . $value['played_percent'] . '% played library</td></tr>';
                    echo '</table></td>';
                    echo '</tr></table>';
                    echo '</div>';
                    }
                ?>
            </td>
        </tr>    
    </table>
</section>
<?php
bottomFooter();
?>