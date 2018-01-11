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
    <link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.validation.function.js"></script>
    <script type="text/javascript">
      /* <![CDATA[ */
      jQuery(function(){
        jQuery("#login #email").validate({
          expression: 'var re = /^(([^<>()[\\]\\\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\"]+)*)|(\\".+\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/; return (VAL && re.test(VAL));',
          message: "Please enter a valid email."
        });
        jQuery("#login #password").validate({
          expression: 'return (VAL);',
          message: "You must enter a password."
        });
        jQuery("#signup #emailSignup").validate({
          expression: 'var re = /^(([^<>()[\\]\\\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\"]+)*)|(\\".+\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/; return (VAL && re.test(VAL));',
          message: "Please enter a valid email."
        });
        jQuery("#signup #firstname").validate({
          expression: 'return (VAL);',
          message: "Please enter your first name."
        });
        jQuery("#signup #lastname").validate({
          expression: 'return (VAL);',
          message: "Please enter your last name."
        });
      });
      /* ]]> */
    </script>
  </head>
  
  <body>
    <div id="content">
      <?php
        if(isset($_SESSION['error']))
        {
          echo '<p class="error">', $_SESSION['error'], '<p>';
          unset($_SESSION['error']);
        } 
      ?>
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <div id="login">
          <p>Log in</p>
          <form method="POST" action="loginSubmit.php" id="loginForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" autocomplete="off" />
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" autocomplete="off" />
            <input type="submit" class="action" value="Log in" formnovalidate="formnovalidate" />
          </form>
        </div>
        <div id="signup">
          <p>Sign up</p>
          <form method="POST" action="#" id="signupForm">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" autocomplete="off" />
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" autocomplete="off" />
            <label for="email">Email:</label>
            <input type="email" id="emailSignup" name="email" autocomplete="off" />
            <input type="submit" class="action" value="Sign up" formnovalidate="formnovalidate" />
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>