<?php
session_start();
require_once ("database.inc.php");

unset($origin);
if(isset($_GET['search'])){
    if (mysql_real_escape_string($_GET['keyword'])=='Keywords'){
        $keyword ="";
    }else{
        $keyword = mysql_real_escape_string($_GET['keyword']);
    }
    if (mysql_real_escape_string($_GET['location'])=='Location'){
        $location ="";
    }else{
        $origin = mysql_real_escape_string($_GET['location']);
    }
    $distance = mysql_real_escape_string($_GET['distance']);//Search by miles radius driving
    $salary = mysql_real_escape_string($_GET['salary']);
    $jobtype = mysql_real_escape_string($_GET['jobtype']);
    $industry_id = mysql_real_escape_string($_GET['search_industry_id']);
    if($industry_id ==''){ $industry_id = '%'; }
    $search_res = array();
    $search_result = mysql_query("SELECT
    jobs.jobs_id, jobs.title, jobs.description, jobs.town, jobs.salary, jobs.region, jobs.date_added, ind.name
FROM
    jobs,
    industries AS ind
WHERE
    jobs.industry_id = ind.id
AND (jobs.active = '1')
AND (jobs.approved = '1')
AND ((jobs.title LIKE '%$keyword%') OR (jobs.description LIKE '%$keyword%'))
AND (ind.name LIKE '%$jobtype%')
AND (ind.id LIKE '$industry_id')
AND (jobs.town LIKE '%$location%')
AND (jobs.salary LIKE '%$salary%')
ORDER BY date_added DESC");
//echo $origin;
while ($r = mysql_fetch_assoc($search_result)) {
    if(isset($origin)){
        //Encode the town and region
        $dest = urlencode($r['town'] . " " . $r['region']);
        //Get the distance
        $dist = get_distance($origin, $dest);
        //Get the miles from the distance
        $miles = explode(" ", $dist['rows'][0]['elements'][0]['distance']['text']);
        //Trim the spaces
        $r['miles'] = trim($miles[0]);

        if($distance == 1 && $r['miles'] <=1){
            //All jobs under 1 mile
            $search_res[] = $r;
        }else if($distance == 'over' && $r['miles'] > 100){
            //All jobs over 100 miles
            $search_res[] = $r;
        }else if($r['miles'] < $distance && $distance != 'over'){
            //All jobs in between
            $search_res[] = $r;
        }
    }else{
        $search_res[] = $r;
    }

}
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
        <script type="text/javascript" src="js/jPages.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
        <link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
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
                           <div id="search_results">
                           </div>
                           <?php
                           if (count($search_res) == 0) {?>
                               <div class="searchlongbox">
                                   <h3>
                                        Sorry No results
                                   </h3>
                               </div>
                           <?php
                            }else{
                            	?>
                            	<ul id="itemContainer">
                            	<?php
                           foreach ($search_res as $value) {?>
								<li>
								   <div class="searchlongbox">
									   <h3 id="search-title"><?php echo "Job title:  " . $value['title'];?></h3>
									   <div id="search-wrap">
										   <div class="search-salary"><strong>Salary:</strong> &pound;<?php echo $value['salary'];?></div>
										   <div class="search-location"><strong>Location:</strong> <?php echo $value['region'];?></div>
									   </div>
									   <div id="search-description-short"><?php echo limit_text($value['description'], 40);?></div>
									   <div id="search-added"><strong>Job Added:</strong> <?php echo date("d-m-Y", strtotime($value['date_added']));?></div>
									   <?php
									   $job_id = $value['jobs_id'];
									   echo "<div class='buttonsleft'><br/><a id='sendmore' class='button'
									   href=jobs_details.php?jobId=$job_id>find out more</a></div>";
									   ?>
								   </div>
								</li>
							<?php }?>
							</ul>
							<!-- navigation holder -->
							<div class="holder">
							</div>
							<?php }?>
                        </div>
                        <div class="generalright faded">
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
                            </div>
                            <h1 class="homeh1">Jobs Categories</h1><br>
                            <h6>Click on a category</h6>
                            <div id="industry_list"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="footer">
                <?php
                include ("thefooter.php");
 ?>
            </div>
            <div id="my_map"></div>
    </body>
    <script type="text/javascript">
    $(document).ready(function() {
    	  /* initiate the plugin */
			$("div.holder").jPages({
			    containerID  : "itemContainer",
			    perPage      : 5,
				startPage    : 1,
				startRange   : 1,
				midRange     : 5,
				endRange     : 1,
				callback : function( pages, items ){
					$('html, body').animate({ scrollTop: 0 }, 'slow');
				}
			});
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
