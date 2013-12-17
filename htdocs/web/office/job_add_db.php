<?php
ob_start();
session_start();

include_once ("../config.inc.php");
include_once ("incs/database.inc.php");
include_once ("../inc/mail.class.php");

$title = mysql_real_escape_string($_POST['title']);
$reference = mysql_real_escape_string($_POST['ref']);
$salary = mysql_real_escape_string($_POST['salary']);
$salary_notes = mysql_real_escape_string($_POST['salary_notes']);
$description = mysql_real_escape_string($_POST['description']);
$job_type1 = mysql_real_escape_string($_POST['jobgroup1']);
$job_type2 = mysql_real_escape_string($_POST['jobgroup2']);

$job_type = $job_type1 . "," . $job_type2;

$employer_id = mysql_real_escape_string($_POST['employer_id']);
$industry_id = mysql_real_escape_string($_POST['industry_id']);
$region = mysql_real_escape_string($_POST['county']);
$town = mysql_real_escape_string($_POST['town']);
$date_expires1 = mysql_real_escape_string($_POST['date_expires']);
$date_expires = strtotime($date_expires1);
$new_date = date('Y-m-d', $date_expires);
$active = mysql_real_escape_string($_POST['active']);
$date_added = date('Y-m-d');
if($_GET['action']=='addjob'){
     $insert_query = "INSERT INTO `jobs` (`title`, `description`, `active`, `employer_id`, `ref`, `region`, `salary`,
        	`salary_notes`, `industry_id`, `job_type`, `date_expires`, `date_added`, `town`)
        	VALUES('$title', '$description', '$active', '$employer_id', '$reference', '$region', '$salary',
        	'$salary_notes', '$industry_id', '$job_type', '$new_date', '$date_added', '$town')";
     $result = mysql_query($insert_query) or die("SQL Error 1: " . mysql_error());
	if($result == 1){
		$to_email = "jobs@employmenow.co.uk";
		$sender_name = "Web master";
		$from_email = "no-reply@employmenow.co.uk";
		$subject = "An employer has posted a job!";
		$message = "Hi<br>An employer has just posted a job. Please make sure you approve it with 24 hours.<br><BR>
					Regards<BR><BR>You website.";
		send_mail($to_email, $sender_name, $from_email, $subject, $message);
	}
    echo $result;
}else if($_GET['action']=='updatejob'){

    echo $result;
}else if($_GET['action']=='addIndustry'){
    $industry = mysql_real_escape_string($_POST['industry']);
    $industry_query = "INSERT INTO `industries` (`name`) VALUES ('$industry')";
    $result = mysql_query($industry_query) or die("SQL Error 1: " . mysql_error());
    echo $result;
}
//Send mail function
function send_mail($to_email, $sender_name, $from_email, $subject, $message){
 	$mailer = new Simple_Mail();
	$send   = $mailer->setTo($to_email, $sender_name)
         ->setSubject($subject)
         ->setFrom('no-reply@employmenow.co.uk', 'Employmenow.co.uk')
         ->addMailHeader('Reply-To', 'no-reply@employmenow.co.uk', 'Employmenow.co.uk')
         //->addMailHeader('Cc', 'bill@example.com', 'Bill Gates')
         //->addMailHeader('Bcc', 'steve@example.com', 'Steve Jobs')
         ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
         ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
         ->setMessage($message)
         ->setWrap(100)
         ->send();
		return ($send) ? 'Success' : 'Failed';
}

