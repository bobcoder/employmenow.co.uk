<?php
  session_start();
  include("database.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Free CV browse | Employmenow
</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ur-bc465b40-cad7-354d-c5bc-5e137c9c01b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="browse view">
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
		<div id="content">
<?php
  if(!$_GET['id']) die("No CV selected!");
  $cvid = mysql_real_escape_string($_GET['id']);

  $result = mysql_query("UPDATE `users` SET `views`=`views`+1 WHERE `id`=$cvid LIMIT 1");


  $result = mysql_query("SELECT * FROM `users` WHERE `id`='$cvid'");
  $user = mysql_fetch_array($result,MYSQL_ASSOC);

   $user_fixed = array();
  foreach ($user as $fieldname => $fielddata)
  {
      $user_fixed[$fieldname] = stripslashes($fielddata);
  }
  $user = $user_fixed;
	//String of words not allowed in the display of the CV's
$exclude = array($user['email'], $user['mobile'], $user['telephone'], $user['name'], $user['town'], $user['county']);
  echo "<div class=\"longbox\">\n";
  echo "<img src=\"".$config['siteurl'].$config['imgdir'].$user['avatar']."\"  class=\"categorylisting\" />";
  echo "<h3>". sanitize($user['headline'], $exclude) . "</h3>";
  echo "<p class=\"ref\">Current job title:<strong> ".sanitize($user['jobtitle'], $exclude)."</p></strong>";
  echo "<p class=\"ref\">Location: <strong>".$user['town']." ".$user['county']."</strong></p>\n";
  echo "<p class=\"ref\">Current status:<strong> ".$user['status']."</p></strong>";
  echo "<p class=\"ref\">Looking for: <strong>".$user['jobtypes']."</p></strong>";
  echo "<p class=\"ref\">Seeking employment in:<strong> ".$user['industries']."</p></strong>";
  if ($user['commission_only']!= 1)
  {
    $salbits = explode("-",$user['salary']);
    if($salbits[0] < 1)
    {
        $minsal = $salbits[1];
    }
    else
    {
        $minsal = $salbits[0] - 1;
    }
    echo "<p class=\"ref\">Minimum salary: <strong>&pound;".$minsal."</strong></p>\n";
  }
  else
  {
      echo "<p class=\"ref\">Minimum salary: <strong>Commission Only</strong></p>\n";
  }

  echo "<p class=\"ref\">Willing to relocate:<strong> ".($user['relocate']==1?"yes":"no")."</strong></p>\n";
  echo "<p class=\"ref\">Full UK driving licence<strong> ".($user['driving']==1?"yes":"no")."</strong></p>\n";
  echo "</div>\n";
  echo "<div class=\"longbox\">\n";
  echo "<h3>".sanitize($user['headline'], $exclude)."'s CV</h3>";
  echo "<p>".sanitize($user['bio'], $exclude)."</p>";
  echo "</div>\n";

  echo "<div class=\"longbox\">\n";
  echo "<h3>Work Experience/History</h3>";
  echo sanitize(stripslashes($user['workexperience_text']), $exclude);
  echo "</div>\n";
  echo "<div class=\"longbox\">\n";
  echo "<h3>Education and qualifications</h3>";
  echo sanitize(stripslashes($user['education_text']), $exclude);

  echo "</div>\n";


    echo "<div class=\"longbox\">\n";
  echo "<h3>Interests and Hobbies</h3>";
  echo "<p>".sanitize($user['achievements'], $exclude)."</p>";
  echo "</div>\n";

  echo "<div class=\"longbox\">\n";
  echo "<h3>Like the sound of this candidate? </h3>";
  echo "<h4> Why not get in touch?</h4>";
  echo "<p>".$cvs[$x]['headline']."</p>";
  if(isset($_SESSION['userid']) && $_SESSION['mode'] == "employer") $page = "view.php?id=".$cvs[$x]['id'];
  else {
    $page = "elogin.php";
    $_SESSION['ct'] = $cvs[$x]['id'];
  }
	if($_GET['jview'] == 'true'){
		$remove_shortlist_button = "<a class=\"button\" href=\"#\" id='removecv'>Remove CV</a>";
	}
	$shortlist_button = "<a class=\"button\" href=\"shortlist.php?id=$cvid\">Add to shortlist</a>";

	if(!$full){ echo "<div class=\"buttonsleft\"><a class=\"button\" href=\"buy.php?id=$cvid\">buy this CV</a>
	  $shortlist_button $remove_shortlist_button</div>";
	}else{
		echo "<div class=\"buttonsleft\"><a class=\"button\" href=\"download.php?id=$cvid\">download</a></div>\n";
	}
	echo "</div>\n";
?>
				<br/><br/>
				<?php
					if($_GET['jview'] == 'true'){
						echo '<a href="job_applications.php" class="button2">< Back to candidates</a>';
					}else{
						echo '<a href="browse.php?of=1" class="button2">< Back to your search</a>';
					}
				?>
				</div>
<div id="sidebar">
			<div class="sidebarbox">
             <div class="sideheader">
               Share this candidate
                </div>
				<div class="sidecontent"> <p>Share this CV with your social network</p>
					<span class='st_facebook_large' displayText='Facebook'></span>
					<span class='st_twitter_large' displayText='Tweet'></span>
					<span class='st_linkedin_large' displayText='LinkedIn'></span>
					<span class='st_pinterest_large' displayText='Pinterest'></span>
					<span class='st_email_large' displayText='Email'></span>

				</div>
			</div>
			<?php
			require('inc/sidebar_search.php');
			?>
             <a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
      </div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
<script>
	$(function(){
		var data = $.param({id: "<?php echo $_GET['cvid'];?>"});
		$('#removecv').click(function(event){
			event.preventDefault();
			$.ajax({
			    dataType: 'json',
			    type: 'post',
			    url: 'inc/hide_jobs_employer.php',
			    cache: false,
			    data: data,
			    success: function (data, status, xhr) {
			        window.location.href = 'job_applications.php';
			    },
			    error: function(jqXHR, textStatus, errorThrown)
			    {
					console.log(textStatus);
			    }
			});//End ajax call
		});//END click event
	});
</script>
<?php
function sanitize($inpstr, $wordlist){
		$replacement = "[removed]";
		$pattern = "/[^@\s]*@[^@\s]*\.[^@\s]*/";

		foreach ($wordlist as &$word) {
			$word = '/\b' . preg_quote($word, '/') . '\b/i';

		}

		$inpstr = preg_replace('/\+?[0-9][0-9()-\s+]{4,20}[0-9]/', $replacement, $inpstr);

		$inpstr = preg_replace($pattern, $replacement, $inpstr);

		$string = preg_replace($wordlist, '', $inpstr);
	return $string;
}

?>

</body>
</html>
