<?php
  session_start();
  include("database.inc.php");
  
  $error = "";
  if(isset($_POST['submit'])) {
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $result = mysql_query("SELECT `id`,`name`,`active` FROM `users` WHERE `email`='$email' AND `password`='$password'");
    if(!$result)
    {
        $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
    }
    else
    {
      if (mysql_num_rows ( $result ) > 0)
      {
    
        list($id,$name,$active) = mysql_fetch_array($result);
        if($active == 0) $error = "<span style=\"color: #FF0000\">Account isn't active!</span>";
        else {
          $_SESSION['userid'] = $id;
          $_SESSION['name'] = $name;
          $_SESSION['email'] = $email;
          $_SESSION['mode'] = "user";
		  $result = mysql_query("UPDATE `users` SET last_login = NOW()  WHERE `email`='$email'");
		  	if(isset($_GET['url'])){
		  		header("Location: ". $_GET['url']);
		  	}else{
          		header("Location: ".$config['siteurl']."account.php");
			}//ENd redirect from job condition
        }
      }
      else
      {
           $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
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
        <h1 class="homeh1">Candidate login</h1><br/>
<?php
  echo $error;
?>
<form name="frmLogin" method="post">
<table>
<tr><td>E-mail address:</td><td><input type="text" class="login" name="email"></td></tr>
<tr><td>Password:</td><td><input type="password" class="login" name="password"></td></tr>
<tr><td colspan="2" align="right"><input type="submit" class="searchbutton" name="submit" value="Login"></td></tr>
</table>
<a href="register.php">Register for an account here</a> - <a href="http://employmenow.co.uk/web/forgot.php">Forgot your password?</a>
</form>
<!--Forgot your password? <a href="forgot.php">Click here</a>.-->
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
