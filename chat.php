<?php
header("Access-Control-Allow-Origin: *");
session_start();
// Post to chat microservice and get chatRoom data
$_SESSION['appId'] = $_GET['appId'];
$chatPost = array(
    'appId' => $_GET['appId'],
    'gameName' => $_SESSION['gameName']
);
$chatCh = curl_init('http://localhost:5000/add_chatRoom');
curl_setopt($chatCh, CURLOPT_POSTFIELDS, $chatPost);
curl_setopt($chatCh, CURLOPT_RETURNTRANSFER, true);
curl_exec($chatCh);
curl_close($chatCh);

//$parsed_json = json_decode(curl_exec($chatCh), true);
//if($parsed_json == "error"){
//    header("Location: /");
//}

// pull values and print to the top cause why not
require_once("tools.php");
topNav('Steam Chat - Chat');
echo "App ID= " . $_GET['appId'] . "</br>";
echo "Steam ID= " . $_SESSION['steamId'] . "</br>";
echo "Game Name=" . $_SESSION['gameName']. "</br>";

//Post a message to backend
//$messagePost = array(
//    'steamId' => $_SESSION['steamId'],
//    'appId' => $_GET['appId']
//);
?>
<form id="sendForm" class=form-group">
    <input type="text" name="message" placeholder="Enter Message">
    <input type="hidden" name="appId" value="<?php echo $_SESSION['appId']?>">
    <input type="hidden" name="steamId" value="<?php echo $_SESSION['steamId']?>">
    <button value="submit" type="submit">Send</button>
</form>

<?php
// $messageCh = curl_init('http://localhost:5000/sendMessage');
// curl_setopt($messageCh, CURLOPT_POSTFIELDS, $messagePost);
// curl_exec($messageCh);
// curl_close($messageCh);
bottomFooter();
?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script type='text/javascript'>
    <?php echo $_SESSION['steamId']?>;
    <?php echo $_SESSION['appId']?>;

     $(document).on('ready', function(e) {
         e.preventDefault();
         e.stopImmediatePropagation();
        $('form').on("submit", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                headers: {'Access-Control-Allow-Origin' : '*'},
                url: "http://localhost:5000/sendMessage",
                data: $('form').serialize(),
                type : 'POST'
            })
            this.reset();

        })

    })

</script>
