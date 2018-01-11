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
  getImagesForFolder($fid);
}
else 
{
  getPictureFolders();
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
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/pictures.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <?php
          if(!empty($fid))
          {
            echo '<p class="back"><a href="pictures.php">Go back to folders</a></p>';
          }
          if(!empty($folders))
          {
            echo '<table>';
            $i=0;
            foreach($folders as $folder)
            {
              getFirstPicOfFolder($folder["id"]);
              if($i == 0)
              {
                echo "<tr>";
              }
              
              echo "<td>";
                echo '<a href="pictures.php?fid=', $folder["id"], '"><img src="', $folderImage, '" /></a>';
                echo '<a href="pictures.php?fid=', $folder["id"], '"><p>', $folder["name"], '</p>';
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
          else if(!empty($images))
          {
            echo '<div class="gallery" id="pics">';
              foreach($images as $image)
              {
                echo '<a href="', $image["img"], '" rel="lightbox[folderContents]">', '<img src="', $image["img"], '" />', '</a>';
              }
            echo '</div>';
          }
          else 
          {
            echo '<p class="nopics">', NO_PICS, '</p>';
          } 
        ?>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>