<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

$isLoggedInLeftPanel = false;

if (isset($_SESSION['userid'])) 
{
  $isLoggedInLeftPanel = true;
}

$currentPage = basename($_SERVER['SCRIPT_NAME']);

?>
<div id="fb-root"></div>
<script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<div id="leftPanel">
  <img alt="Dojo USA World Training Center" width="780px" height="297px" src="images/header.png">
  <div id="sidebar">
    <div id="nav">
      <?php if(!$isLoggedInLeftPanel){echo '<p>'; if ($currentPage == "index.php"){echo '<span class="selected">Home</span>';} else{echo '<a href="index.php">Home</a>';} echo '</p>';} ?>
      <?php if($isLoggedInLeftPanel){echo '<p>'; if ($currentPage == "myProgress.php"){echo '<span class="selected">My Progress</span>';} else{echo '<a href="myProgress.php">My Progress</a>';} echo '</p>';} ?>
      <p><?php if ($currentPage == "beltProgression.php"){echo '<span class="selected">Belt Progression</span>';} else{echo '<a href="beltProgression.php">Belt Progression</a>';} ?></p>
      <p><?php if ($currentPage == "schedule.php"){echo '<span class="selected">Schedule</span>';} else{echo '<a href="schedule.php">Schedule</a>';} ?></p>
      <p><?php if ($currentPage == "location.php"){echo '<span class="selected">Location</span>';} else{echo '<a href="location.php">Location</a>';} ?></p>
      <p><?php if ($currentPage == "trainers.php"){echo '<span class="selected">Trainers</span>';} else{echo '<a href="trainers.php">Trainers</a>';} ?></p>
      <p><?php if ($currentPage == "pictures.php"){echo '<span class="selected">Pictures</span>';} else{echo '<a href="pictures.php">Pictures</a>';} ?></p>
      <p><?php if ($currentPage == "videos.php"){echo '<span class="selected">Videos</span>';} else{echo '<a href="videos.php">Videos</a>';} ?></p>
      <?php if(false){echo '<p>'; if ($currentPage == "events.php"){echo '<span class="selected">Events</span>';} else{echo '<a href="events.php">Events</a>';} echo '</p>';} ?>
      <?php if($isLoggedInLeftPanel){echo '<p>'; if ($currentPage == "contact.php"){echo '<span class="selected">Contact Us</span>';} else{echo '<a href="contact.php">Contact Us</a>';} echo '</p>';} ?>
      <p><a href="http://www.dojousa.net">Learn About Us</a></p>
    </div>
    <div id="fb" class="fb-like-box" data-href="http://www.facebook.com/pages/Dojo-USA/161858783571" data-width="168" data-height="292" data-show-faces="true" data-border-color="#1D89D1" data-stream="false" data-header="true"></div>		  
  </div>
</div>