<?php
  session_start();
  include("database.inc.php");
  require("inc/MPDF57/mpdf.php");
  if(!isset($_SESSION['userid'])) die("");
  if(isset($_SESSION['userid'])) {
    if($_SESSION['mode'] == "user") {
      $result = mysql_query("SELECT `cvfilename`,`cvdata` FROM `users` WHERE `id`='".$_SESSION['userid']."' LIMIT 1");
      list($fname,$data) = mysql_fetch_array($result);
    }
    if($_SESSION['mode'] == "employer") {
      $result = mysql_query("SELECT * FROM `users` WHERE `id`='".mysql_real_escape_string($_GET['id'])."' LIMIT 1");
      $user = mysql_fetch_row($result,MYSQL_ASSOC);
    }

    $pdf = new mPDF('', array(210,700));
    ob_start();
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #333;
}


h1,h2,h3{
	color:#63b6da;}

p {
    margin-bottom: 10px;
}

</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="http://employmenow.co.uk/web/images/logo.png" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h1><?php echo $user['name']; ?></h1></td>
  </tr>
  <tr>
    <td><strong>Job title: </strong><?php echo $user['jobtitle']; ?></td>
  </tr>
  <tr>
    <td><strong>Town: </strong><?php echo $user['town']; ?></td>
  </tr>
  <tr>
    <td><strong>County: </strong><?php echo $user['county']; ?></td>
  </tr>
  <tr>
    <td><strong>Phone: </strong><?php echo $user['phone']; ?></td>
  </tr>
  <tr>
    <td><strong>Mobile: </strong><?php echo $user['mobile']; ?></td>
  </tr>
  <tr>
    <td><strong>Salary: </strong><?php echo $user['salary']; ?></td>
  </tr>

  <tr>
      <td><strong>Date available: </strong><?php echo date('d/m/Y',strtotime($user['availablefrom'])); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h1>My Personal Statement</h1></td>
  </tr>
  <tr>
    <td><?php echo $user['bio']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h1>Work Experience</h1></td>
  </tr>
  <tr>
    <td><?php echo stripslashes($user['workexperience_text']); ?></td>
  </tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h1>Education and Qualifications</h1></td>
  </tr>
  <tr>
    <td><?php echo $user['qualifications']; ?><?php echo " " . stripslashes($user['education_text']); ?></td>
  </tr>
  <tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><h1>Hobbies</h1></td>
  </tr>
  <tr>
    <td><?php echo stripslashes($user['achievements']); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
<?php
    $strOutput = ob_get_contents();
    ob_end_clean();
    $pdf->WriteHTML($strOutput);
    $pdf->Output();
    exit;
  }
?>