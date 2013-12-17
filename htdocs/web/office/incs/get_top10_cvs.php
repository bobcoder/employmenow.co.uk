<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
session_start();
include_once ("../config.inc.php");
include_once ("database.inc.php");
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}
$json = array();
$top10_query = "SELECT id, name, email, mobile, town, county, views
				FROM `users`
				ORDER BY views DESC
				Limit 10";
$result = mysql_query($top10_query) or die("SQL Error 1: " . mysql_error());

    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }

    header("Content-type: application/json");
    echo json_encode($json);

?>