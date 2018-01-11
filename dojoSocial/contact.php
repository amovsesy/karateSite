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
    <link rel="stylesheet" href="css/jquery.validate.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/contact.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.validation.function.js"></script>
    <script type="text/javascript">
      /* <![CDATA[ */
      jQuery(function(){
        jQuery("#subject").validate({
          expression: 'return (VAL);',
          message: "Please enter a subject."
        });
      });
      /* ]]> */
    </script>
  </head>
  
  <body>
    <div id="content">
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <form method="POST" action="#">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" autocomplete="off" />
          <textarea id="message" name="message" rows="10" cols="52"></textarea>
          <input type="submit" class="action" value="Send" formnovalidate="formnovalidate" />
        </form>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>