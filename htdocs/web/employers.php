<?php
session_start();
include ("database.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find a candidate with employmenow</title>
<meta name="keywords" content="" />
<meta name="description" content="EmployMeNow is a different way of doing things. We cut out the middle-man, and make it easier for everyone." />
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body class="employerpage">
<div id="header-wrapper">
<div id="header" class="container">
<div id="logo"><img src="images/logo.png" /></div>
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
<div id="content-home">
<div id="searchhome" class="faded">
<div class="homeh1container">
<h1 class="homeh1">Employers, find your candidate!</h1>

<h2 class="homeh2">Instant access, browse before you pay!</h2>

</div>
<form action="browse.php" method="post">
    <input name="keyword" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Keywords':this.value;" value="Keywords" /><br/>

<input name="location" type="text" value="Location" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Location':this.value;" value="Location"/><br/>
<select name="distance"><option value="distance from location">Distance from location</option>
          <option value="1">Within 1 Mile</option>
           <option value="5">Within 5 Miles</option>
          <option value="10">Within 10 Miles</option>
            <option value="20">Within 20 Miles</option>
                <option value="30">Within 30 Miles</option>
            <option value="40">Within 40 Miles</option>
            <option value="60">Within 60 Miles</option>
                <option value="100">Within 100 Miles</option>
            <option value="over">100 Miles and over</option>
</select><br />
<?php /*<input name="industry" type="text" value="industry" /><br/> */ ?>
<select name="industry"><option value="industry">Industry</option>
<?php
$result = mysql_query("SELECT * FROM `industries` WHERE `deleted`=0 ORDER BY `name` ASC");
while ($output = mysql_fetch_row($result))
    echo "<option value=\"$output[1]\">$output[1]</option>";
?></select><br />
<?php /* <input name="salary" type="text" value="salary" /><br/> */ ?>
<select name="salary"><option value="salary">Salary</option>
<?php
dumpSalaries("salary", $config['salaryMin'], $config['salaryMax'], $config['salaryStep']);
?>
<option value='commission' >Commission Only</option>
</select><br />

<select name="jobtype"><option value="job type">Job type</option>
<?php
foreach ($config['jobtypes'] as $jt)
    echo "<option value=\"$jt\">$jt</option>";
?></select><br />
<select name="date"><option value="date">Date last active</option>
  <option value="1">Last 24 hours</option>
  <option value="3">Last 3 days</option>
  <option value="7">Last 7 days</option>
                                <option value="14">Last 14 days</option>
                                <option value="any">Anytime</option>
                                </select>
                                <br />
                                <input name="btnHomeSearch" type="submit" class="searchbutton" value="Find your candidate" />
                                </form>
                                </div>
                                <div id="employright" class="faded">
                                    <h1 class="homeh1">What if you could fill your vacancy for just £14.95?</h1>
                                    <br/>
                                    <p>
                                        What if you could select a candidate based on their CV and profile, without being told who to interview by someone outside the business? What if you were in control?
                                    </p>
                                    <p>
                                        EmployMeNow makes it easy to view CVs, select suitable candidates and purchase access to their contact details. We’re a user-friendly website, and you can see exactly what you’re paying for before you choose to purchase. Why pay more than £1000 for someone else to look through CVs when it’s so cheap and easy to do it yourself?
                                    </p>
                                    <p>
                                        Instead of interviewing dozens of candidates sent by a recruitment agency that simply wants to be the one to fill your job vacancy, you can use that time to pick out a candidate yourself. You can even register for email alerts, making the search for a candidate as effortless as possible.
                                    </p>
                                </div>
                                </div>

</div>

<div id="footer">
		    <?php
            include ("thefooter.php");
 ?>
</div>

<script type="text/javascript">
    $(".faded").each(function(i) {
        $(this).delay(i * 500).fadeIn(1000);
    });

    $(".faded").hide()

    $(document).ready(function() {
        $(".faded2").hide();
        $(".faded2").slideUp(1).delay(500).slideDown('slow');
    });

</script>
</body>
</html>
