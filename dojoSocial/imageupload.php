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

function getExtension($str)
{
  $i = strrpos($str,".");
  if (!$i) { return ""; }
  $l = strlen($str) - $i;
  $ext = substr($str,$i+1,$l);
  return $ext;
}

$image=$_FILES['image']['name'];

if ($image)
{
  $filename = stripslashes($_FILES['image']['name']);
  $extension = getExtension($filename);
  $extension = strtolower($extension);
  
  if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
  {
    $_SESSION['error'] = "The file had an unknown extension";
    header('Location: myProgress.php');
  }
  else
  {
    $size=filesize($_FILES['image']['tmp_name']);
    
    if ($size > MAX_SIZE*1024)
    {
      $_SESSION['error'] = "You have exceeded the max file size: 300kb";
      header('Location: myProgress.php');
    }
    else 
    {
      $image_name=time().'.'.$extension;
      $newname="images/profile_pics/".$image_name;
      $copied = copy($_FILES['image']['tmp_name'], $newname);
      
      if (!$copied)
      {
        $_SESSION['error'] = "Could not upload the file to the server, please try again.";
        header('Location: myProgress.php');
      }
      
      if(!empty($user['picture']) && !unlink($user['picture']))
      {
//        error_log("file " . $user['picture'] . " was not deleted.", 1, "some email");
      }
      
      addImage($id, $newname);
      header('Location: myProgress.php');
    }
  }
}

?>