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
<body class="newspage">
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
  $result = mysql_query("SELECT * FROM `news` WHERE `deleted`=0 ORDER BY `postdate`");
  while($output = mysql_fetch_row($result,MYSQL_ASSOC)) {
    echo "<div>\n";
    echo "<h2>".$output['title']."</h2>\n";
    echo $output['content'];
    echo "<p><i>Posted ".date("d/m/Y H:i",strtotime($output['postdate']))."</i></p>\n";
    echo "</div>\n";
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
