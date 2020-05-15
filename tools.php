<?php
function topNav($pageTitle){
echo <<<DOC
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="stylesheets/styles.css">
  <meta charset="utf-8">
  <title>$pageTitle</title>
</head>
<body>
    <header>
    <nav class="main-nav">
        <a href="/">Steam Chat</a>
    </nav>
</header>
DOC;
}

function bottomFooter(){
echo <<<DOC
<footer>
    <div> Luke Shuster s3725150 & Craig Slack sXXXXXXX</div>
</footer>
</body>
</html>
DOC;
}
?>