<?php
  session_start();
  include("database.inc.php");

	
  $error = "";
  if(isset($_POST['submit'])) {
    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $dob = mysql_real_escape_string($_POST['year']);
    $tmpm = mysql_real_escape_string($_POST['month']);
    if($tmpm < 10) $tmpm = "0".$tmpm;
    $tmpd = mysql_real_escape_string($_POST['day']);
    if($tmpd < 10) $tmpd = "0".$tmpd;
    $dob .= "-$tmpm-$tmpd";
    $town = mysql_real_escape_string($_POST['town']);
    $county = mysql_real_escape_string($_POST['county']);
	    $how = mysql_real_escape_string($_POST['how']);
    $terms = mysql_real_escape_string($_POST['terms']);
    $eligible = mysql_real_escape_string($_POST['eligible']);

    $phone = mysql_real_escape_string($_POST['phone']);
	$mobile = mysql_real_escape_string($_POST['mobile']);

    $result = mysql_query("SELECT * FROM `users` WHERE `email`='$email'");
    if(mysql_num_rows($result) > 0) $error = "E-mail address already registered!";
    if($terms != 'yes') $error = "Accept terms and conditions first!";
    if($eligible != 'yes') $error = "You must be eligible to work in the UK to use this site.";
    if($error == "") {
      $coords = getLatLong($town);

      $result = mysql_query("INSERT INTO `users` (`name`,`email`,`password`,`dob`,`town`,`county`,`how`,`phone`,`mobile`,`regdate`,`active`,`lat`,`lon`,`termsandconditions`,`last_login`) VALUES ('$name','$email','$password','$dob','$town','$county','$how','$phone','$mobile',NOW(),1,'".$coords['lat']."','".$coords['lon']."','2',NOW())");
	  $new_user = mysql_insert_id();

	if(isset($_SESSION['job_id']) && isset($new_user)){
		$fav = new Fav();//Call the fav check exists class function
		$job_id = $_SESSION['job_id'];
		//Check if its already in favorites
		$r = $fav->favExists($new_user, $job_id);
			if($r == 'false'){//NOT in DB
				//Put favorite in DB - User ID , Job ID
				$fav_sql = "INSERT INTO `favorites`
								(`user_id`,
								`job_id`)
								VALUES(
								$new_user,
								$job_id )";
				$fav_result = mysql_query($fav_sql);
				$_SESSION['new_fav'] = mysql_insert_id();
				//Kill the session var
				unset($_SESSION['job_id']);
				$fav_added = 1;
			}
	}

              //Create the message
            $msg = 'Candidate Registration Details<br><br>';
            $msg .= 'Contact: ' . $name . '<br>';
            $msg .= 'Email: ' . $email . '<br>';
            $msg .= 'Mobile: ' . $mobile . '<br>';
            $msg .= 'Telephone: ' . $telephone . '<br>';
           //Send the email through the email class
            $sendit = new email_emn();
            $sendit->email_to = $config['adminaddress'];
            $sendit->headers_from = $config['email_header_from'];
            $sendit->headers_cc = $config['adminccaddress'];
            $sendit->subject = "Candidate Registration from emaploymenow.co.uk";
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
        mail($email,"You're now registered at employmenow",$html."You're now regsitered! Thank you.".$html2,$headers);
        $email = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        $result = mysql_query("SELECT `id`,`name`,`active` FROM `users` WHERE `email`='$email' AND `password`='$password'");
        if(!$result) $error = "<span style=\"color: #FF0000\">Invalid username/password</span>";
        else {
          list($id,$name,$active) = mysql_fetch_array($result);
          if($active == 0) $error = "<span style=\"color: #FF0000\">Account isn't active!</span>";
          else {
            $_SESSION['userid'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['mode'] = "user";
            header("Location: ".$config['siteurl']."account.php?favadded=".$fav_added);
          }
        }
      }
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find a job with employmenow</title>
<meta name="keywords" content="EmployMeNow is a different way of doing things. We cut out the middle-man, and make it easier for everyone." />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />

<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script language="JavaScript" type="text/javascript" src="miscfunc.js"></script>
<script language="JavaScript" type="text/javascript">
  function checkForm()

  {
    var ok = true;
    if(document.getElementById('name').value == '') {
      document.getElementById('nameCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('nameCell').style.background = '#FFFFFF';
    if(document.getElementById('email').value == '' || !validateEmail(document.getElementById('email').value)) {
      document.getElementById('emailCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('emailCell').style.background = '#FFFFFF';
    if(document.getElementById('town').value == '') {
      document.getElementById('townCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('townCell').style.background = '#FFFFFF';

    if(!$("#terms").is(':checked'))
    {
      document.getElementById('termsCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('eligibleCell').style.background = '#FFFFFF';
    if(!$("#eligible").is(':checked'))
    {
      document.getElementById('eligibleCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('eligibleCell').style.background = '#FFFFFF';
<?php
  if(!stristr($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0") && !stristr($_SERVER['HTTP_USER_AGENT'],"MSIE 8.0")) {
?>
    if(document.getElementById('county').value == '') {
      document.getElementById('countyCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('countyCell').style.background = '#FFFFFF';
<?php
  }
?>
    if(document.getElementById('mobile').value == '') {
      document.getElementById('mobileCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('mobileCell').style.background = '#FFFFFF';
    if(document.getElementById('phone').value == '') {
      document.getElementById('phoneCell').style.background = '#FF0000';
      ok = false;
    }
    else document.getElementById('phoneCell').style.background = '#FFFFFF';
    if (!ok)
    {
        document.getElementById('msgErr').innerHTML = 'Please correct the problems highlighted.';
    }

    return ok;
  }
</script>
</head>
<body class="submitpage">
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/logo.png" />
		</div>
<?php include("navlogin.inc.php"); ?>
		    <?php include("themenu.php"); ?>

	</div>
	<!--<div id="socialfooter"></div>-->
</div>

<div id="wrapper">
	<div id="page" class="container">
		<div id="contentsubmit" >


        <div class="submitleft faded">
        <h1 class="homeh1">Build your CV</h1>


<form name="frmRegister" method="post" onsubmit="return checkForm();">
<table>
<tr>
  <td>&nbsp;</td>
  <td id="nameCell2">&nbsp;</td>
</tr>
<tr><td><span class="field">Name:</span></td><td id="nameCell"><input type="text" name="name" id="name" class="registerfield"></td></tr>
<tr><td><span class="field">E-mail:</span></td><td id="emailCell"><input type="text" name="email" id="email" class="registerfield"></td></tr>
<tr><td><span class="field">Password:</span></td><td id="passwordCell"><input type="password" name="password" id="password" class="registerfield"></td></tr>
<tr>
  <td colspan="2"><hr /></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td><span class="field">Date of birth</span></td>
</tr>
<tr><td>&nbsp;</td><td><select name="day" class="day"><?php dumpDays(-1); ?></select> <select name="month" class="month"><?php dumpMonths(-1); ?></select> <select name="year" class="year"><?php dumpYears(70,date('Y')); ?></select></td></tr>
<tr>
  <td colspan="2"><hr /></td>
  </tr>
<tr><td><span class="field">Town:</span></td><td id="townCell"><input type="text" name="town" id="town" class="registerfield"></td></tr>
<tr><td><span class="field">County:</span></td><td id="countyCell"><?php dumpCounties(""); ?></td></tr>
<tr><td><span class="field">Phone:</span></td><td id="phoneCell"><input type="text" name="phone" id="phone"></td></tr>
<tr><td><span class="field">Mobile:</span></td><td id="mobileCell"><input type="text" name="mobile" id="mobile"></td></tr>
<tr><td><span class="field">How did you hear about us:</span></td><td id="mobileCell"><?php dumpHow(""); ?></td></tr>
<tr><td><span class="field">Terms and Conditions:</span></td><td id="termsCell"><input type='checkbox' name="terms" id="terms" value='yes'>I've read them and accept. <a href="<?php echo $config['baseurl']?>termsandconditions.pdf" target="_blank">Download here</a></td></tr>
<tr><td><span class="field">Are you eligible to work in the UK:</span></td><td id="eligibleCell"><input type='checkbox' name="eligible" id="eligible" value='yes'>Yes, I am eligible to work in the UK.</td></tr>


<tr><td colspan="2" ><input type="submit" name="submit" value="Register" class="searchbutton"></td></tr>
</table>
Having problems signing up or need any assistance? <a href="mailto:info@employmenow.co.uk">Get in touch </a>
</form>
<?php
  if ($error != "")
  {
    echo "<span style=\"color: #FF0000\" id=\"msgErr\">$error</span>\n";
  }
?>
</div>


 <div class="submitright faded">
 <h1 class="homeh1">Sign up now!</h1>
        <h2 class="homeh2">You are nearly employed!</h2><div class="submit1">
If you’re applying for jobs through a recruitment agency, you’re not reaching as many employers as you could be. Your recruiter is working as a filter system, and might not think you’re suitable for a role. What if your perfect job is out there and your details aren’t passed on?
</div>
<div class="submit2">

With EmployMeNow, your CV will be viewed by employers who’ll decide if you’re suitable for them. It’s direct. It’s simple. It works. You’re in control of how you present yourself, and whether or not you’re chosen for interview.

</div>
<div class="submit3">

It doesn’t matter if you’re currently unemployed or looking for the next step in your career. If your current job situation can’t be described as ‘perfect’, why not register free and post your CV?
</div>



</div>


</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>

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
</body>
</html>
