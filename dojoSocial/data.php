<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

require_once('config.php');
require_once('database.php');

$events = array();
$trainers = array();

$beltprogression = array();
$progression = array();
$belts = array();

$folders = array();
$folderImage = "";

$images = array();

$videos = array();

$user = array();
$curProgress = array();

function login($email, $password)
{
  global $db;
  
  $loginEmailCheck = $db->query("SELECT * FROM user WHERE (email = '" . $email . "')");
  $login = $db->query("SELECT * FROM user WHERE (email = '" . $email . "') and (password = '" . $password . "')");
  
  if($db->num_rows($loginEmailCheck) != 1)
  {
    $_SESSION['error'] = "No users exists with email: " . $email;
    $routePage = "index.php";
  }
  else if($db->num_rows($login) != 1)
  {
    $_SESSION['error'] = "Your email and password did not match our records in the database";
    $routePage = "index.php";
  }
  else
  {
    while($row = $db->getRows($login))
    {
      $_SESSION['userid'] = $row['id'];
    }
    $routePage = "myProgress.php";
  }

  header('Location: ' . $routePage);
}

function getSchedule()
{
  $fields = array("id", "dayOfWeek", "startTimeHour", "startTimeMin", "endTimeHour", "endTimeMin", "title", "startdate", "enddate");
  $sqlStmt = 'SELECT * FROM `schedule` ORDER BY `dayOfWeek` asc, `startTimeHour` asc';
  
  populateData($sqlStmt, 'events', $fields);
}

function getTrainers()
{
  $fields = array("id", "name", "img", "info", "quote");
  $sqlStmt = 'SELECT * FROM `trainers` ORDER BY `rank` desc';
  
  populateData($sqlStmt, 'trainers', $fields);
}

function getBeltProgressionData()
{  
  $beltFields = array("id","name","beltimg");
  $beltSql = 'SELECT * FROM belt';
  populateData($beltSql, 'belts', $beltFields);
  
  $progressionFields = array("id","frombeltid","tobeltid","overview","beltquote","stripe1","stripe2","stripe3","beltinfo");
  $progressionSql = 'SELECT * FROM beltprogression';
  populateData($progressionSql, 'progression', $progressionFields);
  
  unset($GLOBALS["beltprogression"]);
  $GLOBALS["beltprogression"] = array();
  
  foreach($GLOBALS["progression"] as $progress)
  {
    $GLOBALS["beltprogression"][$progress["id"]]["id"] = $progress["id"];
    $GLOBALS["beltprogression"][$progress["id"]]["frombeltimg"] = $GLOBALS["belts"][$progress["frombeltid"]]["beltimg"];
    $GLOBALS["beltprogression"][$progress["id"]]["tobeltimg"] = $GLOBALS["belts"][$progress["tobeltid"]]["beltimg"];
    $GLOBALS["beltprogression"][$progress["id"]]["overview"] = @unserialize($progress["overview"]);
    $GLOBALS["beltprogression"][$progress["id"]]["beltquote"] = $progress["beltquote"];
    $GLOBALS["beltprogression"][$progress["id"]]["stripe1"] = $progress["stripe1"];
    $GLOBALS["beltprogression"][$progress["id"]]["stripe2"] = $progress["stripe2"];
    $GLOBALS["beltprogression"][$progress["id"]]["stripe3"] = $progress["stripe3"];
    $GLOBALS["beltprogression"][$progress["id"]]["beltinfo"] = $progress["beltinfo"];
  }
}

function getPictureFolders()
{
  getFolders('0');
}

function getVideoFolders()
{
  getFolders('1');
}

function getFolders($type)
{
  $fields = array("id", "name", "type");
  $sqlStmt = 'SELECT * FROM folders WHERE type = ' . $type;
  populateData($sqlStmt, 'folders', $fields);
}

function getFirstPicOfFolder($folderId)
{
  global $db;
  
  $sqlStmt = 'SELECT * FROM pictures WHERE folderid = ' . $folderId;
  $res = $db->query($sqlStmt);
  if($db->num_rows($res) > 0)
  {
    $val = rand(0, $db->num_rows($res));
    $i = 0;
    while($row = $db->getRows($res))
    {
      if ($i == $val)
      {
        $GLOBALS['folderImage'] = $row['img'];
        break;
      }
      
      $i++;
    }
  }
}

function getImagesForFolder($folderId)
{
  $fields = array("id", "folderid", "img");
  $sqlStmt = 'SELECT * FROM pictures WHERE folderid = ' .  $folderId;
  populateData($sqlStmt, 'images', $fields);
}

function getFirstVideoThumbnailOfFolder($folderId)
{
  global $db;
  
  $sqlStmt = 'SELECT * FROM videos WHERE folderid = ' . $folderId;
  $res = $db->query($sqlStmt);
  if($db->num_rows($res) > 0)
  {
    $val = rand(0, $db->num_rows($res)-1);
    $i = 0;
    while($row = $db->getRows($res))
    {
      if ($i == $val)
      {
        $GLOBALS['folderImage'] = $row['thumbnail'];
        break;
      }
      $i++;
    }
  }
}

function getVideosForFolder($folderId)
{
  $fields = array("id", "folderid", "title", "src", "thumbnail");
  $sqlStmt = 'SELECT * FROM videos WHERE folderid = ' .  $folderId;
  populateData($sqlStmt, 'videos', $fields);
}

function getUser($id)
{
  global $db;
  
  $fields = array("id", "title", "firstname", "middle", "lastname", "email", "picture", "signupdate", "birthday", "address", "address1", "city", "zip", "phone", "fax");
  $sqlStmt = 'SELECT * FROM user WHERE id = ' . $id;
  populateDataNonArray($sqlStmt, 'user', $fields);
  
  $fieldsProgress = array("currentbeltid", "currentstripe");
  $sqlProgress = 'SELECT * FROM userprogress where userid = ' . $id;
  $resProgress = $db->query($sqlProgress);
  if($db->num_rows($resProgress) > 0)
  {
    while($rowProgress = $db->getRows($resProgress))
    {
      for($i = 0; $i < count($fieldsProgress); $i++)
      {
        $GLOBALS["user"][$fieldsProgress[$i]] = $rowProgress[$fieldsProgress[$i]];
      }
    }
  }
  
  $fieldsBelt = array("name", "beltimg");
  $sqlBelt = 'SELECT * FROM belt WHERE id = ' . $GLOBALS["user"]["currentbeltid"];
  $resBelt = $db->query($sqlBelt);
  if($db->num_rows($resBelt) > 0)
  {
    while($rowBelt = $db->getRows($resBelt))
    {
      for($i = 0; $i < count($fieldsBelt); $i++)
      {
        $GLOBALS["user"][$fieldsBelt[$i]] = $rowBelt[$fieldsBelt[$i]];
      }
    }
  }
  
  $fieldsProgression = array("id","frombeltid","tobeltid","overview","beltquote","stripe1","stripe2","stripe3","beltinfo");
  $sqlProgression = 'SELECT * FROM beltprogression where frombeltid = ' . $GLOBALS["user"]["currentbeltid"];
  populateDataNonArray($sqlProgression, 'curProgress', $fieldsProgression);
  
  $sqlBeltProgression = 'SELECT * FROM belt WHERE id = ' . $GLOBALS["curProgress"]["tobeltid"];
  $resBeltProgression = $db->query($sqlBeltProgression);
  if($db->num_rows($resBeltProgression) > 0)
  {
    while($rowBelt = $db->getRows($resBeltProgression))
    {
      for($i = 0; $i < count($fieldsBelt); $i++)
      {
        $GLOBALS["curProgress"][$fieldsBelt[$i]] = $rowBelt[$fieldsBelt[$i]];
      }
    }
  }
}

function populateData($sqlStmt, $dataArrayName, $fields)
{
  global $db;
  
  unset($GLOBALS[$dataArrayName]);
  $GLOBALS[$dataArrayName] = array();
  
  $res = $db->query($sqlStmt);
  
  if($db->num_rows($res) > 0)
  {
    while($row = $db->getRows($res))
    {
      for($i = 0; $i < count($fields); $i++)
      {
        $GLOBALS[$dataArrayName][$row['id']][$fields[$i]] = $row[$fields[$i]];
      }
    }
  }
}

function populateDataNonArray($sqlStmt, $dataArrayName, $fields)
{
  global $db;
  
  unset($GLOBALS[$dataArrayName]);
  $GLOBALS[$dataArrayName] = array();
  
  $res = $db->query($sqlStmt);
  
  if($db->num_rows($res) > 0)
  {
    while($row = $db->getRows($res))
    {
      for($i = 0; $i < count($fields); $i++)
      {
        $GLOBALS[$dataArrayName][$fields[$i]] = $row[$fields[$i]];
      }
    }
  }
}


//========================= UPDATE FUNCTIONS ====================================

function updateUser($id, $title, $first, $middle, $last, $email, $phone, $fax, $address, $address1, $city, $zip, $birthdate)
{
  global $db;
  $sqlStmt = "UPDATE user SET title = '" . $db->escape_value($title) . "', firstname = '" . $db->escape_value($first) . "', middle = '" . $db->escape_value($middle) . "', lastname = '" . $db->escape_value($last) . "', email = '" . $db->escape_value($email) . "', birthday = '" . $db->escape_value($birthdate) . "', address = '" . $db->escape_value($address) . "', address1 = '" . $db->escape_value($address1) . "', city = '" . $db->escape_value($city) . "', zip = " . $zip . ", phone = '" . $db->escape_value($phone) . "', fax = '" . $db->escape_value($fax) . "' WHERE id = " . $id;
  executeAndCheckResultBool($sqlStmt, "There was a problem updating your info. Please try again.", "Your information was updated");
}

function updatePassword($id, $oldPass, $newPass)
{
  executeAndCheckResultResource("SELECT * FROM user WHERE (id = " . $id . ") and (password = '" . $oldPass . "')", "Your password did not match our records in the database", "");
  
  if(!isset($_SESSION['error'])) 
  {
    executeAndCheckResultBool("UPDATE user SET password = '" . $newPass . "' WHERE id = " . $id, "There was a problem updating your password.", "Your password has been changed");
  }
}

function addImage($id, $img)
{
  global $db;
  $errorMessage = (strcmp($img, "") == 0) ? "There was a problem removing your image." : "There was a problem uploading your image.";
  $successMessage = (strcmp($img, "") == 0) ? "Your image has been successfully removed" : "Your picture has been updated";
  executeAndCheckResultBool("UPDATE user SET picture = '" . $db->escape_value($img) . "' WHERE id = " . $id, $errorMessage, $successMessage);
}

function executeAndCheckResultResource($sqlStmt, $errorMessage, $successMessage)
{
  global $db;
  $result = $db->query($sqlStmt);
  if($db->num_rows($result) <= 0)
  {
    $_SESSION['error'] = $errorMessage;
  }
  else 
  {
    $_SESSION['success'] = $successMessage;
  }
}

function executeAndCheckResultBool($sqlStmt, $errorMessage, $successMessage)
{
  global $db;
  $result = $db->query($sqlStmt);
  if(!$result)
  {
    $_SESSION['error'] = $errorMessage;
  }
  else 
  {
    $_SESSION['success'] = $successMessage;
  }
}

?>