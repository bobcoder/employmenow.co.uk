<?php
  include("database.inc.php");
  
  $result = mysql_query("SELECT * FROM `subscriptions`");
  $html = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Employmenow</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333;
}

.button{padding: 5px;
background-color: #3399cc;
width: 200px;
color: #ffffff;
text-decoration: none;
margin-top: 10px;}


.headline{
	
	
	font-size: 16px;
color: #13a5e4;

}


p{margin:0px;}


</style>
</head>

<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="http://employmenow.co.uk/web/images/logo.png" alt="Employmenow.co.uk" />
      <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><hr /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
';
$html2 = ' 
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
  <tr>
    <td><img src="http://employmenow.co.uk/web/images/logo.png" alt="Employmenow.co.uk" /></td>
  </tr>
</table>
</body>
</html>
';
  
  while($output = mysql_fetch_row($result,MYSQL_ASSOC)) 
  {
    $c = 0;
    $q = "";
    $booIndustries = true;
    $booKeywords = true;
    $tmpq = explode("|",$output['industries_names']);
    if (($output['industries_names'] != '') && (count($tmpq) > 0))
    {
        $q .= " AND (";
        foreach($tmpq as $qs) $q .= "`industries` LIKE '%$qs%' OR ";    
        $q = substr($q,0,strlen($q)-4);
        $q .= ")";
        
    }
    else
    {
        $booIndustries = false;
    }
    
    $tmpq = explode(" ",$output['keywords']);
    if (($output['keywords'] != '') && (count($tmpq) > 0)) 
    {
        $q .= " AND (";
        foreach($tmpq as $qs) $q .= "`jobtitle` LIKE '%$qs%' OR `town` LIKE '%$qs%' OR `county` LIKE '%$qs%' OR `headline` LIKE '%$qs%' OR `bio` LIKE '%$qs%' OR ";    
        $q = substr($q,0,strlen($q)-4);
        $q .= ")";
    }
    else
    {
        $booKeywords = false;
    }
    
    if ($booIndustries || $booKeywords)
    {
        $q .= " AND regdate >= DATE_SUB( NOW( ) , INTERVAL 1 WEEK )";

        echo "SELECT * FROM `users` WHERE `active`=1".$q." <br />";

        $res = mysql_query("SELECT * FROM `users` WHERE `active`=1$q");     
        $c = mysql_num_rows($res);
        if($c > 0) {
          echo "EMAIL?<br />";
          $msg = "Here are $c new candidates registered in the last week.\n\n";
          $html_msg = '';
          while($user = mysql_fetch_row($res,MYSQL_ASSOC)) {
            $msg .= $user['jobtitle']."\n".$user['town']."\n".$user['headline']."\n\n";

            $html_msg .= '<div class="result">
        <table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="163" rowspan="7" valign="top">';
            $strAvatar = $config['siteurl'].$config['imgdir'].$user['avatar'];
            if (substr($user['avatar'],0,6)=='avatar')
            {
                $html_msg .= '<img src="'.$strAvatar.'" />';
            }
            else
            {
                $html_msg .= '<img src="'.$config['siteurl'].$config['imgdir'].'images/default.png" />';
            }
          $html_msg .= '</td>
            <td width="437" valign="top"><p class="headline">'.$user["headline"].'</p></td>
          </tr>
          <tr>
            <td valign="top"><p><strong>'.$user["town"].'</strong></p></td>
          </tr>
          <tr>
            <td valign="top"><p>'.$user["jobtitle"].'</p></td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><a href="'.$config['siteurl'].'view.php?id='.$user['id'].'" class="button">find out more</a></td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
        </table>


      </div>
    ';
          }

          $r = mysql_query("SELECT `email` FROM `employers` WHERE `id`='".$output['employerid']."' LIMIT 1");
          list($dest) = mysql_fetch_array($r);
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= "From: EmployMeNow <noreply@employmenow.co.uk>";
         
          mail($dest,"There are $c new candidates waiting for you!",$html.$html_msg.$html2,$headers);
        }
    }
  }
?>