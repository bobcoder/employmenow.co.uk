<?php
session_start();
include ("database.inc.php");
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="employer"){
	header('location: login.php');
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
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="office/js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="office/js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="office/js/jqxcore.js"></script>
        <script type="text/javascript" src="office/js/jqxbuttons.js"></script>
        <script type="text/javascript" src="office/js/jqxscrollbar.js"></script>
        <script type="text/javascript" src="office/js/jqxmenu.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="office/js/jqxpanel.js"></script>
        <script type="text/javascript" src="office/js/jqxcheckbox.js"></script>
        <script type="text/javascript" src="office/js/jqxlistbox.js"></script>
        <script type="text/javascript" src="office/js/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="office/js/jqxdata.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="office/js/jqxtabs.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="office/js/gettheme.js"></script>
        <script type="text/javascript" src="office/js/nav.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.dateFormat-1.0.js"></script>
        <script type="text/javascript" src="office/js/is.js"></script><!-- My special js :-) -->
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="account">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<img src="images/logo.png" />
			</div>
		<?php	include ("navlogin.inc.php");?>
		<?php	include ("themenu.php");?>
		</div>
	</div>
	<div id="wrapper">
		<div id="page" class="container">
			<div id="content-home">
				<div class="longbox2">
					Template
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<?php	include ("thefooter.php");?>
	</div>
	<script>
		$(function() {//On doc ready

		}); //End doc ready
	</script>
	</body>
</html>
