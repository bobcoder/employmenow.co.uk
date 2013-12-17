<?php render('_header',array('title'=>$title));
$job = $details[0];
/*
echo '<pre>';
	print_r($details[0]);
echo '</pre>';*/

?>
   <h3 id="search-title"><?php echo "Job title:  " . $job->title;?></h3>
   <div id="search-wrap">
       <div class="search-salary"><strong>Salary:</strong> &pound;<?php echo $job->salary;?></div>
       <div class="search-location"><strong>Location:</strong> <?php echo $job->region;?></div>
   </div>
   <div id="search-description"><?php echo $job->description;?></div>
   <div id="search-added"><strong>Job Added:</strong> <?php echo date("d-m-Y", strtotime($job->date_added));?></div>
   <div id="search-expires"><strong>Job Expiry Date:</strong> <?php echo date("d-m-Y", strtotime($job->date_expires));?></div>
   <div id="search-ref"><strong>Job Reference Number:</strong> <?php echo $job->ref;?></div>
   <div id="search-ref"><strong>Salary Notes:</strong> <?php echo $job->salary_notes;?></div>
   <div id="search-ref"><strong>Type of Employment:</strong> <?php echo $job->job_type;?></div>
   <div id="jobs_id" style="display:none;"><?php echo $job->jobs_id?></div>

<div><a href="#" data-role="button" data-mini="true" data-inline="true" data-theme="b" id="applynow" name="applynow">Apply Now</a></div>
<?php render('_footer')?>