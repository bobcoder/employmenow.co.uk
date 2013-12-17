<?php
session_start();
include ("database.inc.php");
//echo "Job = " . $_SESSION['job_id'];


$_SESSION['search_url'] = $_GET['url'];

$msg = $_GET['msg'];
if($msg == 'true'){
	$msg2 = 'Thank you, your CV has been submitted, Good Luck';
}
$msg = "";
if (isset($_POST['subInfo'])) {
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
	if ($password != "")
		$PQ = ",`password`='$password'";
	else
		$PQ = "";
	$dob = mysql_real_escape_string($_POST['year']);
	$tmpm = mysql_real_escape_string($_POST['month']);
	if ($tmpm < 10)
		$tmpm = "0" . $tmpm;
	$tmpd = mysql_real_escape_string($_POST['day']);
	if ($tmpd < 10)
		$tmpd = "0" . $tmpd;
	$dob .= "-$tmpm-$tmpd";
	$town = mysql_real_escape_string($_POST['town']);
	$county = mysql_real_escape_string($_POST['county']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$mobile = mysql_real_escape_string($_POST['mobile']);
	$result = mysql_query("UPDATE `users` SET `name`='$name',`email`='$email',`dob`='$dob',`town`='$town',`county`='$county',`phone`='$phone',`mobile`='$mobile'$PQ WHERE `id`='" . $_SESSION['userid'] . "' LIMIT 1");
	if ($result)
		$msg = "<p>Details saved</p>";
	else
		$msg = "<p>There was a problem saving your details.</p>";
}
if (isset($_POST['subSkills'])) {
	foreach ($_POST as $fieldname => $fielddata) {
		if (!is_array($fielddata)) {
			$_POST[$fieldname] = stripslashes($fielddata);
		}
	}

	$jobtitle = mysql_real_escape_string($_POST['jobtitle']);

	$indArray = $_POST['ind'];
	$industries = "";
	if (count($indArray) > 0) {
		$industries = implode("|", $indArray);
	}

	$tArray = $_POST['jobtype'];
	$jobtypes = "";
	if (count($tArray) > 0) {
		$jobtypes = implode("|", $tArray);
	}

	$tArray = $_POST['status'];
	$status = "";
	if (count($tArray) > 0) {
		$status = implode("|", $tArray);
	}
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
	if ($password != "")
		$PQ = ",`password`='$password'";
	else
		$PQ = "";
	$dob = mysql_real_escape_string($_POST['year']);
	$tmpm = mysql_real_escape_string($_POST['month']);
	if ($tmpm < 10)
		$tmpm = "0" . $tmpm;
	$tmpd = mysql_real_escape_string($_POST['day']);
	if ($tmpd < 10)
		$tmpd = "0" . $tmpd;
	$dob .= "-$tmpm-$tmpd";
	$town = mysql_real_escape_string($_POST['town']);
	$county = mysql_real_escape_string($_POST['county']);
	$phone = mysql_real_escape_string($_POST['phone']);
	$mobile = mysql_real_escape_string($_POST['mobile']);

	$headline = mysql_real_escape_string($_POST['headline']);
	$bio = mysql_real_escape_string($_POST['bio']);

	$commission_only = 0;
	$salary = mysql_real_escape_string($_POST['salary']);
	if ($salary == 'commission') {
		$salary = 0;
		$commission_only = 1;
		echo "<!-- commission only! -->";
	}

	$tmpm = mysql_real_escape_string($_POST['amonth']);
	if ($tmpm < 10)
		$tmpm = "0" . $tmpm;
	$tmpy = mysql_real_escape_string($_POST['ayear']);
	$availablefrom = "$tmpy-$tmpm-01";
	$relocate = mysql_real_escape_string($_POST['relocate']);
	$driving = mysql_real_escape_string($_POST['driving']);

	$avatar = mysql_real_escape_string($_POST['avatar']);
	$qualifications = mysql_real_escape_string($_POST['qualifications']);
	$town = mysql_real_escape_string($_POST['town']);
	$workexperience_text = mysql_real_escape_string($_POST['workexperience_text']);
	$education_text = mysql_real_escape_string($_POST['education_text']);
	$achievements = mysql_real_escape_string($_POST['achievements']);

	$quirky_dinner = mysql_real_escape_string($_POST['quirky_dinner']);
	$quirky_movie = mysql_real_escape_string($_POST['quirky_movie']);
	$quirky_quote = mysql_real_escape_string($_POST['quirky_quote']);

	$result = mysql_query("UPDATE `users` SET `jobtitle`='$jobtitle',`name`='$name',`email`='$email',`dob`='$dob',`town`='$town',`county`='$county',`phone`='$phone',`mobile`='$mobile',`industries`='$industries',`status`='$status',`jobtypes`='$jobtypes',`headline`='$headline',`bio`='$bio',`salary`='$salary',`availablefrom`='$availablefrom',`relocate`='$relocate',`avatar`='$avatar',`workexperience_text`='$workexperience_text',`qualifications`='$qualifications',`driving`='$driving',`education_text`='$education_text',`achievements`='$achievements', `commission_only`='$commission_only', `quirky_dinner`='$quirky_dinner', `quirky_movie`='$quirky_movie', `quirky_quote`='$quirky_quote' WHERE `id`='" . $_SESSION['userid'] . "' LIMIT 1");
	$booUpdateComplete = false;
	if ($result) {
		$msg = "<p>Details saved</p>";
		$booUpdateComplete = true;
	} else {
		$msg = "<p>There was a problem saving your details...</p>";
	}
	echo "<!-- UPDATE `users` SET `jobtitle`='$jobtitle',`name`='$name',`email`='$email',`dob`='$dob',`town`='$town',`county`='$county',`phone`='$phone',`mobile`='$mobile',`industries`='$industries',`status`='$status',`jobtypes`='$jobtypes',`headline`='$headline',`bio`='$bio',`salary`='$salary',`availablefrom`='$availablefrom',`relocate`='$relocate',`avatar`='$avatar',`workexp`='$workexp',`qualifications`='$qualifications',`driving`='$driving',`education`='$education',`achievements`='$achievements', `commission_only`='$commission_only' WHERE `id`='" . $_SESSION['userid'] . "' LIMIT 1 -->";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<!--<script type="text/javascript" src="jquery-1.7.1.min.js"></script>-->
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
		<link href="default.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="office/js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="office/js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

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
        <script type="text/javascript" src="office/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="office/js/jquery.dateFormat-1.0.js"></script>

<script>
	$(function() {//ON dom ready
			var surl = "<?php echo $_SESSION['search_url'];?>";
			$('#searchurl').hide();
			if( surl != ''){
				$('#searchurl').show();
				$('#searchurl').click(function (event){
					event.preventDefault();
					window.location.href = surl;
				});
			}
			$("#content-home").tooltip();

		if("<?php echo $_GET['msg'];?>" == 'true'){
			$( "#dialog" ).dialog();
		}
		//TODO put in jqxgrid
		//put in jqxgrid here
		var data = {};
		var theme = getDemoTheme();
		var url = "inc/get_favs.inc.php?id=<?php echo $_SESSION['userid'] ?>";
		var modUrl = "office/incs/db.inc.php1";
		var source = {
        datatype : "json",
        datafields : [{
            name : 'id',
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
        }, {
            name : 'jobsid',
            type : 'int'
        }],
        id : 'id',
        url : url,
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            var data = "tbl=favorites&delete=true&" + $.param(rowdata);
                $.ajax({
                    dataType: 'json',
                    url: modUrl,
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
            var data = "tbl=favorites&delete=true&" + $.param({id: rowid});
            console.log($.param({id: rowid}));

            $.ajax({
            	type:'post',
                dataType: 'text',
                url: 'inc/hide_fav.php',
                cache: false,
                data: data,
                success: function (data, status, xhr) {
                	console.log(data);
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
        var tday = $.format.date(new Date(), "dd-MM-yyyy");
        $("#jqxgrid").jqxGrid({
            width : 950,
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
                datafield : 'id',
                editable: false,
                pinned: true,
                width : 50,
            }, {
                text : 'Title',
                datafield : 'title',
                altrows : true,
            }, {
                text : 'Ref',
                datafield : 'ref',
            }, {
                text : 'Expires',
                datafield : 'date_expires',
                cellsformat: 'dd-MM-yyyy',
        		cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties) {
        			//Establish if the job has expired

					var d = $.format.date(value, "dd-MM-yyyy");
/*
					console.log(new Date(d).getTime() + ' ROW : ' + row);
					console.log(new Date(tday).getTime() + ' ROW : ' + row);*/

					if(new Date(d).getTime() > new Date(tday).getTime()){
						//return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + d + '</span>';
					}
               },
            },{
                text: 'Action',
                width : 90,
                selectionmode: 'none',
                datafield: 'Action',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Remove";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        $("#jqxgrid").jqxGrid('deleterow', id);
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                 }//END click
            },{
				text:'',
				width: 90,
				columntype: 'button',
                cellsrenderer: function () {
                     return "View Job";
                 },
				buttonclick: function (row) {
					var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
					var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
					var griddata = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
					console.log(griddata);
					document.location.href='jobs_details.php?jobId=' + griddata.jobsid;
				}
            }]
        });
	});//END doc ready
		</script>
		<style>
			label {
				display: inline-block;
				width: 5em;
			}
		</style>

		<!--[if IE 6]>
		<link href="default_ie6.css" rel="stylesheet" type="text/css" />
		<![endif]-->
		<script language="JavaScript" type="text/javascript" src="miscfunc.js"></script>
		<script language="JavaScript" type="text/javascript">
						function setAvatar(img) {
			document.getElementById('avatar').value = img;
			document.getElementById('currAvatar').src = '<?php echo $config['siteurl'].$config['imgdir'] ?>
				' + img;
				document.getElementById('grpAvatars').style.display = 'none';
				}

				function showGallery() {
				document.getElementById('grpAvatars').style.display = 'block';
				document.getElementById('grpAvatars').style.width = '550px';
				document.getElementById('grpAvatars').style.overflow = 'hidden';
				}

				function checkPersonalForm() {
				var ok = true;
				if(document.getElementById('name').value == '') {
				document.getElementById('nameCell').style.background = '#FF0000';
				ok = false;
				}
				else document.getElementById('nameCell').style.background = '#FFFFFF';
				if(document.getElementById('email').value == '' || !validateEmail(document.getElementById('email').value)) {
				document.getElementById('emailCell').style.background = '#FF0000';
				ok = false;
				}
				else document.getElementById('emailCell').style.background = '#FFFFFF';
				if(document.getElementById('town').value == '') {
				document.getElementById('townCell').style.background = '#FF0000';
				ok = false;
				}
				else document.getElementById('townCell').style.background = '#FFFFFF';
			<?php
if(!stristr($_SERVER['HTTP_USER_AGENT'],"MSIE 7.0") && !stristr($_SERVER['HTTP_USER_AGENT'],"MSIE 8.0")) {
			?>
				if (document.getElementById('county').value == '') {
					document.getElementById('countyCell').style.background = '#FF0000';
					ok = false;
				} else
					document.getElementById('countyCell').style.background = '#FFFFFF';
			<?php
			}
			?>
				if (document.getElementById('mobile').value == '') {
					document.getElementById('mobileCell').style.background = '#FF0000';
					ok = false;
				} else
					document.getElementById('mobileCell').style.background = '#FFFFFF';
				if (document.getElementById('phone').value == '') {
					document.getElementById('phoneCell').style.background = '#FF0000';
					ok = false;
				} else
					document.getElementById('phoneCell').style.background = '#FFFFFF';
				if (jQuery('#headline').val().length > 140) {
					ok = false;
				}

				if (!ok)
					document.getElementById('msgErr').innerHTML = 'Please correct the problems highlighted.';

				return ok;
				}
		</script>
		<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector : "textarea.tinymce",
				menubar : false,
				statusbar : false,
				mode : "textareas",
			});
		</script>
	</head>

	<body class="account">

		<div id="header-wrapper">
			<div id="header" class="container">
				<div id="logo">
					<img src="images/logo.png" />
				</div>
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
					<?php
	$fav = new Fav();//Call the fav check exists class function
	if($_SESSION['job_id'] != '' || $_SESSION['job_id'] != null){
		$job_id = $_SESSION['job_id'];
		$uid = $_SESSION['userid'];
		//Check if its already in favorites
		$r = $fav->favExists($uid, $job_id);
		if($r === false){//NOT in DB
		  	//Put favorite in DB - User ID , Job ID
		  	$fav_sql = "INSERT INTO `favorites`
							(`user_id`,
							`job_id`)
							VALUES(
							$uid ,
							$job_id )";
			$fav_result = mysql_query($fav_sql);
			$_SESSION['new_fav'] = mysql_insert_id();
			//Kill the session var
			$_SESSION['job_id'] = '';
		}
	  }
					if (!$_SESSION['userid'] OR $_SESSION['mode'] == "employer")

						die("You need to <a href=\"login.php\">login</a> to continue, we are redirecting you now <META HTTP-EQUIV=\"refresh\" CONTENT=\"0;URL=login.php\">
</body></html>");
					?>

					<div class="longbox2">

					<a name="1"></a>

					<h2>
					<?php echo "Welcome back " . $_SESSION['name'] . "!"; ?>
					</h2>
					<P>Please ensure all fields are complete for your CV to show online</P>
					<?php
$result = mysql_query("SELECT * FROM `users` WHERE `id`='".$_SESSION['userid']."'");
$user = mysql_fetch_array($result,MYSQL_ASSOC);
$user_fixed = array();
foreach ($user as $fieldname => $fielddata)
{
$user_fixed[$fieldname] = stripslashes($fielddata);
}

$user = $user_fixed;

if($user['avatar'] == "") $user['avatar'] = "images/default.png";

if ($booUpdateComplete)
{

					?>

					<!--<div style="background-color: #36a1cf; color: white;">Your details were saved.</div>-->
					<script>
						$(function(){
							$( "#dialogupdate" ).dialog();
						})
					</script>
					<?php
					}
					else
					{
					echo "<p id=\"msgErr\">$msg</p>";
					}
					?>
					<P>View Jobs you have applied for <a class='button' href='candidate_jobs.php'>here</a></P>
					<P>So far, your CV has been viewed <strong> <?php echo $user['views']; ?>
					</strong>times</P>
					<div class="accountleft">
					<form name="frmSkills" method="post" onsubmit="return checkPersonalForm();">
					<table width="439">
					<tr><td width="101"><strong>Name:</strong></td><td width="246" id="nameCell"><input type="text" name="name" id="name" value="<?php echo $user['name']; ?>"></td></tr>
					<tr><td><strong>E-mail:</strong></td><td id="emailCell"><input type="text" name="email" id="email" value="<?php echo $user['email']; ?>"></td></tr>
					<tr><td><strong>Password:</strong></td><td id="passwordCell"><input type="password" name="password" value="<?php echo $user['password']; ?>"></td></tr>
					<?php
					$dobparts = explode("-", $user['dob']);
					?>
					<tr><td><strong>Date of birth:</strong></td><td id="dobCell"><select name="day" style="width: 60px"><?php dumpDays($dobparts[2]); ?>
					</select><select name="month" style="width: 140px"><?php dumpMonths($dobparts[1]); ?>
					</select><select name="year" style="width: 60px"><?php dumpYears(70, $dobparts[0]); ?>
					</select></td></tr>
					<tr><td><strong>Town:</strong></td><td id="townCell"><input type="text" name="town" id="town" value="<?php echo $user['town']; ?>"></td></tr>
					<tr><td><strong>County:</strong></td><td id="countyCell"><?php dumpCounties($user['county']); ?>
					</td></tr>
					<tr><td><strong>Phone:</strong></td><td id="phoneCell"><input type="text" name="phone" id="phone" value="<?php echo $user['phone']; ?>"></td></tr>
					<tr><td><strong>Mobile:</strong></td><td id="mobileCell"><input type="text" name="mobile" id="mobile" value="<?php echo $user['mobile']; ?>"></td></tr>
					</table>

					</div>

					<div class="accountright"><h3>Choose your Avatar:</h3><Br/>
					<img src="<?php echo $config['siteurl'] . $config['imgdir'] . $user['avatar']; ?>" id="currAvatar"><br>
					<a href="#" onclick="showGallery(); return false;">Choose from gallery</a>
					<input type="hidden" name="avatar" id="avatar" value="<?php echo $user['avatar']; ?>">
					<br/>
					<div id="grpAvatars">
					<?php
					//echo "test" . $config['sitepath'] . $config['imgdir'] . $config['imgfiles'];

					$files = getImageList($config['sitepath'] . $config['imgdir'], $config['imgfiles']);

					echo "<nobr>";
					for ($x = 0; $x < count($files); $x++)
						echo "<a href=\"#\" onclick=\"setAvatar('$files[$x]'); return false;\"><img width=\"45px\" src=\"" . $config['siteurl'] . $config['imgdir'] . $files[$x] . "\"></a>";
					echo "</nobr>\n";
					?>

					</div>
					</div>
					<br/><br/><br/><br/><br/><br/>
					<h2>&nbsp;</h2>
					</div>
<div class="longbox2">
	<h2>Favourites</h2>
	<div id='jqxWidget' style="font-size: 13px;float:left">
		<!--<div id="jqbutton-wrap" style="margin-left: 10px; float: left;"></div>-->
		<div id="jqxgrid" style="z-index:100;width:950px;"></div>
		<div id="selectrowindex"></div>
	</div>
</div>
					<div class="longbox2">

					<table width="940">

					<tr>
					<td colspan="5"></td>
					</tr>
					<tr>
					<td colspan="5"><h2>Your current position and requirements</h2></td>
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
					$jt = explode("|", $user['status']);
					for ($x = 0; $x < count($config['status']); $x++) {
						echo "<input type=\"checkbox\" name=\"status[]\" value=\"" . $config['status'][$x] . "\"" . (in_array($config['status'][$x], $jt) == true ? " checked" : "") . ">" . $config['status'][$x] . "<br>\n";
					}
					?>

					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td rowspan="8"><table>
					<?php
					$sect = explode("|", $user['industries']);
					$result = mysql_query("SELECT `name` FROM `industries` WHERE `deleted`=0 ORDER BY `name` ASC");
					$t = mysql_num_rows($result);
					$ind = array();
					while ($output = mysql_fetch_row($result))
						$ind[] = $output[0];
					for ($x = 0; $x < $t; $x += 3) {
						echo "<tr>";
						for ($y = 0; $y < 3; $y++) {
							if (isset($ind[$x + $y]))
								echo "<td><input type=\"checkbox\" name=\"ind[]\" value=\"" . $ind[$x + $y] . "\"" . (in_array($ind[$x + $y], $sect) == true ? " checked" : "") . "> " . $ind[$x + $y] . "</td>";
						}
						echo "</tr>\n";
					}
					?>
					</table></td>
					</tr>
					<tr>
					<td valign="top"><strong>Job type:</strong></td>
					<td valign="top"><?php
					$jt = explode("|", $user['jobtypes']);
					for ($x = 0; $x < count($config['jobtypes']); $x++) {
						echo "<input type=\"checkbox\" name=\"jobtype[]\" value=\"" . $config['jobtypes'][$x] . "\"" . (in_array($config['jobtypes'][$x], $jt) == true ? " checked" : "") . ">" . $config['jobtypes'][$x] . "<br>\n";
					}
				?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td><strong>Are you willing to relocate?</strong></td>
					<td><input type="radio" name="relocate" value="1"<?php
					if ($user['relocate'] == 1)
						echo " checked";
					?> />
					Yes
					<input type="radio" name="relocate" value="0"<?php
					if ($user['relocate'] == 0)
						echo " checked";
					?> />
					No</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td><strong>Do you have a full UK driving licence?</strong></td>
					<td><input type="radio" name="driving" value="1"<?php
					if ($user['driving'] == 1)
						echo " checked";
					?> />
					Yes
					<input type="radio" name="driving" value="0"<?php
					if ($user['driving'] == 0)
						echo " checked";
					?> />
					No</td>
					</tr>
					<tr>
					<td><strong>Choose your expected salary:</strong></td>
					<td><select name="salary">

					<?php dumpSalaries($user['salary'], $config['salaryMin'], $config['salaryMax'], $config['salaryStep']); ?>
					<option value='commission' <?php
					if ($user['commission_only'] == 1) {
						echo " selected='selected' ";

					}
					?>>Commission Only</option>
					</select></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					</tr>
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
					$avparts = explode("-", $user['availablefrom']);
					?>
					<tr>
					<td colspan="5"></td>
					</tr>

					<tr><td colspan="6" align="right">&nbsp;</td></tr>
					</table>

					</div>

					<div class="longbox2">

					<table width="940">

					<tr>
					<td colspan="5"><h2>Build your CV</h2><BR/>

					<P><STRONG>Well Done for coming this far! </STRONG>Are you now prepared to go that one step further? Take a few minutes and complete your CV and profile yourself to many potential employers. <STRONG>What are you waiting for?</STRONG></P>
					<p><strong>Cheats tip - you can copy  and paste from your current CV in the sections below</strong></p>
					</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
					<td><strong>Profile headline:</strong></td>
					<td colspan="4"><input title="This is your first contact with an employer, make it stand out and catchy, do not enter your name in this field" type="text" name="headline" id="headline" style="width: 700px;" value="<?php echo $user['headline']; ?>" />
					    <br /><span id="countdown_headline"></span></td>
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
					<p class="tip">If you are using a modern browser you will be able to extend the box above by stretching the bottom right corner</p>
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
					<p class="tip">If you are using a modern browser you will be able to extend the box above by stretching the bottom right corner</p>

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
					<td><input type="submit" id="subSkills" name="subSkills" class="searchbutton" value="Save Profile" /></td>
					<td>&nbsp;</td>
					<td><input type="submit" id="searchurl" name="subSkills" class="searchbutton" value="Return to Job" /></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td></tr>

					<tr><td colspan="6" align="right">&nbsp;</td></tr>
					</table>

					Having problems signing up or need any assistance? <a href="mailto:info@employemenow.co.uk">Get in touch </a><br/><br/>

					</form>

					<FORM METHOD="LINK" ACTION="http://employmenow.co.uk/web/deleted.php">

					<input name="btnHomeSearch" type="submit" class="searchbutton2" value="Delete Account" /></form><br/>
					*Warning, this will delete your account, there is no undo.
					</div>
				</div>
				<div id="footer">
					<?php
					include ("thefooter.php");
					?>
				</div>


	<div id="dialog" title="Application Sent">
		<p><?php echo $msg2;?></p>
	</div>
		<div id="dialogupdate" title="CV updated">
		<p>Your new details have been saved.</p>
	</div>

	</body>
</html>