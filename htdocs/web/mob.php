<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
 session_start();
 $_SESSION['full'] = 'false';


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
<!--        <link rel="stylesheet" href="js/styles/jqx.arctic.css" type="text/css" />-->
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
        <script type="text/javascript" src="js/detectmobilebrowser.js"></script>
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="browse">
<div id="header-wrapper">
	<div id="isbrow"></div>
	<div id="brow"></div>
</div>
</body>
</html>
<script>
	$(function() {//On doc ready
		var ismobile = jQuery.browser.mobile;
		var full = '<?php echo $_GET['full'];?>';
		$('#isbrow').html('Mobile = ' + ismobile + " Is full site: " + full);
		if(ismobile === true && full=='' ){
			$('#brow').html('Mobile');
			window.location = 'http://employmenow.co.uk/web/m/index.html';
		}else{
			$('#brow').html('Desktop');
			window.location = 'http://employmenow.co.uk/web/';
		}
	});//END doc ready
</script>