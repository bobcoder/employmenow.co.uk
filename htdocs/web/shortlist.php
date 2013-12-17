<?php ini_set('display_errors',0); ?>

<?php
  session_start();
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
<body class="eloginpage">
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
<?php
if(!$_SESSION['userid'])
	die("<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=elogin.php?ret=shortlist&cv=".$_GET['id']."\"></body></html>");

	$cvid = mysql_real_escape_string($_GET['id']);
	$action = mysql_real_escape_string($_GET['action']);
	//Check GET and act. Delete shortlisted candidate Or add one
	if($action == 'remove'){
		$result = mysql_query("DELETE FROM `shortlists` WHERE `employerid`='".$_SESSION['userid']."' AND `userid`='$cvid'");
		echo "<p>The CV has been removed from your shortlist, <a href=\"job_applications.php\">Back to the other applicants</a>.</p>\n";
	}else{
  	$result = mysql_query("SELECT * FROM `shortlists` WHERE `employerid`='".$_SESSION['userid']."' AND `userid`='$cvid'");
  		if(mysql_num_rows($result) > 0) echo "You have already shortlisted this CV";
  		else {
     		$result = mysql_query("INSERT INTO `shortlists` VALUES ('".$_SESSION['userid']."','$cvid')");
			 if(stristr($_SERVER['REFERER'],"browse.php")) echo "<p>The CV has been added to your shortlist,
			 <a href=\"javascript:history.back()\">go back</a>.</p>\n";
			 else echo "<p>The CV has been added to your shortlist, <a href=\"ehome.php\">go home</a>.</p>\n";
  			}
	}//END if then remove shortlist
?>
</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
