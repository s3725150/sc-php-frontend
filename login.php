<?php
require_once("tools.php");
topNav('Steam Chat');
?>

<section>
  <div> Hi! Here try using my steamId - 76561198038149325 </div>
</section>
<div>
<form class = steamIdForm action="/search.php" method="post">
    <label for="steamId">Steam ID:</label><br>
    http://steamcommunity.com/profiles/
    <input type="text" id="steamId" name="steamId" required><br>
    <input type="submit" class = "button" value="Chat About Games!">
    <input type="submit" class = "button"value="Wasted on Steam?" formaction="/stats.php">
  </form>
</div>

<?php
bottomFooter();
?>
