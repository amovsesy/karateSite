<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('data.php');

getTrainers();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>.: DOJO-USA :. Trainers</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/trainers.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <ul id="instructors">
          <?php
            foreach($trainers as $trainer)
            {
              echo '<li>';
                echo '<div class="name">';
                  echo '<img src="', $trainer['img'], '" />';
                  echo '<h1>', $trainer['name'], '</h1>';
                echo '</div>';
                echo '<div class="instructortext">';
                  if(!empty($trainer['info'])){echo '<p class="instructorInfo">', $trainer['info'], '</p>';}
                  if(!empty($trainer['quote'])){echo '<p class="quote"><img class="left" src="images/openQuote.png" />', $trainer['quote'], '<img class="right" src="images/closeQuote.png" /></p>';}
                echo '</div>';
              echo '</li>';
            } 
          ?>
        </ul>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>