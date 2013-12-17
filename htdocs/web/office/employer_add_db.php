<?php
ob_start();
session_start();

include_once ("../config.inc.php");
include_once ("incs/database.inc.php");

$companyname = mysql_real_escape_string($_POST['companyname']);
$name = mysql_real_escape_string($_POST['contactname']);
$email = mysql_real_escape_string($_POST['email']);
$telephone = mysql_real_escape_string($_POST['telephone']);
$password = mysql_real_escape_string($_POST['password']);
$approved = (mysql_real_escape_string($_POST['approved']) !=1 ? 0 : 1); // returns true
$termsandconditions = (mysql_real_escape_string($_POST['tandc']) !=1 ? 0 : 1); // returns true
$active = (mysql_real_escape_string($_POST['active']) !=1 ? 0 : 1); // returns true
$employer_id = $_GET['id'];


if(mysql_real_escape_string($_POST['credits']) =='' ){
	$credits = 0;
}else{
	$credits = mysql_real_escape_string($_POST['credits']);
}

$date_added = date('Y-m-d');
if($_GET['action']=='add'){

     $insert_query = "INSERT INTO `employers`
						(`email`,
						`password`,
						`name`,
						`companyname`,
						`telephone`,
						`regdate`,
						`active`,
						`termsandconditions`,
						`approved`)
						VALUES
						('$email',
						'$password',
						'$name',
						'$companyname',
						'$telephone',
						'$date_added',
						$active,
						$termsandconditions,
						$approved)";
	$result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
	$insert_id = mysql_insert_id();

	$insert_credits = "INSERT INTO `credits`
						(`employerid`,
						`credits`)
						VALUES
						($insert_id,
						$credits);";
	$result_credits = mysql_query($insert_credits) or die("SQL Error 1: " . mysql_error());

	echo $insert_id;//Return the insertId

}else if($_GET['action']=='update'){
	$update_query ="UPDATE `credits`
					SET
					`credits` = $credits
					WHERE `employerid` =$employer_id;";
	$update_query2 = "UPDATE `employers` SET
					`email` ='$email',
					`password` ='$password',
					`name` ='$name',
					`companyname` = '$companyname',
					`telephone` = '$telephone',
					`active` = $active,
					`termsandconditions` = $termsandconditions,
					`approved` = $approved
					WHERE `id` = $employer_id;";
$result_update = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
$result_update2 = mysql_query($update_query2) or die("SQL Error 1: " . mysql_error());
echo $result_update2;
}