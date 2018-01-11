<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('data.php');

getBeltProgressionData();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>.: DOJO-USA :. Belt Progression</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/beltProgression.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
      
        <?php
          $i = 0;
          foreach ($beltprogression as $progress)
          {
            if ($i != 0) echo '<hr />';
            echo '<div class="progress">';
            $i++;
              echo '<div class="upgrade">';
                echo '<img src="', $progress["frombeltimg"], '" />';
                echo '<img class="arrow" src="images/down_arrow.png" />';
                echo '<img src="', $progress["tobeltimg"], '" />';
              echo '</div>';
              echo '<div class="requirements">';
                echo '<div class="overview">';
                  echo '<ol>';
                    foreach($progress["overview"] as $category => $requirements)
                    {
                      echo '<li>';
                        $categories = explode("::", $category);
                        $reqs = explode("::", $requirements);
                        
                        for($i = 0; $i < count($categories); $i++)
                        {
                          if($i != 0)
                          {
                            echo '<br />';
                          }
                          
                          if(strcmp ("none",$categories[$i]) != 0)
                          {
                            echo '<span class="category">',$categories[$i],':</span> ';
                          }
                          
                          echo $reqs[$i];
                        }
                      echo '</li>';
                    }
                    if(strcmp($progress["tobeltimg"], "images/black_belt.png") == 0)
                    {
                      echo '<li><span class="category">Giving Back:</span> 50 hours jr. instruction, 500 Random Acts of Kindness logged on <a href="http://www.911aok.com" target="_blank">www.911aok.com</a></li>';
                    }
                  echo '</ol>';
                  if(!empty($progress["beltquote"]))
                  {
                    echo '<div class="beltquote">';
                      echo '<img class="open" src="images/openQuote.png" />';
                      echo '<p>', $progress["beltquote"], '</p>';
                      echo '<img class="close" src="images/closeQuote.png" />';
                    echo '</div>';
                  }
                echo '</div>';
                if(!empty($progress["stripe1"]))
                {
                  echo '<ul>';
                    echo '<li class="stripe stripe1">';
                      echo '<ul>';
                        foreach(explode("::", $progress["stripe1"]) as $req)
                        {
                          echo '<li>', $req, '</li>';
                        }
                      echo '</ul>';
                    echo '</li>';
                    if(!empty($progress["stripe2"]))
                    {
                      echo '<li class="stripe stripe2">';
                        echo '<ul>';
                          foreach(explode("::", $progress["stripe2"]) as $req)
                          {
                            echo '<li>', $req, '</li>';
                          }
                        echo '</ul>';
                      echo '</li>';
                    }
                    if(!empty($progress["stripe3"]))
                    {
                      echo '<li class="stripe stripe3">';
                        echo '<ul>';
                          foreach(explode("::", $progress["stripe3"]) as $req)
                          {
                            echo '<li>', $req, '</li>';
                          }
                        echo '</ul>';
                      echo '</li>';
                    }
                  echo '</ul>';
                }
              echo '</div>';
              echo '<p class="beltinfo">', $progress["beltinfo"], '</p>';
            echo '</div>';
          } 
        ?>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>