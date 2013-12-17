<?php
session_start();
include ("../database.inc.php");
$userid = $_SESSION['userid'];
$jobid = mysql_real_escape_string($_POST['id']);
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="employer"){
	header('location: login.php');
	exit();
}
$json = array();
    $result = mysql_query("UPDATE `job_applications`
							SET
							`active` = '0'
							WHERE `id`=$jobid;");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    echo json_encode($json);
?>