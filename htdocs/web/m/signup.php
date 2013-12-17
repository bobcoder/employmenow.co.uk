<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
// Prevent caching.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');
// The JSON standard MIME header.
header('Content-type: application/json');

session_start();
//include_once ("../config.inc.php");
include_once ("../database.inc.php");
    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $dob = mysql_real_escape_string($_POST['year']);
    $tmpm = mysql_real_escape_string($_POST['month']);
    if($tmpm < 10) $tmpm = "0".$tmpm;
    $tmpd = mysql_real_escape_string($_POST['day']);
    if($tmpd < 10) $tmpd = "0".$tmpd;
    $dob .= "-$tmpm-$tmpd";
    $town = mysql_real_escape_string($_POST['town']);
    $county = mysql_real_escape_string($_POST['county']);
	$how = mysql_real_escape_string($_POST['how']);
    $terms = mysql_real_escape_string($_POST['terms']);
    $eligible = mysql_real_escape_string($_POST['eligible']);

    $phone = mysql_real_escape_string($_POST['phone']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$coords = getLatLong($town);

//Check if user already exists
$register_sql = "SELECT id, email FROM users WHERE email='$email' LIMIT 1";
$result = mysql_query($register_sql) or die("SQL Error 1: " . mysql_error());
//Count returned rows
$num_rows = mysql_num_rows($result);
//If greater than 0 we have found the email that is already registered
	if ($num_rows > 0){
		$already_reg = 'true';
	}else{
		$result = mysql_query("INSERT INTO `users` (`name`,`email`,`password`,`dob`,`town`,`county`,`how`,`phone`,`mobile`,`regdate`,`active`,`lat`,`lon`,`termsandconditions`,`last_login`) VALUES ('$name','$email','$password','$dob','$town','$county','$how','$phone','$mobile',NOW(),1,'".$coords['lat']."','".$coords['lon']."','2',NOW())");
		  $new_user = mysql_insert_id();
	$_SESSION['login']='true';
	$_SESSION['username']= $email;
	$_SESSION['userid'] = $new_user;
	//$_SESSION['jobid'] = $_POST['jobid'];
	}

     // Lets say everything is in order
    $output = array(
    'status' => true,
    'massage' => 'Welcome!',
    'Logged In'=>$_SESSION['login'],
    'jobid'=>$_SESSION['jobid'],
    "reg"=>$already_reg,
	"dob"=>$dob,
	"new_uid"=>$new_user
	);
    echo json_encode($output);

?>