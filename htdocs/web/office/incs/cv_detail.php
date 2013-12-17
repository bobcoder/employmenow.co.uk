<?php
include_once ("database.inc.php");
$id = $_POST['id'];
    $json = array();
    $result = mysql_query("SELECT * FROM `users` WHERE active='1' AND `id`='$id'");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    header("Content-type: application/json");
    echo json_encode($json);
?>