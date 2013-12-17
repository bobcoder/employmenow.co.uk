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
        
        <div class="generalleftbig">
        
		          <h2 class="white">Frequently Asked Questions</h2>
        <p>Please <a href="http://employmenow.co.uk/web/contact.php">contact us</a> if you have a question that is not answered below</p>
	 
     
     
     <h3>Why can I not upload my current CV to your website?</h3>
	      <p>We are not your conventional CV upload site. Employmenow.co.uk see your CV as one application where you can profile yourself direct to many potential employers. (To save time you can copy and paste your CV content into the relevant fields)<br />
	      </p>
		  	 <h3>Does it cost me anything to register on the site?</h3>
	      <p>No, it is completely free for job seekers and employers to register with employmenow.co.uk.<br />
	      </p>
		    <h3>When completing my work experience/ History, I have to put in a leaving date however I am still employed by my current employer?</h3>
	      <p>Input todays date, most employers understand that notice periods are required when in employment.</p>
		  	  <h3>Who will view my personal details?</h3>
<p>Only employers who purchase full access can view your personal details after registering with us.</p>
		   	<h3>How do I remove my CV from your website</h3>
<p>Login to your candidate area and there is an option to delete your account once you have found employment</p>
</div>
		</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
