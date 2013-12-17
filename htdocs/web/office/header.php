<?php
session_start();
include_once ("incs/database.inc.php");
include_once ("incs/db.inc.php");
$logout = "Logout";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/admin_menu.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--        <link rel="stylesheet" href="js/styles/jqx.arctic.css" type="text/css" />-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jqxcore.js"></script>
        <script type="text/javascript" src="js/jqxbuttons.js"></script>
        <script type="text/javascript" src="js/jqxscrollbar.js"></script>
        <script type="text/javascript" src="js/jqxmenu.js"></script>
        <script type="text/javascript" src="js/jqxgrid.js"></script>
        <script type="text/javascript" src="js/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="js/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="js/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="js/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="js/jqxpanel.js"></script>
        <script type="text/javascript" src="js/jqxcheckbox.js"></script>
        <script type="text/javascript" src="js/jqxlistbox.js"></script>
        <script type="text/javascript" src="js/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="js/jqxdata.js"></script>
        <script type="text/javascript" src="js/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="js/jqxtabs.js"></script>
        <script type="text/javascript" src="js/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="js/gettheme.js"></script>
        <script type="text/javascript" src="js/nav.js"></script>
<!--        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>-->
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery.dateFormat-1.0.js"></script>
        <script type="text/javascript" src="js/is.js"></script><!-- My special js :-) -->
        <script>
        tinymce.init({
            selector: "textarea"
         });</script>
    </head>
    <body>
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo">
                    <img src="../images/logo.png" />
                </div>
                <ul id="dropdown_nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="employers.php">Employers</a>
                        <ul class="sub_nav">
                            <li>
                                <a href="employers.php">All Employers</a>
                            </li>
                            <li>
                                <a href="employer_new.php">Add Employer</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="jobs.php">Jobs</a>
                        <ul class="sub_nav">
                            <li>
                                <a href="jobs.php">All Jobs</a>
                            </li>
                            <li>
                                <a href="job_new.php">Add Job</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="cvs.php?featured=false">CV's</a>
                        <ul class="sub_nav">
                            <li>
                                <a href="cvs.php?featured=false">Manage CV's</a>
                            </li>
                            <li>
                                <a href="cvs.php?featured=true">Featured CV's</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Options</a>
                        <ul class="sub_nav">
                            <li>
                                <a href="options.php">Salary</a>
                            </li>
                            <li>
                                <a href="job_categories.php">Job Categories</a>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><?php echo $logout;?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="wrapper">
            <div id="page" class="container">
                <div id="content">