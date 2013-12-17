<?php
  session_start();
  include("database.inc.php");
  $cvid = mysql_real_escape_string($_GET['id']);
  $result = mysql_query("SELECT * FROM `purchased_cvs` WHERE `employerid`='".$_SESSION['userid']."' AND `userid`='$cvid'");
  if(!mysql_num_rows($result))
  {

      $result = mysql_query("SELECT `credits` FROM `credits` WHERE `employerid`='".$_SESSION['userid']."'");
      list($credits) = mysql_fetch_array($result);
      if($credits == 0)
      {
	  header( 'Location: buycredits.php' ) ;
      }
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
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="pricingpage">
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
  if(!$_GET['id']) die("No CV selected!");
  if(!$_SESSION['userid']) die("<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=elogin.php?ret=buy&cv=".$_GET['id']."\">







</body></html>");

  if(isset($_POST['btnSubmit'])) {

    $result = mysql_query("UPDATE `credits` SET `credits`=`credits`-1 WHERE `employerid`='".$_SESSION['userid']."' LIMIT 1");
    $result = mysql_query("INSERT INTO `purchased_cvs` VALUES ('".$_SESSION['userid']."','$cvid')");
    echo "You have successfully purchased this CV! You can find it in your Purchased CV list on the employer's area.";
  }
  else {
    $result = mysql_query("SELECT * FROM `purchased_cvs` WHERE `employerid`='".$_SESSION['userid']."' AND `userid`='$cvid'");
    if(!mysql_num_rows($result)) {
      $result = mysql_query("SELECT `credits` FROM `credits` WHERE `employerid`='".$_SESSION['userid']."'");
      list($credits) = mysql_fetch_array($result);
      if($credits == 0)


 header( 'Location: buycredits.php' ) ;


      else {
        echo "<form name=\"frmConfirm\" method=\"post\">\n";
        echo "Are you sure you wish to purchase this CV?<br />\n";
        echo "<input type=\"submit\" name=\"btnSubmit\" value=\"Yes\"> <input type=\"button\" name=\"btnNo\" value=\"No\" onclick=\"history.back();\">\n";
        echo "</form>\n";
      }
    }
    else echo "You have already purchased this CV!";
  }
?>
</div>

</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
