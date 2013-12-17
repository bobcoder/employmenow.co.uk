<?php
session_start();
include ("database.inc.php");
$jobid = mysql_real_escape_string($_GET['jobid']);
//Check login credentials
if(!$_SESSION['userid'] OR $_SESSION['mode'] =="user"){
	header('location: login.php');
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
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600|Archivo+Narrow:400,700" rel="stylesheet" type="text/css" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="office/js/styles/jqx.base.css" type="text/css" />
        <link rel="stylesheet" href="office/js/styles/jqx.darkblue.css" type="text/css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
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
<body class="account">
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<img src="images/logo.png" />
			</div>
		<?php	include ("navlogin.inc.php");?>
		<?php	include ("themenu.php");?>
		</div>
	</div>
	<div id="wrapper">
		<div id="page" class="container">
			<div id="content-home">
				<div class="longbox2">
					<h3>Job Applicants</h3><br>
					<div id='jqxWidget' style="font-size: 13px;float:left">
						<div id="jqbutton-wrap" style="margin-left: 10px; float: left;"></div>
						<div id="jqxgrid"></div>
						<div id="selectrowindex"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<?php	include ("thefooter.php");?>
	</div>
	<script>
		$(function() {//On doc ready
		    var theme = getDemoTheme();
            var url = "inc/get_applicants_for_job.php?jobid=<?php echo $jobid;?>";
            // prepare the data
            var source ={
                datatype: "json",
                datafields: [
                	{ name: 'app_id' },
                    { name: 'userId' },
                    { name: 'title'},
                    { name: 'ref'},
                    { name: 'date_expires', type: 'date '},
                    { name: 'date_applied', type : 'date'}
                ],
                id: 'app_id',
                url: url,
                deleterow: function (rowid, commit) {
                	console.log($.param({id: rowid}));
                	var data = $.param({id: rowid});
                	$.ajax({
	                    dataType: 'json',
	                    type: 'post',
	                    url: 'inc/hide_jobs_employer.php',//Need to create it :-)
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
                	});//End ajax call
                },
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: 970,
                source: dataAdapter,
                theme: theme,
                columnsresize: true,
				pageable : true,
				pagesizeoptions: ['20', '30', '40'],
				autoheight : true,
                columns: [
                  { text: 'App ID', dataField: 'app_id', width: 100 },
                  { text: 'Title', dataField: 'title'},
                  { text: 'Reference', dataField: 'ref', width: 80, cellsalign: 'left' },
                  { text: 'Expiry Date',
                  dataField: 'date_expires',
                  width: 110,
                  cellsalign: 'left',
					cellsformat: 'dd-MM-yyyy',
					cellsrenderer: function (row, columnfield, value, defaulthtml, columnproperties) {
        			//Establish if the job has expired
					var tday = $.format.date(new Date(), "dd-MM-yyyy")
					var d = $.format.date(value, "dd-MM-yyyy");
						if(tday > d){
							return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">Job Expired</span>';
						}else{
							return '<span style="margin: 4px; float: ' + columnproperties.cellsalign + '; ">' + d + '</span>';}
					}
				},
				{ text: 'Date Applied', datafield: 'date_applied', width: 110, cellsformat: 'dd-MM-yyyy' },
				{ text: 'Action',
                width : 90,
                selectionmode: 'none',
                datafield: 'Remove',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Remove";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                     var datajson2 = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
						yn(datajson2.app_id);//Go get the dialog
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                 }
                },
                {
                	width : 90,
                	selectionmode: 'none',
					datafield: 'View',
					columntype: 'button',
					cellsrenderer: function () {
                     return "View";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                     var datajson = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
					if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
						var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
						//Redirect to view page
						document.location.href='view.php?id=' + datajson.userId;
						}
						console.log("View " + id);
						$('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                  }
                }
				]//END columns
            });
			//////Confirm dialog
			function yn(id){
			$('<div></div>').appendTo('body')
			  .html('<div><h3>Remove Application. Yes or No?</h3></div>')
			  .dialog({
			      modal: true, title: 'message', zIndex: 10000, autoOpen: true,
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
		}); //End doc ready
	</script>
	</body>
</html>
