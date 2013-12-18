<?php
session_start();
require_once ("database.inc.php");
if(isset($_GET['jobId'])){
    $jobs_id = mysql_real_escape_string($_GET['jobId']);
    $result = mysql_query("
        SELECT j.jobs_id, j.title, j.description, j.date_added, j.date_expires, j.salary, j.salary_notes, j.region, j.town, j.job_type, j.ref, j.number_views, ind.name
        FROM employmedb.jobs AS j, industries AS ind
        WHERE j.approved='1'
        AND j.active='1'
        AND j.industry_id = ind.id
        AND j.jobs_id = '$jobs_id'
    ");
    $r = mysql_fetch_assoc($result);

	$count_result_sql = mysql_query("UPDATE jobs SET
									number_views = number_views + 1
									WHERE jobs_id = $jobs_id");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
        <script type="text/javascript" src="jquery-1.7.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript"src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        <script type="text/javascript" src="js/gmap3.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-bc465b40-cad7-354d-c5bc-5e137c9c01b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
    </head>
    <body class="jobsearchpage">
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo">
                    <img src="images/logo.png" />
                </div>
                <?php
                    include ("navlogin.inc.php");
                ?>
                <?php
                    include ("themenu.php");
                ?>
            </div>
        </div>


        <div id="wrapper">
            <div id="page" class="container">
                <div id="content">
                    <div class="twodivs" id="twodivs"> 
                        <div class="generalleft faded">
                            <h3>Job Details</h3>
                                   <div class="searchlongbox">
                                   <h3 id="search-title"><?php echo "Job title:  " . $r['title'];?></h3>
                                   <div id="search-wrap">
                                       <div class="search-salary"><strong>Salary:</strong> &pound;<?php echo $r['salary'];?></div>
                                       <div class="search-location"><strong>Location:</strong> <?php echo $r['region'];?></div>
                                   </div>
                                   <div id="search-description"><?php echo $r['description'];?></div>
                                   <div id="search-added"><strong>Job Added:</strong> <?php echo date("d-m-Y", strtotime($r['date_added']));?></div>
                                   <div id="search-expires"><strong>Job Expiry Date:</strong> <?php echo date("d-m-Y", strtotime($r['date_expires']));?></div>
                                   <div id="search-ref"><strong>Job Reference Number:</strong> <?php echo $r['ref'];?></div>
                                   <div id="search-ref"><strong>Salary Notes:</strong> <?php echo $r['salary_notes'];?></div>
                                   <div id="search-ref"><strong>Type of Employment:</strong> <?php echo $r['job_type'];?></div>
                                   <?php
                                   $job_id = $r['jobs_id'];  

                                   if( isset($_SESSION['userid'])){
                                   		$atag = "<a id='jobapply' class='button' href='#'>Apply<br>
									   <span style='font-size:70%'>(Loggged In)</span></a>";
                                   }else{
                                   		$atag = "<a id='jobapply' class='button' href='#'>Registered<br>
									   <span style='font-size:70%'>(Login and apply)</span></a>";
                                   }
									   
									   
									   $atag1 = "<a id='jobapply_notreg' class='button' href='#'>Not registered?<br>
									   <span style='font-size:70%'>(Create your profile and apply)</span></a>";
									   if($_GET['peek']=='true'){
									   		$peek = "<a id='jobapply' class='button' href='candidate_jobs.php'>Back to your list</a>";
									   }
                                   echo "<div class='buttonsleft'><br/>$atag $peek $atag1</div>";
                                   ?>
                               </div>
                        </div>
                        <div class="generalright faded">
                                        <div class="jobsidebarbox">
                                            <H1 class="homeh1">Share This Job</h1>
                                            <div class="sidecontent"> <p>Share this CV with your social network</p>
                                                <span class='st_facebook_large' displayText='Facebook'></span>
                                                <span class='st_twitter_large' displayText='Tweet'></span>
                                                <span class='st_linkedin_large' displayText='LinkedIn'></span>
                                                <span class='st_pinterest_large' displayText='Pinterest'></span>
                                                <span class='st_email_large' displayText='Email'></span>
                                            </div>
                                        </div>
                            <H1 class="homeh1">Refine Search</H1><br>
                            <div id="refine_search" name="refine_search" class="refine_search">
                            <form action="jobs_search.php" method="get" id="jobsearchform">
                                <input name="keyword" type="text" size="20" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Keywords':this.value;" value="Keywords"><br>
                                <input name="location" id="location" type="text" size="50" value="Location"><br>
                                <select name="distance" id="distance">
                                          <option value="10">Distance from location</option>
                                          <option value="1">Upto 1 Mile</option>
                                          <option value="5">Within 5 Miles</option>
                                          <option value="10">Within 10 Miles</option>
                                          <option value="20">Within 20 Miles</option>
                                          <option value="30">Within 30 Miles</option>
                                          <option value="40">Within 40 Miles</option>
                                          <option value="60">Within 60 Miles</option>
                                          <option value="100">Within 100 Miles</option>
                                          <option value="over">100 Miles and over</option>
                                </select><br>
                                <div id="searchlist"></div>
                                <select name="salary">
                                    <option value="">Salary</option>
                                    <option value="0-15000">up to £15,000</option>
                                    <option value="15001-20000">£15,000 to £20,000</option>
                                    <option value="20001-25000">£20,000 to £25,000</option>
                                    <option value="25001-30000">£25,000 to £30,000</option>
                                    <option value="30001-35000">£30,000 to £35,000</option>
                                    <option value="35001-40000">£35,000 to £40,000</option>
                                    <option value="40001-50000">£40,000 to £50,000</option>
                                    <option value="50001-60000">£50,000 to £60,000</option>
                                    <option value="60001-70000">£60,000 to £70,000</option>
                                    <option value="70001-10000000">£70,000 and above</option>
                                    <option value="commission">Commission Only</option>
                                </select><br>
                                <select name="jobtype">
                                    <option value="">Select Job type</option>
                                    <option value="job type">Job type</option>
                                    <option value="Permanent">Permanent</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Temporary">Temporary</option>
                                    <option value="Part Time">Part Time</option>
                                </select><br>
                            <input type='hidden' name='search' id='search' value='1' />
                            <input name="btnHomeSearch" type="submit" class="sidebutton" value="Refine your search">
                            </form>
                            </div><br>
                            <h1 class="homeh1">Jobs Categories</h1><br>
                            <div id="industry_list"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="dialog-confirm" title="Check CV?">
  				<p class="dialog-confirm">
  					<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
  					Would you like to check your CV before applying?
  					<!--Register now/or login and complete your profile to apply-->
  				</p>
			</div>
            <div id="footer">
                <?php
                include ("thefooter.php");
 ?>
            </div>
    </body>
    <?php
    $user_li = $_SESSION['userid'];
	$_SESSION['job_id'] = $_GET['jobId'];
	$job_id = $_SESSION['job_id'];
    ?>
    <script type="text/javascript">
    $(document).ready(function() {
    var user_li = '<?php echo $user_li; ?>';
    $("#jobapply").click(function(){
    	    if(user_li ==''){
    			window.location.href = 'login.php?url=' + $(location).attr('href');
    		}
    	    $( "#dialog-confirm" ).dialog({
		      resizable: false,
		      height:180,
		      modal: true,
		      buttons: {
		        "Check CV": function() {
		         window.location.href = 'account.php?url=' + $(location).attr('href');
		        },
		        "Apply": function() {
		          window.location.href = 'job_apply.php?jobId=<?php echo $job_id;?>';
		        }
		      }
		    });
    });
	$('#jobapply_notreg').click(function(e) {
		window.location.href = 'register.php?url=' + $(location).attr('href');
	});


    //Location blur event
    $("#distance").prop("disabled", true);
    $('#distance').css('color','lightgray');
    $('#location').blur(function(){
        if($(this).val() != "Location"){
            $("#distance").prop("disabled", false);
            $('#distance').css('color','black');
        }else{
            $("#distance").prop("disabled", true);
            $('#distance').css('color','lightgray');
        }
    });//ENd location blur event
        $(".faded").each(function(i) {
            $(this).delay(i * 500).fadeIn(1000);
        });
        $(".faded").hide()
        $(".faded2").hide();
        $(".faded2").slideUp(1).delay(500).slideDown('slow');

        //Populate industry count list
        $.ajax({
          type: "POST",
          url: 'inc/get_industry_list.php',
          data: 'data',
          success: function(data) {
              build_industry_list(data);
              build_search_list(data);
          },
          dataType: 'json'
        });//GET Industry data
     });
     //Build the industry list with the available jobs
     function build_industry_list(data){
         var industrylist ='';
         $.each(data, function(index, value) {
              industrylist += '<div id="industry_id">';
              industrylist += '<div class="industry_item" style="width: 220px; float: left">';
              industrylist += '<a href="jobs_search_results.php?search=' + value.id + '">' + value.name + '</a></div>';
              industrylist += '<div class="count" style="width: 30px; float: right">';
              industrylist += '<a href="jobs_search_results.php?search=' + value.id + '">' + value.industry_count + '</a></div></div>';
         });
         $('#industry_list').html(industrylist);
     }//END build_industry_list
     //Build the search list with the available jobs
     function build_search_list(data){
        var select = '<select id="search_industry_id" name="search_industry_id">';
        var option = '';
         $.each(data, function(index, value) {
                    option += '<option value=' + value.id + '>' + value.name + '</option>';
         });
         option += '<option value="" selected>Industry</option>';
         select = select + option + '</select>';
         $('#searchlist').html(select);
     }//END build_search_list
    </script>
</html>
