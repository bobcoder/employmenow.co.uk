<?php
session_start();
include("database.inc.php");
//check employer is logged in
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user")
  die ("You need to <a href=\"login.php\">login</a> to continue, we are redirecting you now <META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=elogin.php\">
 </body></html>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="office/js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="office/js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
<!--        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>-->
		<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.dateFormat-1.0.js"></script>
        <script type="text/javascript" src="office/js/is.js"></script><!-- My special js :-) -->
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script>
		tinymce.init({
			selector : "textarea.tinymce",
			menubar : false,
			statusbar : false,
			mode : "textareas"
	});
	$(function() {
		$("#content-e").tooltip();
	});
</script>
</head>
<body class="browse">
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
		<div id="content-e">
			<div class="eleft">
				<h2>Post a Job</h2>
				<p><strong>Cheats tip - you can copy and paste from your current vacancy in the sections below</strong></p>
				<form id="jobs" name="jobs" method="post" class="cmxform">
				    <div id='new_jobs'>
				        <label for="ctitle"> <span>Title <span class="req">*</span></span>
				            <BR>
				            <input maxlength="255" size="80" id="ctitle" name="title" type="text" title="Brief title describing the job."/>
				        </label>
				        <br>
				        <label> <span>Job reference <span class="req">*</span></span>
				            <BR>
				            <input maxlength="255" size="30" name="ref" type="text" title="Your own ref number for this vacancy.">
				        </label>
				        <br>
				        <label> <span>Salary Notes </span>
				            <BR>
				            <input maxlength="255" size="30" name="salary_notes" type="text" title="Your own salary notes for this vacancy. Competitive salary, negotiable on experience, etc">
				        </label>
				        <br>
				        <label> <span>Salary Bracket</span>
				            <BR>
				            <select name='salary'>
				            	<option value='0'>Optional - Select Salary Range</option>
				                <option value='0-15000'>&pound;0 to &pound;15000</option>
				                <option value='15001-20000'>&pound;15001 to &pound;20000</option>
				                <option value='20001-25000'>&pound;20001 to &pound;25000</option>
				                <option value='25001-30000'>&pound;25001 to &pound;30000</option>
				                <option value='30001-35000'>&pound;30001 to &pound;35000</option>
				                <option value='35001-40000'>&pound;35001 to &pound;40000</option>
				                <option value='40001-50000'>&pound;40001 to &pound;50000</option>
				                <option value='50001-60000'>&pound;50001 to &pound;60000</option>
				                <option value='60001-70000'>&pound;60001 to &pound;70000</option>
				                <option value='70001-10000000'>&pound;70001 and above</option>
				            </select> </label>
				        <br>
				        <label><span>Description <span class="req">*</span></span></label>
				            <br><textarea class="tinymce" name="description" ></textarea>
				        <br>
				        <label><span>Job Type</span>
				            <BR>
				            <div id="wrap">
							  <div class="group1">
							      <input class="radio" type="radio" name="jobgroup1" value="Temp" checked/>Temp<br>
							      <input class="radio" type="radio" name="jobgroup1" value="Perm"  />Perm<br>
							      <input class="radio" type="radio" name="jobgroup1" value="Contract" />Contract
							   </div>
							   <div class="group2">
							      <input class="radio" type="radio" name="jobgroup2" value="Part Time" checked/>Part Time<br>
							      <input class="radio" type="radio" name="jobgroup2" value="Full Time" />Full Time<br>
							   </div>
							</div>
							 </label>
				        <br>
				        <label> <span>Industry</span>
				            <br>
				            <div id="industry"></div> </label>

				        <label> <span>Region/County</span>
				            <br>
				            <?php dumpCounties(""); ?>
				        </label>
				        <br>
				        <label> <span>Town/City <span class="req">*</span></span>
				            <BR>
				            <input maxlength="255" size="30" name="town" type="text" >
				        </label><br>
				        <label> <span>Expires Date</span>
				            <BR>
				            <input name="date_expires" type="text" id="date_expires" value="<?php echo date("d-m-Y");?>" />
				        </label><br>
				        <label> <span>Active</span>
				            <br>
				            <input checked="checked" form="jobs" value="1" name="active" id="active" type="checkbox">
				            <br>
				        </label>
				        <br>

				        <input type="hidden" id="employer_id" name="employer_id" value="<?php echo $_SESSION['userid']?>">
				        <input form="jobs" value="Post Job" id="newjob" class="searchbutton" name="submit" type="submit">
				        <br>
				    </div>
				</form>
			</div>
		</div>
		<div id="sidebar">
				<?php //require('inc/sidebar_search.php'); ?>
	            <div class="sidebarbox">
	                <div class="sideheader">
	               Post Your Jobs Here
	                </div>
	                <div class="sidecontent">
	                <div class="sidesection">
	                	<div>
                    	<p>Employers list your vacancy on our live jobs board for free</p>
						<p>We work with other leading jobs boards to ensure maximum exposure for your vacancy
						Receive applications direct to your chosen email account</p><p>
						Only pay per CV you wish to unlock, as per the main body of our website
						Potentially fill your vacancy for just £14.95 (the cost of one CV)</p>
                	</div>
	                	<div class="buttonsleft">
							<a class="jobsbutton" href="post_job.php">Post a job</a>
						</div>
	                </div>
	              </div>
	            </div>
		</div>
	</div>
	<div id="footer">
		<?php include("thefooter.php"); ?>
	</div>
</div>
<script>
	$(function() {//On doc ready
    	$( "#date_expires" ).datepicker({//Date picker
            dateFormat: 'dd-mm-yy',
            minDate: -0,
            defaultDate: +7,
        });//End date picker
    //Start form validation
    $('#jobs').validate({ // initialize the plugin
        rules: {
            title: {
                required: true
            },
            ref: {
                required: true
            },
            description: {
                required: true
            },
            town: {
                required: true
            },
            job_type: {
                required: true
            }
        },
        submitHandler: function (form) { // for demo
            event.preventDefault();
            	//Handle the dialog box
		    $( "#dialog-modal" ).dialog({
		      resizable: false,
		      height:240,
		      width: 350,
		      modal: true,
		      buttons: {
		        "Post Job": function() {
		                tinyMCE.get("description").save();
			            $.ajax({
			                url : 'office/job_add_db.php?action=addjob',
			                type : 'post',
			                dataType : 'text',
			                data : $('form#jobs').serialize(),
			                success : function(data) {
			                    $(".successbox").fadeIn(2000);
			                    window.location = 'ehome.php?msg=true';
			                },
			                error : function(jqXHR, textStatus, errorThrown) {
			                    $(".errormsgbox").fadeIn(2000);
			                    console.log(textStatus);
			                },
			            });
		        },
		        Cancel: function() {
		          $( this ).dialog( "close" );
		        }
		      }
		    });
        }
    });//END form validation
		var industry = "type=industry&update=true&";
        $.ajax({
            dataType : 'json',
            url : 'office/incs/db.inc.php',
            cache : false,
            data : industry,
            success : function(data, status, xhr) {
                var select = '<select id="industry_id" name="industry_id">';
                var option = '';
                $.each(data, function(index, value) {
                    option += '<option value=' + value.id + '>' + value.name + '</option>';
                });
                select = select + option + '</select>';
                $('#industry').html(select);
            },
            error : function(jqXHR, textStatus, errorThrown) {
                $(".errormsgbox").fadeIn(2000);
                console.log(textStatus);
            }
        });
	});//End doc ready
</script>
<div id="dialog-modal" title="Post Job" style="display: none;">
  <p>Thank you for posting your vacancy, it has been submitted for review, and is pending approval. Your vacancy will be live within 24 hours.</p>
</div>
</body>
</html>