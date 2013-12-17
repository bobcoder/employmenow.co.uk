<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
include_once ("../database.inc.php");
$uid = mysql_real_escape_string($_GET['id']);
    $json = array();
    $result = mysql_query("SELECT
							f.id,
							f.job_id AS jobid,
							j.jobs_id As jobsid,
							j.title,
							j.ref,
							j.date_expires
							FROM favorites AS f
							INNER JOIN jobs As j
							ON f.job_id = j.jobs_id
							WHERE f.user_id=$uid");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    //return json_encode($json);
    echo json_encode($json);
?>