<?php

// Inialize session
if(!isset($_SESSION))
{
  session_start();
}

// Delete certain session
unset($_SESSION['userid']);
// Delete all session variables
// session_destroy();

// Jump to index page
header('Location: index.php');

?>