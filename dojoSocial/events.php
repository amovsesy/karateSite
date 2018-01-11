<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>.: DOJO-USA :.</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>