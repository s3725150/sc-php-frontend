<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="stylesheets/styles.css">
</head>
<body>
<h1> Steam Chat </h1>
<div> Hi! Here try using my steamId - 76561198038149325 </div>
<form id = loginform action="/search.php" method="post">
  <label for="steamId">Steam ID:</label><br>
  http://steamcommunity.com/profiles/
  <input type="text" id="steamId" name="steamId" required><br>
  <input type="submit" class = "button" value="Chat About Games!">
  <input type="submit" class = "button"value="Wasted on Steam?" formaction="/stats.php">
</form>
</body>
</html>