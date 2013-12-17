	<div class="topmenu">
<?php
if (array_key_exists('email', $_SESSION) && ($_SESSION['email'] != ''))
{
  if (array_key_exists('mode',$_SESSION) && ($_SESSION['mode'] == "user"))
  {
  ?>
    <a class="super" href="account.php"><img src="<?php echo $config['siteurl']?>images/home.png" /> </a>
  <?php
  }
  else
  {
  ?>
    <a class="super" href="ehome.php"><img src="<?php echo $config['siteurl']?>images/home.png" /> </a>
  <?php
  }

}

else
{
  ?>
  <a class="super " href="<?php echo $config['siteurl']?>"><img src="<?php echo $config['siteurl']?>images/home.png" /> </a>
  <?php
}
?>
<a class="super " href="browse.php"><img src="<?php echo $config['siteurl']?>images/search.png" />  </a>
<a class="super " href="jobs.php"><img src="<?php echo $config['siteurl']?>images/search-jobs.png" />  </a>
<a class="super " href="register.php"><img src="<?php echo $config['siteurl']?>images/submit.png" /> </a>
<a class="super " href="pricing.php"><img src="<?php echo $config['siteurl']?>images/pricing.png" /> </a>
<a class="super " href="<?php echo $config['siteurl']?>blog/"><img src="<?php echo $config['siteurl']?>images/blog.png" />    </a>
<?php
if (array_key_exists('email', $_SESSION) && ($_SESSION['email'] != ''))
{
?>

    <a class="super" href="logout.php"><img src="<?php echo $config['siteurl']?>images/logout.png" />   </a>
</div>
<?php
}

else
{
  ?>
  </div>
	<div class="toprightmenu">
		<a class="super" href="ehome.php"><img src="<?php echo $config['siteurl']?>images/employer.png" />  </a>
		<a class="super" href="account.php"><img src="<?php echo $config['siteurl']?>images/candidate.png" />   </a>

	</div>
  <?php
}
?>