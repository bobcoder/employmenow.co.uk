<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 *
 */
session_start();
include("../database.inc.php");
include("../inc/mail.class.php");
//Store the job ID
$jobs_id = mysql_real_escape_string($_POST['jobId']);
$_SESSION['jobId'] = $jobs_id;

$userid = $_SESSION['userid'];
if(isset($userid)){
/*
 * 	PUT A SHED LOAD OF CODE IN HERE TO REGISTER THE INTEREST.
 * PUT JOB REFERENCE IN CANDIDATES DASHBOARD
 * PUT CANDIDATE DETAILS IN EMPLOYERS DASHBOARD
 */
//GET candidate details
	$candidate_sql = "SELECT name, email FROM users WHERE id=$userid";
	$result_candidate = mysql_query($candidate_sql);
	$candidate_details = mysql_fetch_assoc($result_candidate);

//Get employer and job details
 $emp_sql = "SELECT
			    j.jobs_id AS job_id, j.ref AS ref, e.id AS employer_id,
			    e.email, e.companyname, e.name
			FROM
			    jobs AS j,
			    employers AS e
			WHERE
			    e.id = j.employer_id AND j.jobs_id = '$jobs_id'
			GROUP BY j.jobs_id;";
$result = mysql_query($emp_sql);
$emp_details = mysql_fetch_assoc($result);
$ref = $emp_details['ref'];

//Check we have a resulting row before tryin to insert data
if (mysql_num_rows($result) !=0 ){
	$emp_id = $emp_details['employer_id'];
	$user_id = $_SESSION['userid'];
	//Create the SQL
	$sql = "INSERT INTO `job_applications`
			(`job_id`,
			`candidate_id`,
			`employer_id`,
			`date_applied`)
			VALUES
			('$jobs_id',
			'$user_id',
			'$emp_id',
			CURRENT_TIMESTAMP
			);";
		//echo $sql;
		$result = mysql_query($sql) or die("SQL Error 1: " . mysql_error());

		//Set up the email message for employers
		$name = $emp_details['companyname'];
		$to_email = $emp_details['email'];
		$from_email = "no-reply@employmenow.co.uk";
		$sender_name = $name;
		$subject = "A new candidate has applied for $ref ";
		//$message = "Hello $name <br> Someone has just applied for a job with reference $ref";
		$message = "Hello $name <br>
		Please login to your employer account to view their CV details <br>
		<a href='http://employmenow.co.uk/web/elogin.php'>http://employmenow.co.uk/web/elogin.php</a>
		<br><br>Regards
		<br><br>The team
		<br><br>Employmenow.co.uk";
		send_mail($to_email, $sender_name, $from_email, $subject, $message);
		//Now send a message to the candidate
		$candidate_name = $candidate_details['name'];
		$candidate_to_email = $candidate_details['email'];
		$candidate_from_email = "no-reply@employmenow.co.uk";
		$candidate_sender_name = $candidate_name;
		$candidate_subject = "You have just applied for a job! Good luck";
		$candidate_message = "Hello $name <br>  Your CV has been successfully sent for job $ref
		<br><br>Good Luck
		<br><br>The team
		<br><br>Employmenow.co.uk";
		send_mail($candidate_to_email, $candidate_sender_name, $candidate_from_email, $candidate_subject, $candidate_message);
}
}
//Send mail function
function send_mail($to_email, $sender_name, $from_email, $subject, $message){
 	$mailer = new Simple_Mail();
	$send   = $mailer->setTo($to_email, $sender_name)
         ->setSubject($subject)
         ->setFrom('no-reply@employmenow.co.uk', 'Employmenow.co.uk')
         ->addMailHeader('Reply-To', 'no-reply@employmenow.co.uk', 'Employmenow.co.uk')
         //->addMailHeader('Cc', 'bill@example.com', 'Bill Gates')
         //->addMailHeader('Bcc', 'robertebroomfield@gmail.com', 'Steve Jobs')
         ->addGenericHeader('X-Mailer', 'PHP/' . phpversion())
         ->addGenericHeader('Content-Type', 'text/html; charset="utf-8"')
         ->setMessage($message)
         ->setWrap(100)
         ->send();
		return ($send) ? 'Success' : 'Failed';


}//END if user id is valid
    // Lets say everything is in order
    $output = array('status' => true, 'message' => 'Welcome!', 'userId'=>$_SESSION['userid'], 'jobid'=>$jobs_id, 'emailled'=>$send, 'where'=>'ta_apply');
    echo json_encode($output);
?>