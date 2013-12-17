<?php
  include("database.inc.php");
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
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
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
<?php
  if(!isset($_GET['c']) || !isset($_GET['e'])) echo "<span style=\"color: #FF0000\">Invalid activation link!</span>\n";
  else {
    // Employers
    if($_GET['m'] == "e") {
      $key = mysql_real_escape_string($_GET['c']);
      $email = base64_decode(mysql_real_escape_string($_GET['e']));
      $result = mysql_query("SELECT * FROM `activations` WHERE `email`='$email' AND `key`='$key'");
      if(!$result) echo "<span style=\"color: #FF0000\">Activation not found!</span>\n";
      else {
        $result = mysql_query("DELETE FROM `activations` WHERE `email`='$email' LIMIT 1");
        $result = mysql_query("UPDATE `employers` SET `active`=1 WHERE `email`='$email' LIMIT 1");
        echo "Your account has been activated, you may now <a href=\"elogin.php\">login</a>.";
      }    
    }
    // Users
    else {    
      $key = mysql_real_escape_string($_GET['c']);
      $email = base64_decode(mysql_real_escape_string($_GET['e']));
      $result = mysql_query("SELECT * FROM `activations` WHERE `email`='$email' AND `key`='$key'");
      if(!$result) echo "<span style=\"color: #FF0000\">Activation not found!</span>\n";
      else {
        $result = mysql_query("DELETE FROM `activations` WHERE `email`='$email' LIMIT 1");
        $result = mysql_query("UPDATE `users` SET `active`=1 WHERE `email`='$email' LIMIT 1");
        echo "Your account has been activated, you may now <a href=\"login.php\">login</a>.";
      }
    }
  }
?>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
