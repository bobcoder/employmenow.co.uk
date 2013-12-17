<?php
ob_start();
session_start();
require_once("header.php");
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
    //Do summat
}
?>
<h3 id='categories'>Jobs</h3>
	<div id='jqxWidget' style="font-size: 13px;float:left">
            <div id="jqbutton-wrap" style="margin-left: 10px; float: left;">
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="addrowbutton" type="button" value="Add New Job" />
                </div>
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="deleterowbutton" type="button" value="Delete Selected Job/s" />
                </div>
            </div>
    	<div id="jqxgrid"></div>
    	<div id="selectrowindex"></div>
	</div>
<!--FOOTER----------------------------------------->
<?php include("footer.php");?>
<script>
    $(document).ready(function() {
        var data = {};
        var generaterow = function (id) {
            var row = {};
            row["ID"] = id;
            row["name"] = null;
            return row;
        }//ENd generate row
        //Get and display data from json
        var theme = getDemoTheme();
        //URL to get json data
        var url = "incs/db.inc.php?type=jobs";

        var modUrl = "incs/db.inc.php";
        // prepare the data
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
            name : 'region',
            type : 'string'
        }, {
            name : 'date_expires',
            type : 'date',
        }],
        id : 'jobs_id',
        url : url,
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            var data = "tbl=jobs&delete=true&" + $.param(rowdata);
                $.ajax({
                    dataType: 'json',
                    url: 'http://www.employmenow.co.uk/web/office/' + modUrl,
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
                url: 'http://www.employmenow.co.uk/web/office/' + modUrl,
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
        pagesize : 30,
        pager : function(pagenum, pagesize, oldpagenum) {
        // callback called when a page or page size is changed.
        }
        };
        //END source
        var dataAdapter = new $.jqx.dataAdapter(source);
        //Display Grid
        $("#jqxgrid").jqxGrid({
            width : 980,
            source : dataAdapter,
            theme : theme,
            pageable : true,
            pagesizeoptions: ['20', '30', '40', '50','100', '200'],
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
                width : 50,
            }, {
                text : 'Title',
                datafield : 'title',
                altrows : true,
                width: 210,
            }, {
                text : 'Ref',
                datafield : 'ref',
            }, {
                text : 'Region',
                datafield : 'region',
            },{
                text : 'Expires',
                datafield : 'date_expires',
                cellsformat: 'dd-MM-yyyy',
            },{
                text: 'Edit',
                width : 100,
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
                        location.href='job_update.php?action=updatejob&id=' + id;
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                     console.log(id);
                 }
                 }]
        });
        //ENd display grid
            $("#addrowbutton").jqxButton({ theme: theme });
            $("#deleterowbutton").jqxButton({ theme: theme });
            $("#updaterowbutton").jqxButton({ theme: theme });
        // Go to details page
            $("#addrowbutton").bind('click', function () {
                location.href='job_new.php';
            });
            $("#deleterowbutton").bind('click', function () {
                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        $("#jqxgrid").jqxGrid('deleterow', id);
                       }
            });
        //ENd go to details page
    });
</script>