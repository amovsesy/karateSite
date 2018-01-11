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
    <link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/flowplayer-3.2.10.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  </head>
  
  <body>
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
    <div id="content">
      <div id="nav">
        <img alt="Dojo USA World Training Center" width="780px" height="297px" src="images/header.png">
        <div id="leftPanel">
          <div id="signup">
            <h3>Join Today</h3>
            <form method="POST" action="#">
              <div class="ghost-label">
                <label for="firstname">First Name</label>
                <input class="input" type="text" id="firstname" name="firstname" maxlength="20" autocomplete="off">
              </div>
              
              <div class="ghost-label">
                <label for="lastname">Last Name</label>  
                <input class="input" type="text" id="lastname" name="lastname" maxlength="20" autocomplete="off">
              </div>
              
              <div class="ghost-label">  
                <label for="phone">Phone Number</label>
                <input class="input" type="tel" id="phone" name="phone" autocomplete="off">
              </div>
              
              <div class="ghost-label">
                <label for="email">Email</label>
                <input class="input" type="email" id="email" name="email" autocomplete="off">
              </div> 
                
              <input class="btn-action" type="submit" value="Sign up" formnovalidate="formnovalidate">
            </form>
		  </div>
		  <div id="more">
		    <p><a href="http://www.selectmartialarts.com/dojousa/selectmovie.aspx">More Info</a></p>
		    <p><a href="#">Our Members</a></p>
		  </div>
		  <div id="fb" class="fb-like-box" data-href="http://www.facebook.com/pages/Dojo-USA/161858783571" data-width="168" data-height="292" data-show-faces="true" data-border-color="#1D89D1" data-stream="false" data-header="true"></div>
		</div>
      </div>
      <div id="info">
        <div id="title">
          <h1><?php echo TITLE; ?></h1>
          <div id="quoteContainer">
          	<p><?php echo TITLE_QUOTE; ?></p>
          </div>
        </div>
        <div id="video">
          <a href="videos/test.flv" id="player"></a>
          <script>
			flowplayer("player", "swf/flowplayer-3.2.11.swf");
		  </script> 
        </div>
        <div id="information">
          <h1><?php echo OUR_MISSION; ?></h1>
          <p><?php echo MISSION_TEXT; ?></p>
          <h1><?php echo ACTION_STATEMENT; ?></h1>
          <p><?php echo ACTION_STATEMENT_TEXT_1; ?></p>
          <p><?php echo ACTION_STATEMENT_TEXT_2; ?></p>
          <p></p>
        </div>
      </div>
    </div>
    <div id="footer">
      <p>Copyright &#9426; <?php echo date("Y"); ?> Dojo USA. All rights reserved.</p>
    </div>
    <script type="text/javascript" src="js/ghostlabels.js"></script>
  </body>
</html>