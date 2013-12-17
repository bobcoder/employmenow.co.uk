<?php
  session_start();
  include("database.inc.php");
  
  $error = "";
  if(isset($_POST['submit'])) {
    $email = mysql_real_escape_string($_POST['email']);
    $result = mysql_query("SELECT `id`,`name`,`active`,`password` FROM `users` WHERE `email`='$email'");
    if(!$result) $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
    else {
      list($id,$name,$active,$password) = mysql_fetch_array($result);
      if($active == 0) $error = "<span style=\"color: #FF0000\">Account isn't active!</span>";
      else {
        $msg = "Your password is: $password\n";
        mail($email,"Forgotten password request for employmenow.co.uk",$msg,"From: employmenow.co.uk <noreply@employmenow.co.uk>");
        $error = "Your password has been sent to you at<br />$email";
      }
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
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="loginpage">
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
        <div class="generalleft faded">
        <h1 class="homeh1">Forgotten password</h1><br/>
<?php
  echo $error;
  if(!isset($_POST['submit'])) {
?>
<form name="frmLogin" method="post">
Enter your email address below to have your password sent to you.
<table>
<tr><td>E-mail address:</td><td><input type="text" class="login" name="email"></td></tr>
<tr><td colspan="2" align="right"><input type="submit" class="searchbutton" name="submit" value="Send"></td></tr>
</table>
<a href="register.php">Register for an account here</a>
</form>
<?php
  }
?>
</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
<script type="text/javascript">
$(".faded").each(function(i) {
  $(this).delay(i * 500).fadeIn(1000);
});

$(".faded").hide()



$(document).ready(function() {
     $(".faded2").hide();
     $(".faded2").slideUp(1).delay(500).slideDown('slow');
});





</script>
</html>
