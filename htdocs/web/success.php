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
<?php
// Array ( [mc_gross] => 29.90 [protection_eligibility] => Eligible [address_status] => confirmed [item_number1] => [payer_id] => AYKFM2Z9Z2CSC [tax] => 0.00 [address_street] => 1 Main Terrace [payment_date] => 13:12:59 Apr 28, 2013 PDT [payment_status] => Completed [charset] => windows-1252 [address_zip] => W12 4LQ [mc_shipping] => 0.00 [mc_handling] => 0.00 [first_name] => Scurvy [mc_fee] => 1.22 [address_country_code] => GB [address_name] => Scurvy Bob [notify_version] => 3.7 [custom] => [payer_status] => verified [business] => noreply@employmenow.co.uk [address_country] => United Kingdom [num_cart_items] => 1 [mc_handling1] => 0.00 [address_city] => Wolverhampton [payer_email] => screwballs@yahoo.co.uk [verify_sign] => Ari-FLl1lGbeWmvlad8Y7oJDGCsIA3tb8BV3i4K8m1Uk1gSUzFzVqAwj [mc_shipping1] => 0.00 [tax1] => 0.00 [txn_id] => 47U81546NM328060H [payment_type] => instant [last_name] => Bob [address_state] => West Midlands [item_name1] => 1 credit [receiver_email] => noreply@employmenow.co.uk [payment_fee] => [quantity1] => 1 [receiver_id] => DSTKV98BK3AW4 [txn_type] => cart [mc_gross_1] => 29.90 [mc_currency] => GBP [residence_country] => GB [test_ipn] => 1 [transaction_subject] => Shopping Cart1 credit [payment_gross] => [merchant_return_link] => click here [auth] => Ah-.98WVx0xP3bemASUNv5RXhOiUf-BJv2Wcxh0M5giVvlsQYejZX.RNX8rosWM4G7X7WyCeu117MP56MOcQS6g ) 
  if($_POST['payment_status'] == "Completed") {
    foreach($config['credits'] as $num => $val) {
      if($_POST['mc_gross_1'] == $val) {
        $inc = $num;
      }
    }
    $result = mysql_query("SELECT * FROM `credits` WHERE `employerid`='".$_SESSION['userid']."' LIMIT 1");
    if(mysql_num_rows($result) == 0) $up = mysql_query("INSERT INTO `credits` VALUES ('".$_SESSION['userid']."','$inc')");
    else $up = mysql_query("UPDATE `credits` SET `credits`=`credits` + $inc WHERE `employerid`='".$_SESSION['userid']."' LIMIT 1");
    echo "Your credits have been successfully applied, <a href=\"ehome.php\">return home</a>.";
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
