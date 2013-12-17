<?php
  session_start();
  include("database.inc.php");  
  if(isset($_POST['btnCancel'])) $result = mysql_query("DELETE FROM `subscriptions` WHERE `employerid`='".$_SESSION['userid']."'");
  if(isset($_POST['btnSubmit'])) {
    $industries = "";
    $industries_names = "";
    foreach ($_POST['ind'] as $industry)
    {
        $industries .= $industry."|";
        
        $arrIndustry = mysql_fetch_row(mysql_query("SELECT `name` FROM `industries` WHERE `id`='".$industry."' LIMIT 1"),MYSQL_ASSOC);
        
        $industries_names .= $arrIndustry['name']."|";
    }
    $industries = substr($industries, 0, -1);
    $industries_names = substr($industries_names, 0, -1);
    $keywords = mysql_real_escape_string($_POST['keywords']);
    $result = mysql_query("SELECT * FROM `subscriptions` WHERE `employerid`='".$_SESSION['userid']."'");
    if(mysql_num_rows($result) === 0) 
    {
        $result = mysql_query("INSERT INTO `subscriptions` VALUES ('".$_SESSION['userid']."','".$industries."','".$industries_names."','".$keywords."')");
    }
    else 
    {
        $result = mysql_query("UPDATE `subscriptions` SET industries='".$industries."',industries_names='".$industries_names."',keywords='".$keywords."' WHERE employerid =".$_SESSION['userid']);
    }
	
	header ("location:http://employmenow.co.uk/web/emailalerts2.php"); 

	
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
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="home">
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
    <div class="generalleft2">        
    <?php
      $result = mysql_query("SELECT * FROM `subscriptions` WHERE `employerid`='".$_SESSION['userid']."' LIMIT 1");
      $sub = mysql_fetch_row($result,MYSQL_ASSOC);
    ?>
<form name="frmAlerts" method="post">
<h3>Choose industries</h3>
<table>
<?php
  $sect = explode("|",$sub['industries']);
  $result = mysql_query("SELECT `name`,`id`  FROM `industries` WHERE `deleted`=0");
  $t = mysql_num_rows($result);
  $ind = array();
  while($output = mysql_fetch_row($result)) $ind[] = $output;
  
  for($x=0;$x<$t;$x+=3) {
    echo "<tr>";
    for($y=0;$y<3;$y++) {
      if(isset($ind[$x+$y])) echo "<td><input type=\"checkbox\" name=\"ind[]\" value=\"".$ind[$x+$y][1]."\"".(in_array($ind[$x+$y][1],$sect)==true?" checked":"")."> ".$ind[$x+$y][0]."</td>";
    }
    echo "</tr>\n";
  }
?>
  </table>
  <h3>Keywords</h3>
  Seperated by spaces<br />
  <input type="text" name="keywords" value="<?php echo $sub['keywords']; ?>"><br />
  <input type="submit" class="button" name="btnSubmit" value="Save"> <input type="submit" name="btnCancel" class="button" value="Cancel subscription">
  
</form>
</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
