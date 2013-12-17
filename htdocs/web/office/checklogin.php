<?php
session_start();
include_once ("../config.inc.php");
include_once ("incs/database.inc.php");
// Define $myusername and $mypassword
$myusername = $_POST['username'];
$mypassword = $_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
/*
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);*/

$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM users WHERE name='$myusername' AND password='$mypassword' AND is_admin='1'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
echo "Count: " . $count;
// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

    // Register $myusername, $mypassword and redirect to file "login_success.php"
    $_SESSION['username'] =$myusername;
    $_SESSION['loggedIn'] = 'true';
/*
echo '<pre>';
	print_r($_SESSION);
echo '</pre>';*/

    header("location:index.php");
    exit();
} else {
    $_SESSION['loggedIn'] = 'false';
/*
echo '<pre>';
    print_r($_SESSION);
echo '</pre>';*/

    header("location:login.php");
    exit();
}
?>