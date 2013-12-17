<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
session_start();
include("../database.inc.php");
//Get the details
$jid = mysql_real_escape_string($_POST['jobid']);
$uid = mysql_real_escape_string($_POST['userid']);
//Store the job ID User Id to favs
$_SESSION['userid'] = $uid;
$_SESSION['job_id'] = $jid;

	if($jid != '' || $jid != null){
		//Check if its already in favorites
		$r = favExists($uid, $jid);
		if($r === false){//NOT in DB
		  	//Put favorite in DB - User ID , Job ID
		  	$fav_sql = "INSERT INTO `favorites`
							(`user_id`,
							`job_id`)
							VALUES(
							$uid ,
							$jid )";
			$fav_result = mysql_query($fav_sql);
			$_SESSION['new_fav'] = mysql_insert_id();
			//Kill the session var
			$_SESSION['job_id'] = '';
		}
	  }

 	function favExists($uid, $jid){
		$sql = "SELECT * FROM favorites WHERE user_id=$uid AND job_id=$jid";
		$result = mysql_query($sql);
		$numrows = mysql_num_rows ( $result );//GET count
		if($numrows <>0){
			return true;//FAV already in DB
		}else{
			return false;//Go ahead and add fav
		}
 	}

    // Lets say everything is in order
    $output = array('status' => true, 'userId'=>$uid, 'jobid'=>$jid, 'insertid'=>$_SESSION['new_fav']);
    echo json_encode($output);
?>