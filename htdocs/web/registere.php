<?php
session_start();
  include("database.inc.php");

  $error = "";
  if(isset($_POST['submit'])) {
    $companyname = mysql_real_escape_string($_POST['companyname']);
    $contactname = mysql_real_escape_string($_POST['contactname']);
    $email = mysql_real_escape_string($_POST['email']);
    $telephone = mysql_real_escape_string($_POST['telephone']);
    $password = mysql_real_escape_string($_POST['password']);
    $terms = mysql_real_escape_string($_POST['terms']);
    $result = mysql_query("SELECT * FROM `employers` WHERE `email`='$email'");
    if(mysql_num_rows($result) > 0) $error = "E-mail address already registered!";
    if($terms != 'yes') $error = "Accept terms and conditions first!";
    if($error == "") {
      $result = mysql_query("INSERT INTO `employers` (`name`,`companyname`,`email`,`telephone`,`password`,`regdate`,`active`,`termsandconditions`) VALUES ('$contactname','$companyname','$email','$telephone','$password',NOW(),1,2)");
        //Create the message
            $msg = 'Employer Registration Details<br><br>';
            $msg .= 'Company Name: ' . $companyname . '<br>';
            $msg .= 'Contact: ' . $contactname . '<br>';
            $msg .= 'Email: ' . $email . '<br>';
            $msg .= 'Telephone: ' . $telephone . '<br>';
           //Send the email through the email class
            $sendit = new email_emn();
            $sendit->email_to = $config['adminaddress'];
            $sendit->headers_from = $config['email_header_from'];
            $sendit->headers_cc = $config['adminccaddress'];
            $sendit->subject = "Registration from emaploymenow.co.uk";
            $sendit->message = $msg;
            $sendit->send_email_html();
            //END email stuff
      if(!$result) $error = "Could not add user to database.";
      else {

          $html = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Employmenow</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333;
}

.button{padding: 5px;
background-color: #3399cc;
width: 200px;
color: #ffffff;
text-decoration: none;
margin-top: 10px;}


.headline{


	font-size: 16px;
color: #13a5e4;

}


p{margin:0px;}


</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="http://employmenow.co.uk/web/images/logo.png" alt="Employmenow.co.uk" />
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><hr /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
';
$html2 = '
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td><img src="http://employmenow.co.uk/web/images/logo.png" alt="Employmenow.co.uk" /></td>
  </tr>
</table>
</body>
</html>
';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: EmployMeNow <noreply@employmenow.co.uk>";
        mail($email,"You're now registered as an employer at employmenow",$html."You're now regsitered! Thank you.".$html2,$headers);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $result = mysql_query("SELECT `id`,`name`,`active` FROM `employers` WHERE `email`='$email' AND `password`='$password'");
        if(!$result) $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
        else {
          list($id,$name,$active) = mysql_fetch_array($result);
          if($active == 0) $error = "<span style=\"color: #FF0000\">Account isn't active!</span>";
          else {

            $_SESSION['userid'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['mode'] = "employer";
            header("Location: ".$config['siteurl']."ehome.php");
          }
        }




      }
    }
  }
  else {
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
<script language="JavaScript" type="text/javascript" src="miscfunc.js"></script>
<script language="JavaScript" type="text/javascript">
    function checkForm() {
        var ok = true;
        if (document.getElementById('contactname').value == '') {
            document.getElementById('contactnameCell').style.background = '#FF0000';
            ok = false;
        } else
            document.getElementById('contactnameCell').style.background = '#FFFFFF';
        if (document.getElementById('email').value == '' || !validateEmail(document.getElementById('email').value)) {
            document.getElementById('emailCell').style.background = '#FF0000';
            ok = false;
        } else
            document.getElementById('emailCell').style.background = '#FFFFFF';
        if (!$("#terms").is(':checked')) {
            document.getElementById('termsCell').style.background = '#FF0000';
            ok = false;
        } else
            document.getElementById('termsCell').style.background = '#FFFFFF';

        if (!ok)
            document.getElementById('msgErr').innerHTML = 'Please correct the problems highlighted.';
        return ok;
    }
</script>
</head>
<body class="eloginpage">
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/logo.png" />
		</div>
<?php
include ("navlogin.inc.php");
?>
<?php
include ("themenu.php");
?>
</div>
</div>
<div id="wrapper">
<div id="page" class="container">
<div id="content">
<div class="generalleft">
<h1 class="homeh1">Register for an Employer account</h1><br />
<form name="frmRegister" method="post" onsubmit="return checkForm();">
<table>
<tr><td>Company Name:</td><td id="companynameCell"><input type="text" class="login" name="companyname" id="companyname"></td></tr>
<tr><td>Contact Name:</td><td id="contactnameCell"><input type="text" class="login" name="contactname" id="contactname"></td></tr>
<tr><td>E-mail:</td><td id="emailCell"><input type="text" name="email" class="login" id="email"></td></tr>
<tr><td>Telephone:</td><td id="telephoneCell"><input type="text" class="login" name="telephone" id="telephone"></td></tr>
<tr><td>Password:</td><td id="passwordCell"><input type="password" class="login" name="password" id="password"></td></tr>
<tr><td><span class="field">Terms and Conditions:</span></td><td id="termsCell"><input type='checkbox' name="terms" id="terms" value='yes'>I've read them and accept. <a href="http://employmenow.co.uk/web/terms.php">Read here</a></td></tr>
<tr><td colspan="2" align="right"><input type="submit" class="searchbutton" name="submit" value="Register"></td></tr>
</table>
</form>
<?php
echo_it();
function echo_it(){
    echo 'Done!';
}

}
echo "<span style=\"color: #FF0000\" id=\"msgErr\">$error</span>\n";
?>
</div>
</div>
</div>
<div id="footer">
<?php
include ("thefooter.php");
?>
</div>
</body>
<?php ?>