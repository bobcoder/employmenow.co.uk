<?php
ob_start();
require_once("header.php");
session_start();
if($_SESSION['loggedIn'] != 'true'){
    $logout = "Log In";
    header('location: login.php');
    exit();
}else{
    //Do summat
}
?>
<h3 id='categories'>Employers</h3>
	<div id='jqxWidget' style="font-size: 13px;float:left">
            <div id="jqbutton-wrap" style="margin-left: 10px; float: left;">
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="addrowbutton" type="button" value="Add New Employer" />
                </div>
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="deleterowbutton" type="button" value="Delete Selected Employer/s" />
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
        //Get and display data from json
        var theme = getDemoTheme();
        //URL to get json data
        var url = "incs/db.inc.php?type=employers";
        var modUrl = "incs/db.inc.php";
        //GRID start
        // prepare the data
        var source = {
        datatype : "json",
        datafields : [{
            name : 'id',
            type : 'int'
        }, {
            name : 'companyname',
            type : 'string'
        }, {
            name : 'name',
            type : 'string'
        }, {
            name : 'telephone',
            type : 'string'
        }, {
            name : 'email',
            type : 'string'
        }, {
            name : 'regdate',
            type : 'date'
        }, {
            name : 'approved',
            type : 'bool',
        }],
        id : 'id',
        url : url,
        deleterow: function (rowid, commit) {
            var data = "tbl=employers&delete=true&" + $.param({id: rowid});
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
        sortcolumn : 'companyname',
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
            //editmode: 'Double-Click',
            columnsresize : false,
            filterable : true,
            sortable : false,
            altrows : true,
            //selectionmode: 'singlerow',
            columns : [{
                text : 'ID',
                datafield : 'id',
                editable: false,
                pinned: true,
                width : 50,
            }, {
                text : 'Company',
                datafield : 'companyname',
                altrows : true,
                width: 190,
            }, {
                text : 'Contact',
                datafield : 'name',
                width:110,
            },{
                text : 'Telephone',
                datafield : 'telephone',
                width: 110,
            }, {
                text : 'Email',
                datafield : 'email',
            }, {
                text : 'Date Registered',
                datafield : 'regdate',
                cellsformat: 'dd-MM-yyyy',
                width: 95,
            },{
                text : 'Approved',
                datafield : 'approved',
                columntype: 'checkbox',
                threestatecheckbox: false,
                width:50,
            },{
                text: 'Edit',
                width : 70,
                selectionmode: 'none',
                datafield: 'Edit',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Edit";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 ) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        location.href='employer_update.php?action=updateemployer&id=' + id;
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                     //console.log(id);
                 }
                 }]
        });
	        //ENd display grid
            $("#addrowbutton").jqxButton({ theme: theme });
            $("#deleterowbutton").jqxButton({ theme: theme });
        // Go to details page
            $("#addrowbutton").bind('click', function () {
                location.href='employer_new.php';
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
    });//ENd doc ready
</script>