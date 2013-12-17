<div class="topmenu">
        <a class="super faded" href="<?php echo $config['siteurl']?>"><img src="<?php echo $config['siteurl']?>images/home.png" /> </a>
        <a class="super faded" href="ehome.php"><img src="<?php echo $config['siteurl']?>images/search.png" />  </a>
        <a class="super faded" href="jobs.php"><img src="<?php echo $config['siteurl']?>images/search-jobs.png" />  </a>
        <a class="super faded" href="register.php"><img src="<?php echo $config['siteurl']?>images/submit.png" /> </a>
        <a class="super faded" href="pricing.php"><img src="<?php echo $config['siteurl']?>images/pricing.png" /> </a>
        <a class="super faded" href="<?php echo $config['siteurl']?>blog/"><img src="<?php echo $config['siteurl']?>images/blog.png" />    </a>
</div>
<div class="toprightmenu">
        <a class="super" href="ehome.php"><img src="<?php echo $config['siteurl']?>images/employer.png" />  </a>
        <a class="super" href="account.php"><img src="<?php echo $config['siteurl']?>images/candidate.png" />   </a>
</div>
<?php
    if (array_key_exists('email', $_SESSION) && ($_SESSION['email'] != ''))
{
?>
<!--
<div class="logout">
    <a class="super" href="logout.php"><img src="http://employmenow.co.uk/web/images/logout.png" />   </a>
</div>
-->
<?php } ?>

