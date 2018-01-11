<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('database.php');
require_once('data.php');

$password = $db->escape_value(md5($_POST['password']));
$newPass = $db->escape_value(md5($_POST['newPassword']));
$confirm = $db->escape_value(md5($_POST['passwordConfirm']));

if($newPass != $confirm)
{
  $_SESSION['error'] = "New password mismatch.";
}
else if(empty($password) || empty($newPass))
{
  $_SESSION['error'] = "Current and new password are required. Please enter these fields and resubmit.";
}
else 
{
  updatePassword($_SESSION['userid'], $password, $newPass);
  
  if(!isset($_SESSION['error']))
  {
    $_SESSION['success'] = "You have successfully updated your password.";
  }
}

header('Location: myProgress.php');

?>