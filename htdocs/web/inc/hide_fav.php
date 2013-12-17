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
$userid = $_SESSION['userid'];
$id = mysql_real_escape_string($_POST['id']);
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="employer"){
	header('location: login.php');
	exit();
}
    	$favSql = "DELETE FROM favorites WHERE id=$id";
		$result = mysql_query($favSql) or die("SQL Error 1: " . mysql_error());
    	echo $result;
?>