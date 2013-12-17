<?php
session_start();
include_once ("../config.inc.php");
include_once ("database.inc.php");
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}

    $json = array();
    $result_query = "SELECT * FROM `jobs` WHERE approved=0";

	$result = mysql_query($result_query) or die("SQL Error 1: " . mysql_error());

    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    header("Content-type: application/json");
    echo json_encode($json);
?>