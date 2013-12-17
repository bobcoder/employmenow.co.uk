<?php
  session_start();
  include("database.inc.php");
  $error = "";
  if(isset($_POST['submit'])) {
    if($_POST['password'] == $config['adminpassword']) $_SESSION['l'] = "10101010101001101";
    else $error = "<span style=\"color: #FF0000\">Invalid password!</span><br />\n";
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/tablesorter/jquery.tablesorter.js"></script>
<script type="text/javascript" src="js/tablesorter/addons/pager/jquery.tablesorter.pager.js"></script>

<script language="JavaScript" type="text/javascript" src="miscfunc.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="admin_menu.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script language="JavaScript">
            $(document).ready(function()
            {
                $("#usersTable")
                        .tablesorter({sortList: [[1,0]]})
                        .tablesorterPager({container: $("#pager")});
            }
            );
             <?php if(isset($_GET['eid'])) { ?>
                function updateGenericCountdown(field,length)
  {
    // 140 is the max message length
    var remaining = length - jQuery('#'+field).val().length;
    jQuery('#countdown_'+field).text(remaining + ' characters remaining.');
    if (jQuery('#'+field).val().length > length)
        {
            jQuery('#countdown_'+field).css('color', 'red');
        }
        else
         {
            jQuery('#countdown_'+field).css('color', '#4f4f4f');
        }
  }

    jQuery(document).ready(function($) {
        updateGenericCountdown('headline',140);
        $('#headline').change(function () {updateGenericCountdown('headline',140); });
        $('#headline').keyup(function () {updateGenericCountdown('headline',140); });
        updateGenericCountdown('quirky_dinner',140);
        $('#quirky_dinner').change(function () {updateGenericCountdown('quirky_dinner',140); });
        $('#quirky_dinner').keyup(function () {updateGenericCountdown('quirky_dinner',140); });
        updateGenericCountdown('quirky_movie',140);
        $('#quirky_movie').change(function () {updateGenericCountdown('quirky_movie',140); });
        $('#quirky_movie').keyup(function () {updateGenericCountdown('quirky_movie',140); });
        updateGenericCountdown('quirky_quote',140);
        $('#quirky_quote').change(function () {updateGenericCountdown('quirky_quote',140); });
        $('#quirky_quote').keyup(function () {updateGenericCountdown('quirky_quote',140); });
    });


             <?php } ?>
            </script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
               selector: "textarea.tinymce",
               menubar : false
            });
        </script>
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<img src="images/logo.png" />
		</div>
<?php include("navlogin.inc.php"); ?>
		<div id="menu">
			<ul>
			<?php
			  if(!$_SESSION['l']) { ?>
				<li><a href="./" accesskey="1" title="">Home</a></li>
				<li><a href="#" accesskey="2" title="">Search</a></li>
				<li><a href="register.php" accesskey="3" title="">Submit your CV</a></li>
				<li><a href="about.php" accesskey="4" title="">About us</a></li>

                	<?php
                	  }
                	  else {
                	      //include_once("admin_menu.php");
                	  ?>
				<li><a href="admin.php" accesskey="1" title="">Home</a></li>
				<li><a href="admin.php?m=editcvs" accesskey="2" title="">Featured CVs</a></li>
				<li><a href="admin.php?m=options" accesskey="3" title="">Options</a></li>
				<li><a href="admin.php?m=content" accesskey="4" title="">Pages</a></li>
				<li><a href="admin.php?m=manage" accesskey="5" title="">Manage CVs</a></li>
                		<li><a href="http://employmenow.co.uk/web/blog/wp-login.php" accesskey="5" title="">Blog</a></li>


                	  <?php
                	  }
                	 ?>
			</ul>
		</div>
	</div>
</div>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
<?php
  if(!$_SESSION['l']) {
    echo $error;
    echo "<form name=\"frmAdmin\" method=\"post\">\n";
    echo "Please enter the admin password to continue.<br />\n";
    echo "<input type=\"password\" name=\"password\">\n";
    echo "<input type=\"submit\" name=\"submit\" value=\"Login\">";
    echo "</form>\n";
  }
  else {
    if(!isset($_GET['m'])) {
      echo "<h3>Welcome back!</h3>\n";
      echo "<p>Please choose from the menu to alter site settings or content.</p>\n";
    }
    if($_GET['m'] == "editcvs") {
      echo "<h3>Select featured CVs</h3>\n";
      if(isset($_POST['btnSubmit'])) {
        // Reset all to 0
        $result = mysql_query("UPDATE `users` SET `featured`=0");
        if(count($_POST['featured']) > 0) {
          foreach($_POST['featured'] as $value) {
            $result = mysql_query("UPDATE `users` SET `featured`=1 WHERE `id`='".mysql_real_escape_string($value)."'");
          }
        }
      }
      $result = mysql_query("SELECT * FROM `users` WHERE `active`=1");
      echo "<form name=\"frmFeatured\" method=\"post\">\n";
      echo "<table>\n";
      echo "<tr><th>&nbsp;</th><th>Name</th><th>County</th><th>Job title</th><th>Available From</th><th>Salary</th></tr>\n";
      while($output = mysql_fetch_array($result,MYSQL_ASSOC)) {
        echo "<tr><td><input type=\"checkbox\" name=\"featured[]\" value=\"".$output['id']."\"".($output['featured']==1?" checked":"")."></td>";
        echo "<td>".$output['name']."</td><td>".$output['county']."</td><td>".$output['jobtitle']."</td><td>".$output['availablefrom']."</td><th>&pound;".number_format((double)$output['salary'], 0, '.', ',')."</th></tr>\n";
      }
      echo "</table>\n";
      echo "<input type=\"submit\" name=\"btnSubmit\" value=\"Save\">\n";
      echo "</form>\n";
    }
    if($_GET['m'] == "content") {
      echo "<h3>Choose a page to edit</h3>\n";
      $result = mysql_query("SELECT `id`,`pagename` FROM `cms_pages` ORDER BY `pagename`");
      while($output = mysql_fetch_row($result)) {
        echo "<a href=\"admin.php?m=content&p=$output[0]\">$output[1]</a><br />\n";
      }
      if(isset($_GET['p']) && isset($_POST['btnSubmit'])) {
        $result = mysql_query("UPDATE `cms_pages` SET `content`='".mysql_real_escape_string($_POST['textContent'])."' WHERE `id`='".mysql_real_escape_string($_GET['p'])."' LIMIT 1");
        if(!mysql_error()) echo "<p>Changes saved!</p>\n";
      }
      elseif(isset($_GET['p']) && !isset($_POST['btnSubmit'])) {
        $result = mysql_query("SELECT `content` FROM `cms_pages` WHERE `id`='".mysql_real_escape_string($_GET['p'])."'");
        list($content) = mysql_fetch_array($result);
        echo "<form name=\"frmEditPage\" method=\"post\">\n";
        echo "<textarea name=\"textContent\" style=\"width: 450px; height: 200px\">$content</textarea><br />\n";
        echo "<input type=\"submit\" name=\"btnSubmit\" value=\"Save\">\n";
        echo "</form>\n";
      }
    }
    if($_GET['m'] == "options") {
      echo "<h3>Edit site options</h3>\n";
      if(!isset($_POST['btnSubmit'])) {
        $result = mysql_query("SELECT `parameter`,`value` FROM `site_options`");
        echo "<form name=\"frmOptions\" method=\"post\">\n";
        echo "<table>\n";
        while($output = mysql_fetch_row($result)) {
          echo "<tr><td>$output[0]</td><td><input type=\"text\" name=\"$output[0]\" value=\"$output[1]\"></td></tr>\n";
        }
        echo "</table>\n";
        echo "<input type=\"submit\" name=\"btnSubmit\" value=\"Save\">\n";
        echo "</form>\n";
      }
      else {
        foreach($_POST as $key => $value) {
          if($key != "btnSubmit") $result = mysql_query("UPDATE `site_options` SET `value`='$value' WHERE `parameter`='$key' LIMIT 1");
        }
        echo "<p>Changes saved!</p>\n";
      }
    }
    if($_GET['m'] == "manage") {
      echo "<h3>Manage CVs</h3>\n";
      if(isset($_POST['btnSubmit'])) {
        if(count($_POST['active']) > 0) {
          foreach($_POST['active'] as $value) {
            $result = mysql_query("UPDATE `users` SET `active`=0 WHERE `id`='".mysql_real_escape_string($value)."'");
          }
        }
      }
      $result = mysql_query("SELECT * FROM `users` WHERE `active`=1");
      echo "<form name=\"frmFeatured\" method=\"post\">\n";
      echo "<table id=\"usersTable\"><thead>\n";
      echo "<tr><th>&nbsp;</th><th>Name</th><th>County</th><th>Job title</th><th>Find us how</th><th>Salary</th></tr></thead>\n";
      echo "<tbody>\n";
      while($output = mysql_fetch_array($result,MYSQL_ASSOC)) {
        echo "<tr><td><input type=\"checkbox\" name=\"active[]\" value=\"".$output['id']."\"></td>";
        echo "<td><a href=\"admin.php?m=manage&eid=".$output['id']."#theform\">".$output['name']."</a></td><td>".$output['county']."</td><td>".$output['jobtitle']."</td><td>".$output['how']."</td><th>&pound;".number_format((double)$output['salary'], 0, '.', ',')."</th></tr>\n";
      }
      echo "</tbody></table>\n";
      echo "<br/><br/><br/><br/><input type=\"submit\" name=\"btnSubmit\" class=\"buttontime\"value=\"Delete Selected\">\n";
      echo "</form>\n";
      ?>
      <div id="pager" class="pager" style="clear:both; top: 235px;">
	<form>
		<img src="js/tablesorter/addons/pager/first.png" class="first"/>
		<img src="js/tablesorter/addons/pager/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="js/tablesorter/addons/pager/next.png" class="next"/>
		<img src="js/tablesorter/addons/pager/last.png" class="last"/>
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option  value="40">40</option>
		</select>
	</form>
       </div>

      <?php



      if(isset($_GET['eid'])) {
        $cvid = mysql_real_escape_string($_GET['eid']);
  if(isset($_POST['subSkills'])) {


        foreach ($_POST as $fieldname => $fielddata)
        {
	  if(!is_array($fielddata))
	  {
            $_POST[$fieldname] = stripslashes($fielddata);
	  }

        }


    $jobtitle = mysql_real_escape_string($_POST['jobtitle']);

    $indArray = $_POST['ind'];
    $industries = implode("|",$indArray);
    $tArray = $_POST['jobtype'];
    $jobtypes = implode("|",$tArray);

	 $tArray = $_POST['status'];
    $status = implode("|",$tArray);
	  $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    if($password != "") $PQ = ",`password`='$password'";
    else $PQ = "";
    $dob = mysql_real_escape_string($_POST['year']);
    $tmpm = mysql_real_escape_string($_POST['month']);
    if($tmpm < 10) $tmpm = "0".$tmpm;
    $tmpd = mysql_real_escape_string($_POST['day']);
    if($tmpd < 10) $tmpd = "0".$tmpd;
    $dob .= "-$tmpm-$tmpd";
    $town = mysql_real_escape_string($_POST['town']);
    $county = mysql_real_escape_string($_POST['county']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $mobile = mysql_real_escape_string($_POST['mobile']);

    $headline = mysql_real_escape_string($_POST['headline']);
    $bio = mysql_real_escape_string($_POST['bio']);
    $salary = mysql_real_escape_string($_POST['salary']);
    $tmpm = mysql_real_escape_string($_POST['amonth']);
    if($tmpm < 10) $tmpm = "0".$tmpm;
    $tmpy = mysql_real_escape_string($_POST['ayear']);
    $availablefrom = "$tmpy-$tmpm-01";
    $relocate = mysql_real_escape_string($_POST['relocate']);
	    $driving = mysql_real_escape_string($_POST['driving']);

    $avatar = mysql_real_escape_string($_POST['avatar']);
    //$workexp = mysql_real_escape_string($_POST['workexp']);
    $qualifications = mysql_real_escape_string($_POST['qualifications']);
    //$education = mysql_real_escape_string($_POST['education']);
    $workexperience_text = mysql_real_escape_string($_POST['workexperience_text']);
    $education_text = mysql_real_escape_string($_POST['education_text']);

    $quirky_dinner = mysql_real_escape_string($_POST['quirky_dinner']);
    $quirky_movie = mysql_real_escape_string($_POST['quirky_movie']);
    $quirky_quote = mysql_real_escape_string($_POST['quirky_quote']);

    $achievements = mysql_real_escape_string($_POST['achievements']);
    $result = mysql_query("UPDATE `users` SET `jobtitle`='$jobtitle',`industries`='$industries',`status`='$status',`jobtypes`='$jobtypes',`headline`='$headline',`bio`='$bio',`salary`='$salary',`availablefrom`='$availablefrom',`relocate`='$relocate',`qualifications`='$qualifications',`driving`='$driving',`achievements`='$achievements', `workexperience_text`='$workexperience_text', `education_text`='$education_text',`quirky_dinner`='$quirky_dinner', `quirky_movie`='$quirky_movie', `quirky_quote`='$quirky_quote' WHERE `id`='$cvid' LIMIT 1");
    if($result) $msg = "<p>Details saved</p>";
    else $msg = "<p>There was a problem saving the user's details.</p>";
    }
        $result = mysql_query("SELECT * FROM `users` WHERE `id`='$cvid'");
        $user = mysql_fetch_array($result,MYSQL_ASSOC);
         $user_fixed = array();
  foreach ($user as $fieldname => $fielddata)
  {
      $user_fixed[$fieldname] = stripslashes($fielddata);
  }
  $user = $user_fixed;


?>
<form name="frmSkills" method="post">
<table width="940">
<tr>
  <td colspan="5"></td>
</tr>
<tr>
  <td colspan="5"><h2><a name="theform">Your current position and requirements</a></h2></td>
</tr>
<tr>
  <td colspan="5"></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td><strong>Current job title:</strong></td>
  <td><input type="text" name="jobtitle" value="<?php echo $user['jobtitle']; ?>" /></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><strong>Seeking employment in:</strong></td></tr>
<tr>
  <td valign="top"><strong>Status</strong></td>
  <td valign="top">
  <?php
  $jt = explode("|",$user['status']);
  for($x=0;$x<count($config['status']);$x++) {
    echo "<input type=\"checkbox\" name=\"status[]\" value=\"".$config['status'][$x]."\"".(in_array($config['status'][$x],$jt)==true?" checked":"").">".$config['status'][$x]."<br>\n";
  }
?>
  </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td rowspan="8"><table>
  <?php
  $sect = explode("|",$user['industries']);
  $result = mysql_query("SELECT `name` FROM `industries` WHERE `deleted`=0 ORDER BY `name` ASC");
  $t = mysql_num_rows($result);
  $ind = array();
  while($output = mysql_fetch_row($result)) $ind[] = $output[0];
  for($x=0;$x<$t;$x+=3) {
    echo "<tr>";
    for($y=0;$y<3;$y++) {
      if(isset($ind[$x+$y])) echo "<td><input type=\"checkbox\" name=\"ind[]\" value=\"".$ind[$x+$y]."\"".(in_array($ind[$x+$y],$sect)==true?" checked":"")."> ".$ind[$x+$y]."</td>";
    }
    echo "</tr>\n";
  }
?>
  </table></td>
</tr>
<tr>
  <td valign="top"><strong>Job type:</strong></td>
  <td valign="top"><?php
  $jt = explode("|",$user['jobtypes']);
  for($x=0;$x<count($config['jobtypes']);$x++) {
    echo "<input type=\"checkbox\" name=\"jobtype[]\" value=\"".$config['jobtypes'][$x]."\"".(in_array($config['jobtypes'][$x],$jt)==true?" checked":"").">".$config['jobtypes'][$x]."<br>\n";
  }
?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td><strong>Are you willing to relocate?</strong></td>
  <td><input type="radio" name="relocate" value="1"<?php if($user['relocate'] == 1) echo " checked"; ?> />
Yes
  <input type="radio" name="relocate" value="0"<?php if($user['relocate'] == 0) echo " checked"; ?> />
No</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td><strong>Do you have a full UK driving licence?</strong></td>
  <td><input type="radio" name="driving" value="1"<?php if($user['driving'] == 1) echo " checked"; ?> />
Yes
  <input type="radio" name="driving" value="0"<?php if($user['driving'] == 0) echo " checked"; ?> />
No</td>
  </tr>
<tr>
  <td><strong>Choose your expected salary:</strong></td>
  <td><select name="salary">
    <?php dumpSalaries($user['salary'],$config['salaryMin'],$config['salaryMax'],$config['salaryStep']); ?>
  </select></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
  <?php /*
<tr>
  <td><strong>Date available from:</strong></td>
  <td><select name="amonth">
    <?php dumpMonths($avparts[1]); ?>
  </select>
    <select name="ayear">
      <?php dumpYears(70,$avparts[0]); ?>
    </select>
    </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr> */ ?>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  </tr>
<?php
  $avparts = explode("-",$user['availablefrom']);
?>
<tr>
  <td colspan="5"></td>
</tr>


<tr><td colspan="6" align="right">&nbsp;</td></tr>
</table>

<table width="940">




<tr>
  <td colspan="5"><h2>Build your CV</h2></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="4">&nbsp;</td>
</tr>
<tr>
  <td><strong>Profile headline:</strong></td>
  <td colspan="4"><input title="This is your first contact with an employer, make it stand out and catchy" type="text" name="headline" id="headline" style="width: 700px;" value="<?php echo $user['headline']; ?>" /><br /><span id="countdown_headline"></span></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>
<tr>
  <td valign="top"><p><strong>Personal statement:</strong></p>
    <p class="tip">&nbsp;</p></td>
  <td colspan="4"><textarea title="A brief description about yourself e.g. Graduate, Mature. What you have to offer and your career aims" name="bio" style="width: 700px; height: 200px"><?php echo $user['bio']; ?></textarea></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>
<tr>
  <td><strong>If you was to have dinner with someone famous (past or present) who would it be and why?:</strong></td>
  <td colspan="4"><input type="text" name="quirky_dinner" id="quirky_dinner" style="width: 700px;" value="<?php echo $user['quirky_dinner']; ?>" /><br /><span id="countdown_quirky_dinner"></span></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>
<tr>
  <td><strong>If an actor/actress was to play you in a movie of your life who would it be and why?:</strong></td>
  <td colspan="4"><input type="text" name="quirky_movie" id="quirky_movie" style="width: 700px;" value="<?php echo $user['quirky_movie']; ?>" /><br /><span id="countdown_quirky_movie"></span></td>
</tr>
   <tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>
<tr>
  <td><strong>What quote do you live by?:</strong></td>
  <td colspan="4"><input type="text" name="quirky_quote" id="quirky_quote" style="width: 700px;" value="<?php echo $user['quirky_quote']; ?>" /><br /><span id="countdown_quirky_quote"></span></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>
<tr>
  <td valign="top"><p><strong>Interests and Hobbies:</strong></p>
    <p class="tip">&nbsp;</p></td>
  <td colspan="4"><textarea title="What you enjoy doing outside of work. This gives employers a better understanding about the candidate they are considering for employment"  name="achievements" style="width: 700px; height: 200px"><?php echo $user['achievements']; ?></textarea></td>
  </tr>

<tr>
  <td valign="top"><strong>Work Experience / History</strong></td>
  <td colspan="4">
      <textarea class="tinymce" name="workexperience_text">
        <?php echo stripslashes($user['workexperience_text']); ?>
      </textarea>
      <br /><strong>Make sure to click Save Profile below to save your CV when you wish to save your current progress.</strong>
    </td>
</tr>

<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td valign="top"><strong>Education:</strong></td>
  <td colspan="4">
      <textarea class="tinymce" name="education_text">
        <?php echo stripslashes($user['education_text']); ?>
      </textarea>
      <br /><strong>Make sure to click Save Profile below to save your CV when you wish to save your current progress.</strong>
    </td>
  </tr>
<tr>
  <td colspan="5">You will be unable to save your profile if you have not provided contact details, please check in <a href="#1">stage one</a></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <!--td><input type="submit" name="subSkills" value="Save Profile" /></td-->
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td></tr>

<tr><td colspan="6" align="right">&nbsp;</td></tr>
</table>
<input type="submit" name="subSkills" value="Save Profile" />
</form>

<?php
      }


    }
  }
  ?>

</div>

</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html>
