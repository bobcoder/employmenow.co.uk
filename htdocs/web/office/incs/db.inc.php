<?php
include_once ("database.inc.php");

switch ($_GET['type']) {
    case 'industries' :
        echo getIndustries();
        break;
    case 'cvs':
        echo getCvs();
        break;
    case 'top10':
        echo getCvsTop10();
        break;
    case 'cvs_by_id':
        echo getCvsById($_GET['id']);
        break;
    case 'cvsfeatured':
        echo getCvsFeatured();
        break;
    case 'jobs':
        echo getJobs();
        break;
    case 'employerjobs':
        echo getEmployerJobs();
        break;
    case 'jobsById':
        echo getJobsById($_GET['id']);
        break;
    case 'employers':
        echo getEmployers();
        break;
    case 'industry':
        echo getIndustry();
        break;
}

if (isset($_GET['delete']) && $_GET['tbl'] == 'industries' ) {
    $delete_query = "DELETE FROM `industries` WHERE `id`='".$_GET['id']."'";
    $result = mysql_query($delete_query) or die("SQL Error 1: " . mysql_error());
    echo $result;
}else if(isset($_GET['update']) && $_GET['tbl'] == 'industries'){
     $update_query = "UPDATE `industries` SET `name`='".$_GET['name']."' WHERE `id`='".$_GET['id']."'";
     $result = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
     echo $result;
}else if(isset($_GET['update']) && $_GET['tbl'] == 'cvss'){
     $update_query = "UPDATE `industries` SET `name`='".$_GET['name']."' WHERE `id`='".$_GET['id']."'";
     $result = mysql_query($update_query) or die("SQL Error 1: " . mysql_error());
     echo $result;
}else if (isset($_GET['delete']) && $_GET['tbl'] == 'jobs' ) {
    $delete_query = "DELETE FROM `jobs` WHERE `jobs_id`='".$_GET['id']."'";
    $result = mysql_query($delete_query) or die("SQL Error 1: " . mysql_error());
    echo $result;
}


function getIndustries() {
    $json = array();
    $result = mysql_query("SELECT id, name FROM `industries` ORDER BY `name` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getCvs() {
    $json = array();
    $result = mysql_query("SELECT id, name, county, jobtitle, how, salary FROM `users` WHERE active='1' ORDER BY `name` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getCvsById($id) {
    $json = array();
    $result = mysql_query("SELECT * FROM `users` WHERE active='1' AND `id`='123'");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    header("Content-type: application/json");
    echo "{\"data\":" .json_encode($json). "}";
}
function getCvsFeatured() {
    $json = array();
    $result = mysql_query("SELECT id, name, county, jobtitle, how, salary FROM `users` WHERE `featured`='1' AND active='1' ORDER BY `name` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getJobs() {
    $json = array();
    $result = mysql_query("SELECT * FROM `jobs` WHERE active='1' ORDER BY `title` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getEmployers() {
    $json = array();
    $result = mysql_query("SELECT * FROM `employers` ORDER BY `companyname` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getIndustry() {
    $json = array();
    $result = mysql_query("SELECT `id`, `name` FROM `industries` ORDER BY `name` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getJobsById($id) {
    $json = array();
    $result = mysql_query("SELECT * FROM `jobs` WHERE jobs_id='$id' ORDER BY `title` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
function getEmployerJobs() {
    $json = array();
    $result = mysql_query("SELECT * FROM `jobs` WHERE active='1' ORDER BY `title` ASC");
    while ($r = mysql_fetch_assoc($result)) {
        $json[] = $r;
    }
    return json_encode($json);
}
?>