<?php


// $_SESSION['user_id']  = null;  
// $_SESSION['firstName']  = null;
// $_SESSION['lastName']   = null;
// $_SESSION['user_email'] = null;
// $_SESSION['user_password'] = null;
session_start();
// unset($_SESSION['user_id']);
// unset($_SESSION['firstName']);
// unset($_SESSION['lastName']);
// unset($_SESSION['user_email']);
// session_destroy($_SESSION['user_id']);
// session_destroy($_SESSION['firstName']);
// session_destroy($_SESSION['lastName']);
// session_destroy($_SESSION['user_email']);
$_SESSION[]= array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), "", time()-42000, "/");
}
//session_delete();
session_unset();
header("Location: ../index.php");
?>