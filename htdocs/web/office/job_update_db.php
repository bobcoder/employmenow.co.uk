<?php
include_once ("../config.inc.php");
include_once ("incs/database.inc.php");
$job_id = $_POST['id'];

$job_group1 = $_POST['jobgroup1'];
$job_group2 = $_POST['jobgroup2'];
//append job groups
$array = array($job_group1, $job_group2);
$job_type = implode(",", $array);

$title = mysql_real_escape_string($_POST['title']);
$reference = mysql_real_escape_string($_POST['ref']);
$salary = mysql_real_escape_string($_POST['salary']);
$salary_notes = mysql_real_escape_string($_POST['salary_notes']);
$description = mysql_real_escape_string($_POST['description']);
//$job_type = mysql_real_escape_string($_POST['job_type']);
$employer_id = mysql_real_escape_string($_POST['employer_id']);
$industry_id = mysql_real_escape_string($_POST['industry_id']);
$region = mysql_real_escape_string($_POST['county']);
$town = mysql_real_escape_string($_POST['town']);
$date_expires1 = str_replace('/','-',$_POST['date_expires']);
$date_expires = strtotime($date_expires1);
$new_date = date('Y-m-d', $date_expires);
$active = mysql_real_escape_string($_POST['active']);

if($_GET['action']=='addjob'){
     $insert_query = "INSERT INTO `jobs` (
        `title`, `description`, `active`, `employer_id`, `ref`, `region`, `town`, `salary`, `salary_notes`, `industry_id`, `job_type`, `date_expires`)
        VALUES('$title', '$description', '$active', '$employer_id', '$reference', '$region', '$town', '$salary', '$salary_notes', '$industry_id', '$job_type', '$new_date')";
     $result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
    echo $result;

}else if($_GET['action']=='updatejob'){
     $update_query = "UPDATE `jobs`
						SET
						`employer_id` = '$employer_id',
						`title` = '$title',
						`description` = '$description',
						`industry_id` = '$industry_id',
						`date_expires` = '$new_date',
						`salary` = '$salary',
						`salary_notes` = '$salary_notes',
						`region` = '$region',
						`town` = '$town',
						`job_type` = '$job_type',
						`ref` = '$reference',
						`active` = '$active'
						WHERE `jobs_id` = $job_id";
	$result = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
	echo mysql_affected_rows();
	//echo $update_query;

}else if($_GET['action']=='addIndustry'){
    $industry = mysql_real_escape_string($_POST['industry']);
    $industry_query = "INSERT INTO `industries` (`name`) VALUES ('$industry')";
    $result = mysql_query($industry_query) or die("SQL Error 1: " . mysql_error());
    echo $result;
}

