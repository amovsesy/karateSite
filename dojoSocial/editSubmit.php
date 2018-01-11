<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('database.php');
require_once('data.php');

$title = $_POST['title'];
$first = $_POST['firstname'];
$middle = $_POST['middle'];
$last = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$fax = $_POST['fax'];
$address = $_POST['address'];
$address1 = $_POST['address1'];
$city = $_POST['city'];
$zip = (!empty($_POST['zip'])) ? $_POST['zip'] : 0;
$dob = $_POST['birthday'];

$birthdate = "";
if(!empty($dob))
{
  list($month, $day, $year) = split('/', $dob);
  $birthdate = date("Y-m-d H:i:s", mktime(1, 0, 0, $month, $day, $year));
}

if(empty($first) || empty($last) || empty($email))
{
  $_SESSION['error'] = "First name, last name, and email are required. Please click edit and update again.";
}
else 
{
  updateUser($_SESSION['userid'], $title, $first, $middle, $last, $email, $phone, $fax, $address, $address1, $city, $zip, $birthdate);
  
  if(!isset($_SESSION['error']))
  {
    $_SESSION['success'] = "You have successfully updated your info.";
  }
}

header('Location: myProgress.php');

?>