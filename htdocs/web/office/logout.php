<?php
session_start();
//session_destroy();
$_SESSION['loggedIn'] = 'false';
header('location: login.php');
exit();
?>