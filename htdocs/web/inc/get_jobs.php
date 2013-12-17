<?php
session_start();
include ("../database.inc.php");
$userid = $_SESSION['userid'];
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="employer"){
	header('location: login.php');
	exit();
}
$json = array();
    $result = mysql_query("SELECT ja.id, ja.date_applied, u.name, jobs.jobs_id, jobs.title, jobs.ref, jobs.date_expires
			    FROM job_applications AS ja
			LEFT JOIN users AS u
			    ON ja.candidate_id = u.id
			LEFT JOIN jobs AS jobs
			    ON ja.job_id = jobs.jobs_id
			WHERE ja.candidate_id = $userid
			AND ja.active=1
			ORDER BY jobs.date_expires DESC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    echo json_encode($json);
?>