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

require_once('data.php');

$id = $_SESSION['userid'];

if(!empty($user['picture']) && !unlink($user['picture']))
{
//  error_log("file " . $user['picture'] . " was not deleted.", 1, "some email");
}

addImage($id, "");

header('Location: myProgress.php');

?>