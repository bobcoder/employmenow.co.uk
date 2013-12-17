<?php
  session_start();
  include("database.inc.php");
  if(isset($_GET['ds'])) {
    $result = mysql_query("DELETE FROM `shortlists` WHERE `employerid`='".$_SESSION['userid']."' AND `userid`='".$_GET['ds']."' LIMIT 1");
  }
  if(isset($_POST['submit'])) {
    $companyname = mysql_real_escape_string($_POST['companyname']);
    $contactname = mysql_real_escape_string($_POST['contactname']);
    $email = mysql_real_escape_string($_POST['email']);
    $telephone = mysql_real_escape_string($_POST['telephone']);
    if($_POST['password'] != "") {
      $password = mysql_real_escape_string($_POST['password']);    
      $PQ = ",`password`='$password'";
    }
    $result = mysql_query("UPDATE `employers` SET `companyname`='$companyname',`name`='$contactname',`email`='$email',`telephone`='$telephone'$PQ WHERE `id`='".$_SESSION['userid']."' LIMIT 1");
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
		<div id="content-e">
        
        <DIV CLASS="eleft">
        


<?php
 
  if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user")
  
  
  die


  ("You need to <a href=\"login.php\">login</a> to continue, we are redirecting you now <META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=elogin.php\">
 </body></html>");
  


  
  
  
  

  
  
  
  
  
  
  echo "<h2>Welcome back!</h2>\n";
  $result = mysql_query("SELECT `credits` FROM `credits` WHERE `employerid`='".$_SESSION['userid']."' LIMIT 1");
  list($c) = mysql_fetch_array($result);
  if (($c == 0) || ($c == ''))
  {
      $c = 'no';
  }
  echo "<p>You have $c credits, <a href=\"buycredits.php\">click here</a> to purchase more.</p>\n";
  $result = mysql_query("SELECT `userid` FROM `purchased_cvs` WHERE `employerid`='".$_SESSION['userid']."'");
  $owned = array();
  while($output = mysql_fetch_row($result)) $owned[] = $output[0];
  $result = mysql_query("SELECT `userid` FROM `shortlists` WHERE `employerid`='".$_SESSION['userid']."'");  
  $shortlisted = array();
  while($output = mysql_fetch_row($result)) $shortlisted[] = $output[0];
  $result = mysql_query("SELECT * FROM `employers` WHERE `id`='".$_SESSION['userid']."' LIMIT 1");
  $user = mysql_fetch_array($result,MYSQL_ASSOC);
?>
<form name="frmRegister" method="post" onsubmit="return checkForm();">
<table>
<tr><td>Company Name:</td><td id="companynameCell"><input type="text" class="login" name="companyname" id="companyname" value="<?php echo $user['companyname']; ?>"></td></tr>
<tr><td>Contact Name:</td><td id="contactnameCell"><input type="text" class="login" name="contactname" id="contactname" value="<?php echo $user['name']; ?>"></td></tr>
<tr><td>E-mail:</td><td id="emailCell"><input type="text" name="email" class="login" id="email" value="<?php echo $user['email']; ?>"></td></tr>
<tr><td>Telephone:</td><td id="telephoneCell"><input type="text" class="login" name="telephone" id="telephone" value="<?php echo $user['telephone']; ?>"></td></tr>
<tr><td>Password:</td><td id="passwordCell"><input type="password" class="login" name="password" id="password"></td></tr>
<tr><td colspan="2" align="right"><input type="submit" class="searchbutton" name="submit" value="Save"></td></tr>
</table>
</form>

</DIV>


<?php
 
      echo "<div class=\"cvs\">";

  echo "<h3>Purchased CVs</h3>\n";
  echo "<table>\n";  
  echo "<tr><th>Name</th><th>County</th><th>Job title</th><th>Salary</th><th>&nbsp;</th></tr>\n";
  foreach($owned as $o) {
    $result = mysql_query("SELECT * FROM `users` WHERE `id`='$o'");
    $output = mysql_fetch_array($result,MYSQL_ASSOC);
    echo "<tr>";        
    echo "<td><nobr>".$output['name']."</nobr></td><td>".$output['county']."</td><td><nobr>".$output['jobtitle']."</nobr></td><td>&pound;".number_format($output['salary'], 0, '.', ',')."</td><td><a href=\"download.php?id=".$output['id']."\">Download</a></td></tr>\n";
  }
  echo "</table>\n";


  
  
          echo "</div>";

  
      echo "<div class=\"shortlist\">";

  
  echo "<h3>Shortlisted CVs</h3>\n";
  echo "<table>\n";  
  echo "<tr><th>ID</th><th>County</th><th>Job title</th><th>Salary</th><th>&nbsp;</th></tr>\n";
  foreach($shortlisted as $o) {
    $result = mysql_query("SELECT * FROM `users` WHERE `id`='$o'");
    $output = mysql_fetch_array($result,MYSQL_ASSOC);
    echo "<tr>";        
    echo "<td><nobr>".$output['id']."</nobr></td><td>".$output['county']."</td><td><nobr>".$output['jobtitle']."</nobr></td><td>&pound;".number_format($output['salary'], 0, '.', ',')."</td><td><a href=\"?ds=".$output['id']."\">Remove</a></td><td><a href=\"view.php?id=".$output['id']."\">View CV</a></td><td><a href=\"buy.php?id=".$output['id']."\">Buy CV</a></td></tr>\n";
  }
  echo "</table>\n";


  
        echo "</div>";

  
  
    echo "<div class=\"alerts\">";
	

  echo "<h3>E-mail alerts</h3>\n";
  	    echo "Sign up below to recieve email alerts <br/><br/>";

  echo "<div class=\"buttonsleft\"><a class=\"button\" href=\"emailalerts.php\">Setup E-mail alerts</a></div>\n";
      echo "</div>";

?>





</div>



<div id="sidebar">
			<?php
			
			require('inc/sidebar_search.php');
			
			/* no longer in use
			<div class="sidebarbox">
				
                <div class="sideheader">
                Find your candidate
                </div>
                
                <div class="sidecontent">  <p>Use the fields below to find your ideal candidate, <strong>browse for free</strong></p>                       
                         
                        <form action="browse.php" method="post">  

                            <input name="keyword" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Keywords':this.value;" value="Keywords" /><br/>

                            <input name="location" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Location':this.value;" value="Location"/>


<select name="distance"><option value="distance from location">distance from location</option>
  <option>Within 1 Mile</option>  <option>Upto 5 Miles</option>
  <option>Upto 10 Miles</option>
    <option>10 Miles and over</option>






</select><br />

<select name="industry"><option value="industry">industry</option>
<?php
  $result = mysql_query("SELECT * FROM `industries` WHERE `deleted`=0 ORDER BY `name` ASC");
  while($output = mysql_fetch_row($result)) echo "<option value=\"$output[1]\">$output[1]</option>";
?></select><br />

<select name="salary"><option value="salary">salary</option>
<?php
  dumpSalaries("salary",$config['salaryMin'],$config['salaryMax'],$config['salaryStep']);
?>
<option value='commission' >Commission Only</option>
</select><br />
<select name="jobtype"><option value="job type">job type</option>
<?php
  foreach($config['jobtypes'] as $jt) echo "<option value=\"$jt\">$jt</option>";
?></select><br />

<select name="DATE"><option value="DATE">date added to site</option>
  <option>Last 24 hours</option>
  <option>Last 3 days</option>
  <option>Last 7 days</option>
    <option>Last 14 days</option>
    <option>Anytime</option>






</select><br />

<input name="btnHomeSearch" type="submit" class="sidebutton" value="Find your candidate" /></form>
              </div>
                  
                
			</div> */ ?>
            
            <div class="sidebarbox">
                <div class="sideheader">
               Featured CV's
                </div>                
                <div class="sidecontent"> 
                
               <div class="sidesection"> 
                <?php 
                  $result = mysql_query("SELECT `id`,`headline`,`bio` FROM `users` WHERE `featured`=1 ORDER BY RAND() LIMIT 3");
                  //$result = mysql_query("SELECT `name`,`headline` FROM `users` WHERE `featured`=1 AND RAND() <= .3 LIMIT 3");    
                  echo mysql_error();
                  while($output = mysql_fetch_array($result,MYSQL_ASSOC)) {
                    echo "<div class=\"sidesection\"> \n";
                    echo "<h4>".$output['headline']."</h4>\n";
                    echo "<p>".$output['bio']."</p>\n";
                    if(isset($_SESSION['userid']) && $_SESSION['mode'] == "employer") $page = "view.php?id=".$output['id'];
                    else {
                      $page = "elogin.php";
                      //$_SESSION['ct'] = $output['id'];
                    }                    
                    echo "<a class=\"button\" href=\"$page\">find out more</a>\n";
                    echo "</div>\n";
                  }                  
                ?>                           
               </div>                    
              </div>                 
            </div>          
      </div>
</div>
<div id="footer">
		    <?php include("thefooter.php"); ?>
</div>
</body>
</html> 
