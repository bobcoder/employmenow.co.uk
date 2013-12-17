<?php
session_start();
include_once ("database.inc.php");
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}
$job_id = mysql_real_escape_string($_POST['jobid']);
if($job_id){
     $update_query = "UPDATE `jobs` SET `approved`=1 WHERE `jobs_id`=$job_id";
     $result = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
     echo "[{Result: true}]";
}
?>