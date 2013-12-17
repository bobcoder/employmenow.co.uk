<?php ini_set('display_errors',0); ?>

<?php
  session_start();
  include("database.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
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
		<div id="content">
<?php
	if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user") die
		("You need to <a href=\"elogin.php\">login</a> to continue, we are redirecting you now <META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=elogin.php\">
		</body></html>");

  $cvs = array();
  $q = "";

  if(isset($_GET['btnHomeSearch'])) {
    foreach($_GET as $key => $value) $_SESSION['posttmp'][$key] = $value;
  }
  if(isset($_SESSION['posttmp'])) {
    if(($_SESSION['posttmp']['keyword']!= '') || ($_SESSION['posttmp']['keyword']!= 'Keywords'))
    {
        $arrKeywords = explode(' ',$_SESSION['posttmp']['keyword']);
        foreach ($arrKeywords as $strKeyword)
        {
            if ($strKeyword != 'Keywords')
            {
                $q .= " AND (";
                $q .= "(`jobtitle` LIKE '%$strKeyword%')";
                $q .= " OR (`headline` LIKE '%$strKeyword%')";
                $q .= " OR (`bio` LIKE '%$strKeyword%')";
                $q .= " OR (`workexp` LIKE '%$strKeyword%')";
                $q .= " OR (`achievements` LIKE '%$strKeyword%')";
                $q .= " OR (`qualifications` LIKE '%$strKeyword%')";
                $q .= ")";
            }//Keywords
        }//END foreach
    }//Session check
    if($_SESSION['posttmp']['location'] != "Location" && $_SESSION['posttmp']['location']
    	!= "" && $_SESSION['posttmp']['distance'] == "distance from location") {
      $tmpq = explode(" ",$_SESSION['posttmp']['location']);
      $q .= " AND (";
      foreach($tmpq as $qs) $q .= "`town` LIKE '%$qs%' OR `county` LIKE '%$qs%' OR ";
      $q = substr($q,0,strlen($q)-4);
      $q .= ")";
    }
    if($_SESSION['posttmp']['age'] != "age" && $_SESSION['posttmp']['age'] != "") {
      $q .= " AND LEFT(CURDATE(),4)-LEFT(`dob`,4) = '".mysql_real_escape_string($_SESSION['posttmp']['age'])."'";
    }
    if($_SESSION['posttmp']['industry'] != "industry" && $_SESSION['posttmp']['industry'] != "") {

      $q .= " AND (`industries` LIKE '%".$_SESSION['posttmp']['industry']."%')";

    }
    if(($_SESSION['posttmp']['salary'] != "salary") && ($_SESSION['posttmp']['salary'] != "") && ($_SESSION['posttmp']['salary'] != "commission")) {
      $q .= " AND (";
      $q .= "`salary`='".mysql_real_escape_string($_SESSION['posttmp']['salary'])."')";
    }
    if ($_SESSION['posttmp']['salary'] == "commission")
    {
        $q .= " AND (";
      $q .= "`commission_only`=1)";
    }
    if($_SESSION['posttmp']['jobtype'] != "job type" && $_SESSION['posttmp']['jobtype'] != "") {
      $q .= " AND (";
      $q .= "`jobtypes` LIKE '%".mysql_real_escape_string($_SESSION['posttmp']['jobtype'])."%')";
    }
    if($_SESSION['posttmp']['date'] != "date" && $_SESSION['posttmp']['date'] != "any") {
      $q .= " AND (`last_login` > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL ".$_SESSION['posttmp']['date']." DAY))";
    }
    if($_SESSION['posttmp']['distance'] != "distance from location" && $_SESSION['posttmp']['distance'] != "over") {
      $coords = getLatLong($_SESSION['posttmp']['location']);
      $orig_lat = $coords['lat'];
      $orig_lon = $coords['lon'];
      $q .= " AND ( 3956 *2 * ASIN( SQRT( POWER( SIN( ($orig_lat - ABS( users.lat ) ) * PI( ) /180 /2 ) , 2 ) + COS( $orig_lat * PI( ) /180 ) * COS( ABS( users.lat ) * PI( ) /180 ) * POWER( SIN( ($orig_lon - users.lon) * PI( ) /180 /2 ) , 2 ) )) < ".$_SESSION['posttmp']['distance'].")";
    }
  }
  $result = mysql_query("SELECT `id`,`name`,`county`, `email`, `jobtitle`,`industries`,`avatar`,`headline`,`bio`,`regdate`,`last_login` FROM `users` WHERE `active`=1$q ORDER BY last_login DESC,`id` DESC" );

  echo "<!-- SELECT `id`,`name`,`county`,`jobtitle`,`industries`,`avatar`,`headline`,`bio`,`regdate`,`last_login` FROM `users` WHERE `active`=1$q ORDER BY last_login DESC,`id` DESC -->";


  if(isset($_GET['of'])) {
    $s = ($_GET['of'] - 1) * 20;
    $e = $s + 20;
  }
  else {
    $s = 0;
    $e = 20;
  }

  while($output = mysql_fetch_array($result,MYSQL_ASSOC)) {
    if($output['bio'] != "" && $output['headline'] != "") $cvs[] = $output;
  }
  $tot = count($cvs);
  for($x=$s;$x<$e;$x++) {
    if(isset($cvs[$x])) {
    $exclude = array($cvs[$x]['email'], $cvs[$x]['mobile'], $cvs[$x]['telephone'], $cvs[$x]['name']);
      echo "<div class=\"longbox\">\n";
      echo "<img src=\"".$config['siteurl'].$config['imgdir'].$cvs[$x]['avatar']."\"  class=\"categorylisting\" width=\"190px\"/>";
      echo "<h3>".sanitize($cvs[$x]['headline'], $exclude)."</h3>";

	  echo "<div class=\"browseleft\">\n";
      echo "<p class=\"ref\">Location: <strong>".$cvs[$x]['county']."</strong>" ;
	   if ($cvs[$x]['jobtitle']!= '')
      {
        echo "<p class=\"ref\">Job Title: <strong>".sanitize($cvs[$x]['jobtitle'], $exclude)."</strong> </p>";
      }
	   /*if(isset($_SESSION['userid']) && $_SESSION['mode'] == "employer") */ $page = "view.php?id=".$cvs[$x]['id'];
      /*else {
        $page = "elogin.php";
        $_SESSION['ct'] = $cvs[$x]['id'];
      }*/

           if ($cvs[$x]['last_login'] != "2013-08-01 00:00:00")
           {
	        $d = date("U") - date("U",strtotime($cvs[$x]['last_login']));
      $days = round($d / 86400);
	      if ($days >1)
	      {
		echo "<div class=\"regi\">Last active $days days ago</div>\n";
	      }
	      else
	      {
		echo "<div class=\"regi\">Last active in the last 24 hours</div>\n";
	      }
           }
           else
           {
               $d = date("U") - date("U",strtotime($cvs[$x]['regdate']));
                $days = round($d / 86400);
                echo "<div class=\"regi\">Last active $days days ago</div>\n";
           }
		echo "</div>\n";
		echo "<div class=\"browseright\">\n";
		echo "<p class=\"ref\">Industry: <strong>".$cvs[$x]['industries']."</strong> </p>";
		echo "<div class=\"buttonsleft\"><br/><a id='sendmore' class=\"button\" href=\"$page\">find out more</a></div>";
      ?>
      <script>
          $("#sendmore").click(function(){
              //console.log("Help");
              //window.location.href='<?php echo $page;?>';
          })
      </script>
      <?php
      echo "</div>\n";
       echo "</div> <!-- long box -->\n";
    }

  }
  $tp = ceil($tot / 20);
  $p = ceil($e / 20);

  for($x=1;$x<=$tp;$x++) {
    if($x != $p) echo "<a  class=\"boxy\" href=\"browse.php?of=$x\">$x</a> ";
    else echo "$xp";

  }

   if( mysql_num_rows($result) == 0 ) {

  echo "Sorry, no candidates were found matching your search criteria, please try another search. ";
}
?>
</div>
	<div id="sidebar">
		<?php require('inc/sidebar_search.php');?>
		<a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
		<a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
		<a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
		<a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
		<a href="http://employmenow.co.uk/web/contact.php"><img src="http://employmenow.co.uk/web/advertisehere.jpg" /></a>
	</div>
</div>
	<div id="featured" class="container"></div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
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