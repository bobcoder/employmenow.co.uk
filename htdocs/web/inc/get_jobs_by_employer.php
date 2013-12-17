<?php
include ("../database.inc.php");
//Sanitize the input
$employer_id = mysql_real_escape_string($_GET['employer_id']);
echo getEmployerJobs($employer_id);
//function to get info by employer_id
function getEmployerJobs($employer_id) {
    $json = array();
    $result = mysql_query("SELECT * FROM `jobs` WHERE active='1' AND `employer_id`=$employer_id ORDER BY `title` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
?>