<?php
  session_start();
  include("database.inc.php");  
  if(isset($_POST['btnCancel'])) $result = mysql_query("DELETE FROM `subscriptions` WHERE `employerid`='".$_SESSION['userid']."'");
  if(isset($_POST['btnSubmit'])) {
    $industries = mysql_real_escape_string($_POST['industries']);
    $keywords = mysql_real_escape_string($_POST['keywords']);
    $result = mysql_query("SELECT * FROM `subscriptions` WHERE `employerid`='".$_SESSION['userid']."'");
    if(mysql_num_rows($result) === 0) $result = mysql_query("INSERT INTO `subscriptions` VALUES ('".$_SESSION['userid']."','$industries','$keywords')");
	
	header ("location:http://employmenow.co.uk/web/emailalerts2.php"); 

	
  }
?>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Give+You+Glory' rel='stylesheet' type='text/css'>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="home">
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/logo.png" />
		</div>
<?php include("navlogin.inc.php"); ?>
		    <?php include("themenu.php"); ?>

	</div>
</div>


<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
    <div class="generalleft">        
    <h2 class="homeh1">Thank you</h1>
    <p>We have your details and will post out relevent information.</p>
    <a class="button" href="ehome.php">Back to your employer home</a>
</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
