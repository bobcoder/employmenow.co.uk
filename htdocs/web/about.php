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
<body class="aboutpage">
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
 
<!--NO LONGER IN USE <?php
  $result = mysql_query("SELECT `content` FROM `cms_pages` WHERE `pagename`='about-us'");
  echo mysql_error();
  list($content) = mysql_fetch_array($result);
  echo $content;
?>-->

<h1 class="homeh1">Tired of dealing with recruitment agencies? You’re not the only one! </h1><br/>

<p>You might be an employer, paying high rates of commission to fill your vacancy. You might be looking for your perfect job, being screened and processed before a HR manager has even heard your name. Recruitment agencies can be expensive, they can rush the recruitment process in order to receive their fees and they work without any experience of the role they’re trying to fill. You deserve better. </p>

<p>The job market has never been more competitive. If you’re an employer, you’re likely to receive hundreds of applications for every vacancy you offer. If you’re looking for work, then you’re fighting for your job against hundreds of other people. </p>

<p>Recruitment agencies have, for a long time, been the chosen method of filling gaps in a workforce. Employers contact recruiters with their vacancies, agree to pay a fee to have their vacancy filled, and interview the candidates sent through to them. EmployMeNow is a different way of doing things. We cut out the middle-man, and make it easier for everyone.</p>


</div>    
        
        
        
        
        

</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
