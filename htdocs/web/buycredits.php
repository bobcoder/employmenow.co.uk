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
<script language="JavaScript" type="text/javascript">
  function setVal(q,v) {
    document.getElementById('amount_1').value = v;
    document.getElementById('item_name_1').value = q + ' credits';
  }
</script>
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
		<div id="content-home">


    <div class="generalleft">
    <h1 class="homeh1">Buy credits</h1>
    <table>
    <?php
      foreach($config['credits'] as $num => $val) {
        echo "<tr><td><input type=\"radio\" value=\"$num;".number_format($val, 2, '.', ',')."\" name=\"credSel\" onclick=\"setVal('$num','".number_format($val, 2, '.', ',')."')\"></td><td>$num credits</td><td>&pound;".number_format($val, 2, '.', ',')."</td></tr>\n";
      }
    ?>
    </table>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="return" value="http://employmenow.co.uk/web/success.php">
<input type="hidden" name="notify_url" value="http://employmenow.co.uk/ipn.php">
<input type="hidden" name="cancel_return" value="http://employmenow.co.uk/ehome.php">
<input type='hidden' name="rm" value="2">
<input type="hidden" name="business" value="info@employmenow.co.uk">
<input type="hidden" name="item_name_1" id="item_name_1" value="1 credit">
<input type="hidden" name="amount_1" id="amount_1" value="14.95">
<input type="hidden" name="quantity_1" id="quantity_1" value="1">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="lc" value="GB">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online." style="margin-left:25px;">
<img alt="" border="0" src="https://www.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

  <DIV CLASS="fix"></DIV>


  <div id="price1" class="faded">
<h2 class="pricetitle">Package 1</h2>



Just starting out, ideal to test our service

<h3 class="pricing">1 CV credit= £14.95</h3>

<br/><br/>


<FORM METHOD="LINK" ACTION="http://www.employmenow.co.uk/web/elogin.php">
<input name="btnHomeSearch" type="submit" class="searchbuttonprice" value="Buy now" /></form>

</div>
<div id="price1" class="faded">
<h2 class="pricetitle">Package 2</h2>

Ideal if you just need to find one candidate

<h3 class="pricing">5 CV Credits= £59.80 </h3>
(1 free credit)

<br/><br/>
<FORM METHOD="LINK" ACTION="http://www.employmenow.co.uk/web/elogin.php">
<input name="btnHomeSearch" type="submit" class="searchbuttonprice" value="Buy now" /></form>

</div>
</div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
