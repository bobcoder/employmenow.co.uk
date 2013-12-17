<li <?php echo ($active == $jobs->jobs_id ? 'data-theme="c"' : '') ?> data-name="<?php echo $jobs->jobs_id;?>">
	<a rel="external" href="?details=<?php echo $jobs->jobs_id;?>" data-transition="fade">
	<?php echo $jobs->title;?>
	<div class="job_summary">Location: <?php echo $jobs->region;?></div>
	<div class="job_summary">Salary: <?php echo $jobs->salary;?></div>
</a>
<a class="favs" data-name="<?php echo $jobs->jobs_id;?>" href="#" data-rel="popup" data-position-to="window" data-transition="pop" data-theme="c" data-icon="star" >Add to favourites</a>
</li>

