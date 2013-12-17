<?php
/**
 * @package   Package
 * @author    Rob Broomfield <robertebroomfield@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.internetsurgeon.co.uk
 * @copyright 2013 Internet Surgeon
 */
?>
<!DOCTYPE html>
<html>
    <head>
    <title><?php echo formatTitle($title)?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
	<link rel="stylesheet" href="assets/css/styles.css" />
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>
    <script type="text/javascript" src="assets/jquery.validate.js"></script>
    <script type="text/javascript" src="assets/site.js"></script>

</head>
<body>
<div data-role="page" id="page1">
<div id="logo"><img src="assets/images/logo.png"></div>

	    <div data-role="header" data-theme="b">
               <a href="index.php" data-icon="home" data-iconpos="notext" data-transition="fade" data-ajax="false">Home</a>
               <h1><?php echo $title?></h1>
               <a href="#" data-icon="arrow-l" data-rel="back" data-transition="fade" data-iconpos="notext">Back</a>
	    </div>
		    <div data-role="content">