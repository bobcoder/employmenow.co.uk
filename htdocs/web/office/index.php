<?php
ob_start();
require_once("header.php");
session_start();
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
    //Do summat
}
?>
<div style="padding-left:0px;">
	<h3 id='categories'>Dashboard</h3>
	<h4>Unapproved Posted Jobs</h4>
	<div id='jqxWidget' style="font-size: 13px;float:left">
    	<div id="jqxgrid">grid</div>
    	<div id="selectrowindex"></div>
	</div>

	<h4>Top 10 CV Views</h4>
	<div id='jqxWidget_top10' style="font-size: 13px;float:left">
    	<div id="jqxgrid_top10">grid</div>
    	<div id="selectrowindex"></div>
	</div>
</div>
<!--
<div class="dashboard-title">Unapproved Candidates</div>
	<div id='jqxWidget' style="font-size: 13px;float:left">
    	<div id="jqxgrid_candidates">grid</div>
    	<div id="selectrowindex"></div>
	</div>-->

<!--
<div class="dashboard-title">Unapproved Employers</div>
	<div id='jqxWidget' style="font-size: 13px;float:left">
    	<div id="jqxgrid_employers">grid</div>
    	<div id="selectrowindex"></div>
	</div>-->

<script src="js/dashboard_jobs.js"></script>
<script src="js/dashboard_candidates_top10.js"></script>
<!--<script src="js/dashboard_employers.js"></script>-->
<?php include("footer.php");?>
