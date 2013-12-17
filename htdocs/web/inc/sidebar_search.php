<div class="sidebarbox">

                <div class="sideheader">
                Find your candidate
                </div>

                <div class="sidecontent"> <p>Use the fields below to find your ideal candidate, <strong>browse for free</strong></p>

                        <form action="browse.php" method="get" id='thisform'>

<!--<input name="location" type="text" value="Location" /><br/>-->
<?php if (((!array_key_exists('posttmp',$_SESSION)) || (!array_key_exists('keyword',$_SESSION['posttmp']))) || (strlen(trim($_SESSION['posttmp']['keyword'])) == 0))
    {
        $strKeyword= "Keywords";
    }
    else
    {
        $strKeyword= trim($_SESSION['posttmp']['keyword']);
    }

    if (((!array_key_exists('posttmp',$_SESSION)) || (!array_key_exists('location',$_SESSION['posttmp']))) || (strlen(trim($_SESSION['posttmp']['location'])) == 0))
    {
        $strLocation= "Location";
    }
    else
    {
        $strLocation= trim($_SESSION['posttmp']['location']);
    }
?>
<input name="keyword" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Keywords':this.value;" value="<?php echo $strKeyword; ?>" /><br/>
<input name="location" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Location':this.value;" value="<?php echo $strLocation; ?>"/>

<select name="distance"><option value="distance from location">Distance from location</option>
  <option value="1"<?php if($_SESSION['posttmp']['distance'] == "1") echo " selected"; ?>>Upto 1 Mile</option>
  <option value="5"<?php if($_SESSION['posttmp']['distance'] == "5") echo " selected"; ?>>Within 5 Miles</option>
  <option value="10"<?php if($_SESSION['posttmp']['distance'] == "10") echo " selected"; ?>>Within 10 Miles</option>
  <option value="20"<?php if($_SESSION['posttmp']['distance'] == "20") echo " selected"; ?>>Within 20 Miles</option>
  <option value="30"<?php if($_SESSION['posttmp']['distance'] == "30") echo " selected"; ?>>Within 30 Miles</option>
  <option value="40"<?php if($_SESSION['posttmp']['distance'] == "40") echo " selected"; ?>>Within 40 Miles</option>
  <option value="60"<?php if($_SESSION['posttmp']['distance'] == "60") echo " selected"; ?>>Within 60 Miles</option>
  <option value="100"<?php if($_SESSION['posttmp']['distance'] == "100") echo " selected"; ?>>Within 100 Miles</option>
  <option value="over"<?php if($_SESSION['posttmp']['distance'] == "over") echo " selected"; ?>>100 Miles and over</option>
</select><br />
<?php /*<input name="industry" type="text" value="industry" /><br/> */ ?>
<select name="industry"><option value="industry">Industry</option>
<?php
  $result = mysql_query("SELECT * FROM `industries` WHERE `deleted`=0 ORDER BY `name` ASC");
  while($output = mysql_fetch_row($result)) echo "<option value=\"$output[1]\"".($_SESSION['posttmp']['industry']==$output[1]?" selected":"").">$output[1]</option>";
?></select><br />
<?php /* <input name="salary" type="text" value="salary" /><br/> */ ?>
<select name="salary"><option value="salary">Salary</option>
<?php
  dumpSalaries($_SESSION['posttmp']['salary'],$config['salaryMin'],$config['salaryMax'],$config['salaryStep']);
?>
    <option value='commission' <?php
                if ($_SESSION['posttmp']['salary'] == 'commission')
                {
                    echo " selected='selected' ";

                }

                ?>>Commission Only</option>
</select><br />
<select name="jobtype"><option value="job type">Job type</option>
<?php
  foreach($config['jobtypes'] as $jt) echo "<option value=\"$jt\"".($_SESSION['posttmp']['jobtype']==$jt?" selected":"").">$jt</option>";
?></select><br />

<select name="date"><option value="date">Date last active</option>
  <option value="1"<?php if($_SESSION['posttmp']['date'] == "1") echo " selected"; ?>>Last 24 hours</option>
  <option value="3"<?php if($_SESSION['posttmp']['date'] == "3") echo " selected"; ?>>Last 3 days</option>
  <option value="7"<?php if($_SESSION['posttmp']['date'] == "7") echo " selected"; ?>>Last 7 days</option>
  <option value="14"<?php if($_SESSION['posttmp']['date'] == "14") echo " selected"; ?>>Last 14 days</option>
  <option value="any"<?php if($_SESSION['posttmp']['date'] == "any") echo " selected"; ?>>Anytime</option>
</select><br />
<input name="btnHomeSearch" type="submit" class="sidebutton" value="Find your candidate" /></form>
              </div>


			</div>
			<script>
			    function submitForm(formId) {
    $.ajax( {
        type: "post",
        url: 'browse.php',
        data: $('#' + formId + ' input').serialize(),

        success: function(data) {
            console.log('Here');
        }
    });
    return false;
}
			</script>