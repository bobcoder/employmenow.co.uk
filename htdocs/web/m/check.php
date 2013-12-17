<?php
// Prevent caching.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
// The JSON standard MIME header.
header('Content-type: application/json');

session_start();
//include_once ("../config.inc.php");
include_once ("../database.inc.php");
// Define $myusername and $mypassword
$myusername = $_POST['username'];
$mypassword = $_POST['password'];
// To protect MySQL injection (more detail about MySQL injection)
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT id, email, password FROM users WHERE email='$myusername' AND password='$mypassword'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
if($count >0){
	$_SESSION['login']='true';
	$_SESSION['username']= $row['email'];
	$_SESSION['userid'] = $row['id'];
	$_SESSION['jobid'] = $_POST['jobid'];
}else{
	$_SESSION['login']='';
	$_SESSION['jobid'] = $_POST['jobid'];
}
    // Lets say everything is in order
    $output = array('status' => true, 'massage' => 'Welcome!', 'Logged In'=>$_SESSION['login'], 'jobid'=>$_SESSION['jobid']);
    echo json_encode($output);

?>