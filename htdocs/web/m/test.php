

<?php
require_once "includes/main.php";

?>
<!DOCTYPE html>
<html>
    <head>
    <title><?php echo formatTitle($title)?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
<!--
	<script src="jQuery.ui.datepicker.js"></script>
	<script src="jquery.ui.datepicker.mobile.js"></script>-->
<!--<link rel="stylesheet" href="assets/css/styles.css" />-->
    <!--<script type="text/javascript" src="assets/site.js"></script>-->
</head>
<body>
<div data-role="page">
	<div data-role="fieldcontain">
	<fieldset data-role="controlgroup" data-type="horizontal">
    <legend>UK resident since</legend>
    <!--<label for="SelUKResidMonth">Mon</label>-->
    <select name="SelUKResidMonth" id="SelUKResidMonth">
        <option>Mon</option>
        <option value="jan">January</option>
        <option value="feb">February</option>
        <option value="mar">March</option>
    </select>

    <!--<label for="SelUKResidDay">Day</label>-->
    <select name="SelUKResidDay" id="SelUKResidDay">
        <option>Day</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>

    <!--<label for="SelUKResidYear">Year</label>-->
    <select name="SelUKResidYear" id="SelUKResidYear">
        <option>Year</option>
        <option value="2011">2011</option>
        <option value="2010">2010</option>
        <option value="2019">2009</option>
    </select>
</fieldset>
</div>
</div>
</body>
</html>