<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('data.php');

$fid = $_GET['fid'];

if(!empty($fid))
{
  getVideosForFolder($fid);
}
else 
{
  getVideoFolders();
}

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
    <link rel="stylesheet" href="css/videolightbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/overlay-minimal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/videos.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/swfobject.js"></script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <?php
          if(!empty($fid))
          {
            echo '<p class="back"><a href="videos.php">Go back to folders</a></p>';
          }
          if(!empty($folders))
          {
            echo '<table>';
            $i=0;
            foreach($folders as $folder)
            {
              getFirstVideoThumbnailOfFolder($folder["id"]);
              if($i == 0)
              {
                echo "<tr>";
              }
              
              echo "<td>";
                echo '<a href="videos.php?fid=', $folder["id"], '"><img src="', $folderImage, '" /></a>';
                echo '<a href="videos.php?fid=', $folder["id"], '"><p>', $folder["name"], '</p>';
              echo "</td>";
               
              if($i == 2)
              {
                echo "</tr>";
              $i = -1;
              }
                
              $i++;
            }
              
            while($i < 3 && $i != 0)
            {
              echo "<td></td>";
            $i++;
            }
              
            if($i != 0)
          {
          echo "</tr>";
          }
          echo '</table>';
          }
          else if(!empty($videos))
          {
            echo '<div class="videogallery">';
              foreach($videos as $video)
              {
                echo '<a class="voverlay" href="swf/player.swf?url=../', $video["src"], '&volume=100" title="', $video["title"], '"><img src="', $video["thumbnail"], '" alt="', $video["title"], '" /><p>', $video["title"], '</p></a>';
              }
            echo '</div>';
          }
          else 
          {
            echo '<p class="novideos">', NO_VIDEOS, '</p>';
          } 
        ?>
      </div>
    </div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="js/videolightbox.js"></script>
    
  </body>
</html>