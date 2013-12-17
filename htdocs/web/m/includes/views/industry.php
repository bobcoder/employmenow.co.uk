<?php render('_header',array('title'=>$title))?>

<div class="rightColumn" id="jobslist">
	<ul data-role="listview" data-theme="c" data-dividertheme="c" data-icon="star" data-split-icon="plus" data-split-theme="c" data-inset="true">
        <?php render($job);
        ?>
    </ul>
</div>


<div class="leftColumn">
    <ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
        <li data-role="list-divider">Jobs</li><?php
        	render($industry,array('active'=>$_GET['industry']));
		?>
    </ul>
</div>
<div data-role="popup" data-ajax="false" id="addtofav" data-theme="d" data-overlay-theme="b" class="ui-content" style="max-width:340px; padding-bottom:2em;">
	    <h3>Add Job to favourites?</h3>
        <p>Do you want to add this job to your favourites?</p>
        <input id="yesfav" data-inline="true" data-mini="true" data-icon="check" type="button" data-ajax="false" value="Yes" />
        <input id="nofav" data-inline="true" data-mini="true" data-icon="delete" type="button" data-ajax="false" value="No" />
        <input type="hidden" value=<?php echo $_SESSION['userid']; ?> id="userid" data-ajax="false"/>
</div>

<?php render('_footer');

?>