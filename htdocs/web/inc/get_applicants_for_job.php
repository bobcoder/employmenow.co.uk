<?php
session_start();
include ("../database.inc.php");
$userid = $_SESSION['userid'];
$jobId = mysql_real_escape_string($_GET['jobid']);
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user"){
	header('location: elogin.php');
	exit();
}
$json = array();
    $result = mysql_query("SELECT ja.id AS app_id, ja.date_applied, u.name, u.id AS userId, jobs.title, jobs.ref, jobs.date_expires
			    FROM job_applications AS ja
			LEFT JOIN users AS u
			    ON ja.candidate_id = u.id
			LEFT JOIN jobs AS jobs
			    ON ja.job_id = jobs.jobs_id
			WHERE ja.employer_id = $userid
			AND jobs.jobs_id = $jobId
			AND ja.active=1
			ORDER BY jobs.date_expires DESC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    echo json_encode($json);
?>