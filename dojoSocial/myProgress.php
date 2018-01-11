<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

if (!isset($_SESSION['userid'])) 
{
  header('Location: index.php');
}

require_once('config.php');
require_once('data.php');

$id = $_SESSION['userid'];
getUser($id);

if(!empty($user['birthday']) && $user['birthday'] != "0000-00-00")
{
  list($year, $month, $day) = split('-', $user['birthday']);
  $birthdate = $month . "/" . $day . "/" . $year;
  $user['birthday'] = $birthdate;
}

if(!empty($user['signupdate']) && $user['signupdate'] != "0000-00-00")
{
  list($year, $month, $day) = split('-', $user['signupdate']);
  $signupdate = $month . "/" . $day . "/" . $year;
  $user['signupdate'] = $signupdate;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>.: DOJO-USA :. My Progress</title>
    <meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/jquery-ui-1.8.21.custom.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/jquery.validate.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/myProgress.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-dialog.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>
    <script type="text/javascript" src="js/jquery.validation.function.js"></script>
    <script type="text/javascript">
      function changepass()
      {
//        alert('change pass');
        $( "#changepass" ).dialog(
            { buttons: [{
                          text: "Cancel",
                          click: function() { $(this).dialog("close"); }
                        },
                        {
                          text: "Save",
                          click: function() { $("#changepassForm").submit(); }
                        }]});
      }

      function changepic()
      {
//        alert('change pic');
        $( "#imgupload" ).dialog(
                        { buttons: [{
                          text: "Cancel",
                          click: function() { $(this).dialog("close"); }
                        },
                        {
                          text: "Remove Image",
                          click: function() { $("#imageRemove").submit(); }
                        },
                        {
                          text: "Save",
                          click: function() { $("#imageUpload").submit(); }
                        }]});
      }

      function editProfile()
      {
        $("#edit").dialog(
                        { buttons: [{
                          text: "Cancel",
                          click: function() { $(this).dialog("close"); }
                        },
                        {
                          text: "Save",
                          click: function() { $("#editForm").submit(); }
                        }]});
      }

      /* <![CDATA[ */
      jQuery(function(){
        jQuery("#editForm #email").validate({
          expression: 'var re = /^(([^<>()[\\]\\\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\"]+)*)|(\\".+\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/; return (VAL && re.test(VAL));',
          message: "Please enter a valid email."
        });
        jQuery("#editForm #firstname").validate({
          expression: 'return (VAL);',
          message: "Please enter your first name."
        });
        jQuery("#editForm #lastname").validate({
          expression: 'return (VAL);',
          message: "Please enter your last name."
        });
        jQuery("#editForm #middle").validate({
          expression: 'return (!VAL || VAL.length == 1);',
          message: "Please enter a middle initial."
        });
        jQuery("#editForm #phone").validate({
          expression: 'var re = /^\\(?([0-9]{3})\\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; return (!VAL || re.test(VAL));',
          message: "Please enter a valid phone number."
        });
        jQuery("#editForm #fax").validate({
          expression: 'var re = /^\\(?([0-9]{3})\\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; return (!VAL || re.test(VAL));',
          message: "Please enter a valid fax number."
        });
        jQuery("#editForm #zip").validate({
          expression: 'var re = /^\\d{5}$|^\\d{5}-\\d{4}$/; return (!VAL || re.test(VAL));',
          message: "Please enter a valid zip code."
        });
        jQuery("#editForm #birthday").validate({
          expression: 'var birth = VAL.split(\'/\'); return (!VAL || isValidDate(parseInt(birth[2]), parseInt(birth[0]), parseInt(birth[1])));',
          message: "Please enter a valid date."
        });
        jQuery("#changepassForm #password").validate({
          expression: 'return (VAL);',
          message: "Please enter your current password."
        });
        jQuery("#changepassForm #newPassword").validate({
          expression: 'return (VAL);',
          message: "Please enter a password."
        });
        jQuery("#changepassForm #passwordConfirm").validate({
          expression: 'return (VAL && VAL == jQuery(\'#changepassForm #newPassword\').val());',
          message: "Confirm password doesn't match your new password."
        });
      });
      /* ]]> */
    </script>
  </head>
  
  <body>
    <div id="content">
      <?php
        if(isset($_SESSION['success']))
        {
          echo '<p class="success">', $_SESSION['success'], '<p>';
          unset($_SESSION['success']);
        } 
      ?>
      <?php
        if(isset($_SESSION['error']))
        {
          echo '<p class="error">', $_SESSION['error'], '<p>';
          unset($_SESSION['error']);
        } 
      ?>
      <?php include 'leftPanel.php'; ?>
      <div id="mainPanel">
        <div id="profile">
          <div id="actions">
            <a href="javascript:editProfile()">Edit</a>
            <a href="javascript:changepass();">Change Password</a>
            <a href="logout.php">Log out</a>
          </div>
          <div id="picture">
            <img src="<?php if(!empty($user["picture"])){echo $user["picture"];}else{echo "images/nophoto.jpg";} ?>" />
            <a href="javascript:changepic();">Change Picture</a>
          </div>
          <div id="info">
            <div id="infoLeft">
              <ul>
                <li><label>Title:</label> <?php echo $user['title']; ?></li>
                <li><label>First Name:</label> <?php echo $user['firstname']; ?></li>
                <li><label>Middle Name:</label> <?php echo $user['middle']; ?></li>
                <li><label>Last Name:</label> <?php echo $user['lastname']; ?></li>
                <li><label>Email:</label> <?php echo $user['email']; ?></li>
                <li><label>Phone:</label> <?php echo $user['phone']; ?></li>
                <li><label>Fax:</label> <?php echo $user['fax']; ?></li>
              </ul>
            </div>
            <div id="infoRight">
              <ul>
                <li><label>Sign Up Date:</label> <?php echo $user['signupdate']; ?></li>
                <li class="add"><label>Address:</label> <?php echo '<div class="address">'; echo $user['address']; if(!empty($user['address1'])){echo '<br />', $user['address1'];} if(!empty($user['city'])){echo '<br />', $user['city'], ', CA ';}  if($user['zip'] != 0){echo ', ', $user['zip'];} echo '</div>';?></li>
                <li><label>Birthdate:</label> <?php echo $user['birthday']; ?></li>
              </ul>
            </div>
          </div>
        </div>
        <div id="belt">
          <?php echo '<img class="belt" src="', $user["beltimg"], '" />'; ?>
          <?php
            $i = 0;
            if($user["currentstripe"] == 4)
            {
              echo '<img class="stripe" src="images/red_stripe.png" />';
              $i++;
            }
            
            while($i < $user["currentstripe"])
            {
              echo '<img class="stripe" src="images/black_stripe.png" />';
              $i++;
            }
          ?>
        </div>
        <?php
          if(!empty($curProgress["stripe1"]))
          {
            echo '<div id="upgradereq">';
              echo '<ul>';
                if($user["currentstripe"] > 0)
                {
                  echo '<li class="done stripe1 stripe">';
                }
                else 
                {
                  echo '<li class="stripe1 stripe">';
                }
                  echo '<ul>';
                    foreach(explode("::", $curProgress["stripe1"]) as $req)
                    {
                      echo '<li>', $req, '</li>';
                    }
                  echo '</ul>';
                echo '</li>';
                if(!empty($curProgress["stripe2"]))
                {
                  if($user["currentstripe"] > 1)
                  {
                    echo '<li class="done stripe2 stripe">';
                  }
                  else 
                  {
                    echo '<li class="stripe2 stripe">';
                  }
                    echo '<ul>';
                      foreach(explode("::", $curProgress["stripe2"]) as $req)
                      {
                        echo '<li>', $req, '</li>';
                      }
                    echo '</ul>';
                  echo '</li>';
                }
                if(!empty($curProgress["stripe3"]))
                {
                  if($user["currentstripe"] > 2)
                  {
                    echo '<li class="done stripe3 stripe">';
                  }
                  else 
                  {
                    echo '<li class="stripe3 stripe">';
                  }
                    echo '<ul>';
                      foreach(explode("::", $curProgress["stripe3"]) as $req)
                      {
                        echo '<li>', $req, '</li>';
                      }
                    echo '</ul>';
                  echo '</li>';
                }
              echo '</ul>';
            echo '</div>';
          } 
        ?>
        
        <!-- The following divs are hidden and only show up on edit clicks  -->
        <div id="edit" title="Edit Profile">
          <form method="POST" action="editSubmit.php" id="editForm">
          <div id="editPanel">
            <ul>
              <li><label>Sign Up Date:</label> <?php echo $user['signupdate']; ?></li>
              <li><label>Title:</label> <input type="text" name="title" id="title" value="<?php echo $user['title']; ?>" /></li>
              <li><label>* First Name:</label> <input type="text" name="firstname" id="firstname" value="<?php echo $user['firstname']; ?>" /></li>
              <li><label>Middle Name:</label> <input type="text" name="middle" id="middle" value="<?php echo $user['middle']; ?>" size="1" /></li>
              <li><label>* Last Name:</label> <input type="text" name="lastname" id="lastname" value="<?php echo $user['lastname']; ?>" /></li>
              <li><label>* Email:</label> <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" /></li>
              <li><label>Phone:</label> <input type="phone" name="phone" id="phone" value="<?php echo $user['phone']; ?>" /></li>
              <li><label>Fax:</label> <input type="phone" name="fax" id="fax" value="<?php echo $user['fax']; ?>" /></li>
              <li><label>Address:</label> <input type="text" name="address" id="address" value="<?php echo $user['address']; ?>" /></li>
              <li><label>Address:</label> <input type="text" name="address1" id="address1" value="<?php echo $user['address1']; ?>" /></li>
              <li><label>City:</label> <input type="text" name="city" id="city" value="<?php echo $user['city']; ?>" /></li>
              <li><label>Zip Code:</label> <input type="text" name="zip" id="zip" value="<?php if($user['zip'] != 0){echo $user['zip'];} ?>" /></li>
              <li><label>Birthdate:</label> <input type="text" name="birthday" id="birthday" value="<?php echo $user['birthday']; ?>" /> (MM/DD/YYYY)</li>
            </ul>
          </div>
          </form>
        </div>
        <div id="imgupload" title="Upload Image">
          <img src="<?php if(!empty($user["picture"])){echo $user["picture"];}else{echo "images/nophoto.jpg";} ?>" />
          <form method="POST" enctype="multipart/form-data" action="imageupload.php" id="imageUpload">
          <ul>
            <li><input type="file" name="image"></li>
          </ul>
          <p><?php echo IMAGE_TEXT; ?></p>
          </form>
          <form method="POST" action="imageremove.php" id="imageRemove">
          </form>
        </div>
        <div id="changepass" title="Change Password">
          <form method="POST" action="changepassSubmit.php" id="changepassForm">
          <ul>
            <li><label>* Current Password:</label> <input type="password" name="password" id="password" size="30"></li>
            <li><label>* New Password:</label> <input type="password" name="newPassword" id="newPassword" size="30"></li>
            <li><label>* Confirm Password:</label> <input type="password" name="passwordConfirm" id="passwordConfirm" size="30"></li>
          </ul>
          </form>
        </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>