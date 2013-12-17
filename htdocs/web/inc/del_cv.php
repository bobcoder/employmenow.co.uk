<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
session_start();
include ("../database.inc.php");
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user"){
	header('location: elogin.php');
	exit();
}
 $eid = mysql_real_escape_string($_GET['eid']);
 $uid = mysql_real_escape_string($_GET['uid']);
//Delete purcahsed CV's
 $delcvSql = "DELETE FROM purchased_cvs WHERE employerid=$eid AND userid=$uid;";
 $result = mysql_query($delcvSql) or die("SQL Error 1: " . mysql_error());
 header('location: ../ehome.php');
exit();
?>