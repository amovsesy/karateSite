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
    <title>.: DOJO-USA :. Location</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/location.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  </head>
  
  <body onload="initializeMap()" onunload="GUnload()">
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <div id="address"><span class="title">Address </span><?php echo LOCATION; ?></div>
        <div id="info">
          <p>
            <?php echo LOCATION_CELEBRATE; ?><br />
            <?php echo LOCATION_SAN_BRUNO; ?>
          </p>     
          <p><?php echo LOCATION_OFFERING; ?></p>
          <p><?php echo LOCATION_GROWTH; ?></p>   
        </div>
        <div id="map"><iframe width="550" height="410" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=731+Kains+Ave.,+San+Bruno,+CA,+94066&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=48.688845,107.138672&amp;ie=UTF8&amp;hq=&amp;hnear=731+Kains+Ave,+San+Bruno,+San+Mateo,+California+94066&amp;t=m&amp;ll=37.630411,-122.417264&amp;spn=0.015532,0.026178&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=731+Kains+Ave.,+San+Bruno,+CA,+94066&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=48.688845,107.138672&amp;ie=UTF8&amp;hq=&amp;hnear=731+Kains+Ave,+San+Bruno,+San+Mateo,+California+94066&amp;t=m&amp;ll=37.630411,-122.417264&amp;spn=0.015532,0.026178&amp;z=15&amp;iwloc=A" style="color:#0000FF;text-align:center">View Larger Map</a></small></div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>