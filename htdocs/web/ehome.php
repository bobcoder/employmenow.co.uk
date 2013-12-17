<?php
  session_start();
  include("database.inc.php");
  include("inc/file_handler.php");

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
//Start of FILE upload

	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);

	if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png") || ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 5500000) && in_array($extension, $allowedExts))//1.5MB
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {

      $timestamp = time();
	  $name = $timestamp . "-" . $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $name);

		//Resize image
		createThumbs(__DIR__ . "/upload/", __DIR__ . "/upload/medium/",220, $name);
		createThumbs(__DIR__ . "/upload/", __DIR__ . "/upload/small/",100, $name);
		//echo "Stored in: " . __DIR__ . "/upload/" . $name;

    }
  }
else
  {
  //echo "Invalid file";
  }
  /*
   * END of fILe upload block
  */
  $get_result = mysql_query("SELECT logo FROM `employers` WHERE `id`='".$_SESSION['userid']."' LIMIT 1");
  $img = mysql_fetch_array($get_result,MYSQL_ASSOC);


//Decide if we have any data for the logo field or use what we have in the db
  if($name == '' && $img['logo'] == 'nologo.jpg'){
  		$name = 'nologo.jpg';
  	}else if($name == '' && $img['logo'] != 'nologo.jpg'){
  		$name = $img['logo'];
  	}

    $update_result = mysql_query("UPDATE `employers` SET
    `companyname`='$companyname',
    `name`='$contactname',
    `email`='$email',
    `telephone`='$telephone',
    `logo` = '$name'
    WHERE `id`='".$_SESSION['userid']."'
    LIMIT 1");

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
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="office/js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="office/js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<!--        <link rel="stylesheet" href="js/styles/jqx.arctic.css" type="text/css" />-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script type="text/javascript" src="office/js/jqxcore.js"></script>
        <script type="text/javascript" src="office/js/jqxbuttons.js"></script>
        <script type="text/javascript" src="office/js/jqxscrollbar.js"></script>
        <script type="text/javascript" src="office/js/jqxmenu.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.sort.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.filter.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.selection.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.columnsresize.js"></script>
        <script type="text/javascript" src="office/js/jqxpanel.js"></script>
        <script type="text/javascript" src="office/js/jqxcheckbox.js"></script>
        <script type="text/javascript" src="office/js/jqxlistbox.js"></script>
        <script type="text/javascript" src="office/js/jqxdropdownlist.js"></script>
        <script type="text/javascript" src="office/js/jqxdata.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.pager.js"></script>
        <script type="text/javascript" src="office/js/jqxtabs.js"></script>
        <script type="text/javascript" src="office/js/jqxgrid.edit.js"></script>
        <script type="text/javascript" src="office/js/gettheme.js"></script>
        <script type="text/javascript" src="office/js/nav.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.dateFormat-1.0.js"></script>
        <script type="text/javascript" src="office/js/is.js"></script><!-- My special js :-) -->
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
<form name="frmRegister" method="post" onsubmit="return checkForm();" enctype="multipart/form-data">
<table>
<tr><td>Company Name:</td><td id="companynameCell"><input type="text" class="login" name="companyname" id="companyname" value="<?php echo $user['companyname']; ?>"></td></tr>
<tr><td>Contact Name:</td><td id="contactnameCell"><input type="text" class="login" name="contactname" id="contactname" value="<?php echo $user['name']; ?>"></td></tr>
<tr><td>E-mail:</td><td id="emailCell"><input type="text" name="email" class="login" id="email" value="<?php echo $user['email']; ?>"></td></tr>
<tr><td>Telephone:</td><td id="telephoneCell"><input type="text" class="login" name="telephone" id="telephone" value="<?php echo $user['telephone']; ?>"></td></tr>
<tr><td>Password:</td><td id="passwordCell"><input type="password" class="login" name="password" id="password"></td></tr>
<tr><td>Logo:</td><td id="logoCell">
	<input type="file" class="login" name="file" id="logo_file"><br>
	<img src="upload/small/<?php echo $user['logo'];?>">
	</td></tr>
<tr><td colspan="2" align="right"><input type="submit" class="searchbutton" name="submit" value="Save"></td></tr>
</table>
</form>
</DIV>
<div class="cvs">
	<h3>Posted Jobs</h3><br>
	<div id='jqxWidget' style="font-size: 13px;float:left">
		<div id="jqbutton-wrap" style="margin-left: 10px; float: left;"></div>
		<div id="jqxgrid" style="z-index:100;"></div>
		<div id="selectrowindex"></div>
	</div>
</div>
<?php
      echo "<div class=\"cvs\">";
  echo "<h3>Purchased CVs</h3>\n";
  echo "<table>\n";
  echo "<tr><th>Name</th><th>County</th><th>Job title</th><th>Salary</th><th>&nbsp;</th></tr>\n";
  $eid = $_SESSION['userid'];
  foreach($owned as $o) {
    $result = mysql_query("SELECT * FROM `users` WHERE `id`='$o'");
    $output = mysql_fetch_array($result,MYSQL_ASSOC);
	$exclude = array($output['email'], $output['mobile'], $output['telephone'], $output['name']);
    echo "<tr>";
	$t = sanitize($output['jobtitle'], $exclude);
    echo "<td><nobr>".$output['name']."</nobr></td><td>".$output['county']."</td><td><nobr>" . substr($t, 0, 40) . "</nobr></td><td>&pound;".
    number_format($output['salary'], 0, '.', ',') . "</td><td><a href=\"download.php?id=" . $output['id'] . "\">Download</a>&nbsp;
    <a href='inc/del_cv.php?eid=$eid&uid=$o' >Delete</a>
    </td></tr>\n";
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
	$exclude = array($output['email'], $output['mobile'], $output['telephone'], $output['name']);
    echo "<tr>";
	$t = sanitize($output['jobtitle'], $exclude);
	//echo substr($text, 0, 45);
    echo "<td><nobr>".$output['id']."</nobr></td><td>".$output['county']."</td><td><nobr>" . substr($t, 0, 40) . "</nobr></td><td>&pound;".number_format($output['salary'], 0, '.', ',')."</td><td><a href=\"?ds=".$output['id']."\">Remove</a></td><td><a href=\"view.php?id=".$output['id']."\">View CV</a></td><td><a href=\"buy.php?id=".$output['id']."\">Buy CV</a></td></tr>\n";
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
			<?php require('inc/sidebar_search.php'); ?>
            <div class="sidebarbox">
                <div class="sideheader">
               Post Your Jobs Here
                </div>
                <div class="sidecontent">
                <div class="sidesection">
                	<div>
                    	<p>Employers list your vacancy on our live jobs board for free</p>
						<p>We work with other leading jobs boards to ensure maximum exposure for your vacancy
						Receive applications direct to your chosen email account</p><p>
						Only pay per CV you wish to unlock, as per the main body of our website
						Potentially fill your vacancy for just £14.95 (the cost of one CV)</p>
                	</div>
                	<div class="buttonsleft">
						<a class="jobsbutton" href="post_job.php">Post a job</a>
					</div>
					<div class="buttonsleft">
						<a class="jobsbutton" href="job_applications.php">View Applicants</a>
					</div>
                </div>
              </div>
            </div>
</div>
</div>
<div id="footer">
	<?php include("thefooter.php"); ?>
</div>
<script>
    $(document).ready(function() {
		var data = {};
		var theme = getDemoTheme();
		var url = "inc/get_jobs_by_employer.php?employer_id=<?php echo $_SESSION['userid'] ?>";
		var modUrl = "office/incs/db.inc.php";
		var source = {
        datatype : "json",
        datafields : [{
            name : 'jobs_id',
            type : 'int'
        }, {
            name : 'title',
            type : 'string'
        }, {
            name : 'ref',
            type : 'string'
        }, {
            name : 'date_expires',
            type : 'date',
        }],
        id : 'jobs_id',
        url : url,
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            var data = "tbl=jobs&update=true&" + $.param(rowdata);
                $.ajax({
                    dataType: 'json',
                    url: 'http://employmenow.co.uk/web/office/' + modUrl,
                    cache: false,
                    data: data,
                    success: function (data, status, xhr) {
                        commit(true);
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(textStatus);
                        commit(false);
                    }
                });
        },
        deleterow: function (rowid, commit) {
            var data = "tbl=jobs&delete=true&" + $.param({id: rowid});
            console.log($.param({id: rowid}));
            $.ajax({
                dataType: 'text',
                url: modUrl,
                cache: false,
                data: data,
                success: function (data, status, xhr) {
                    $("#jqxgrid").jqxGrid('clearselection');
                    commit(true);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    console.log(textStatus);
                    commit(false);
                }
        });
        },
        sortcolumn : 'title',
        sortdirection : 'asc',
        pagesize : 10,
        pager : function(pagenum, pagesize, oldpagenum) {
        // callback called when a page or page size is changed.
        }
        };
        //END source
        var dataAdapter = new $.jqx.dataAdapter(source);
        //Display Grid
        $("#jqxgrid").jqxGrid({
            width : 650,
            source : dataAdapter,
            theme : theme,
            pageable : true,
            pagesizeoptions: ['20', '30', '40'],
            autoheight : true,
            editable: false,
            editmode: 'Double-Click',
            columnsresize : false,
            filterable : true,
            sortable : false,
            altrows : true,
            selectionmode: 'singlerow',
            columns : [{
                text : 'ID',
                datafield : 'jobs_id',
                editable: false,
                pinned: true,
                width : 30,
            }, {
                text : 'Title',
                datafield : 'title',
                altrows : true,
                width: 170,
            }, {
                text : 'Ref',
                datafield : 'ref',
            }, {
                text : 'Expires',
                datafield : 'date_expires',
                cellsformat: 'dd-MM-yyyy',
        		cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties) {
        			//Establish if the job has expired
        			var tday = $.format.date(new Date(), "dd-MM-yyyy")
					var d = $.format.date(value, "dd-MM-yyyy");
					if(tday > d){
						//return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + d + '</span>';
					}
               },
               width:100,
            },{
                text: 'Action',
                width : 60,
                selectionmode: 'none',
                datafield: 'Action',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Delete";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        //yn(id);//Yes No dialog
                        $("#jqxgrid").jqxGrid('deleterow', id);
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                 }//END click
                 },{
                text: '',
                width : 50,
                selectionmode: 'none',
                datafield: 'Edit',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Edit";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        //yn(id);//Yes No dialog
                        console.log(id + <?php echo $_SESSION['userid'];?>);
                        document.location.href='edit_job.php?jobid=' + id;
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                 }//END click
                 },{
					width:90,
					selectionmode: 'none',
					datafield: 'View',
					columntype: 'button',
					cellsrenderer: function () {
						return "Applicants";
					},buttonclick: function (event) {

                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        document.location.href='view_applicants_for_job.php?jobid=' + id;
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
					}
                 }]
        });
        //ENd display grid
			function yn(id){
			//////Confirm dialog
			$('<div style="z-index:10000;"></div>').appendTo('body')
			  .html('<div><h3>Remove Job. Yes or No?</h3></div>')
			  .dialog({
			      modal: true, title: 'message', zIndex: 100000, autoOpen: true,
			      width: 'auto', resizable: false,
			      buttons: {
			          Yes: function () {
			              $("#jqxgrid").jqxGrid('deleterow', id);
			              $(this).dialog("close");
			          },
			          No: function () {
			              $(this).dialog("close");
			          }
			      },
			      close: function (event, ui) {
			          $(this).remove();
			      }
			});//ENd dialog confirm
		}
    });//ENd document ready
</script>
<?php
function sanitize($inpstr, $wordlist){

		$rep = "/[^@\s]*@[^@\s]*\.[^@\s]*/";
		$string = preg_replace($pattern, '', $inpstr);

		foreach ($wordlist as &$word) {
		    $word = '/\b' . preg_quote($word, '/') . '\b/';
		}
		$string = preg_replace($wordlist, '', $inpstr);

	return $string;
}
?>
</body>
</html>
