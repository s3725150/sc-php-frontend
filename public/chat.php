<?php
header("Access-Control-Allow-Origin: *");
session_start();
// Post to chat microservice and get chatRoom data
$_SESSION['appId'] = $_GET['appId'];
//$chatPost = array(
//    'appId' => $_GET['appId'],
//    'gameName' => $_SESSION['gameName']
//);
//$chatCh = curl_init('http://localhost:5000/add_chatRoom');
//curl_setopt($chatCh, CURLOPT_POSTFIELDS, $chatPost);
//curl_setopt($chatCh, CURLOPT_RETURNTRANSFER, true);
//
//$jsonResponse = curl_exec($chatCh);
//
//curl_close($chatCh);
//$parsed_json = json_decode($jsonResponse, true);

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
<section id="myStats">
    <div>
        Chat
        <table id="chatMessage">
        </table>
    </div>
    <form id="sendForm" class="form-group" style="position: fixed; bottom: 10%; width: 100%">
        <input type="text" name="message" placeholder="Enter Message">
        <input type="hidden" name="appId" value="<?php echo $_SESSION['appId']?>">
        <input type="hidden" name="steamId" value="<?php echo $_SESSION['steamId']?>">
        <button value="submit" type="submit">Send</button>
    </form>
</section>
<?php
// $messageCh = curl_init('http://localhost:5000/sendMessage');
// curl_setopt($messageCh, CURLOPT_POSTFIELDS, $messagePost);
// curl_exec($messageCh);
// curl_close($messageCh);
bottomFooter();
?>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

<script type='text/javascript'>
    <?php echo $_SESSION['steamId']?>;
    <?php echo $_SESSION['appId']?>;

     $(document).on('ready', function(e) {
         e.preventDefault();
         e.stopImmediatePropagation();
        $('#sendForm').on("submit", function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({
                headers: {'Access-Control-Allow-Origin' : '*'},
                url: "https://steamchat-ms.xyz/chat/sendMessage",
                data: $('form').serialize(),
                type : 'POST'
            })
            this.reset();
        })
         $.ajax({
             headers: {'Access-Control-Allow-Origin' : '*'},
             url: 'https://steamchat-ms.xyz/chat/add_chatRoom',
             data: $('form').serialize(),
             type: "POST",
             success: function (data){
                 $.each(data, function(i, item){
                     var $tr = $('<tr>').append(
                         $('<td>').text(item.steamId),
                         $('<td>').text(item.displayTime),
                         $('<td>').text(item.message)
                     ).appendTo('#chatMessage')
                 })
                 console.log(data)
             }
         })
         pollServer()
         function pollServer() {
             var isActive = true;
             if (isActive) {
                 window.setTimeout(function(){
                     $.ajax({
                         headers: {'Access-Control-Allow-Origin': '*'},
                         url: 'https://steamchat-ms.xyz/chat/updateChat',
                         type: "POST",
                         success: function (data){
                             $.each(data, function(i, item){
                                 var $tr = $('<tr>').append(
                                     $('<td>').text(item.steamId),
                                     $('<td>').text(item.displayTime),
                                     $('<td>').text(item.message)
                                 ).appendTo('#chatMessage')
                             })
                             console.log(data)
                             pollServer()
                         }
                     })
                 }, 2500);
             }
         }
    })
//    javascript jazz



</script>
