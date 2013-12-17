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
$featured = '';
$featured = $_GET['featured'];
?>
<h3 id='categories'>Manage CV's</h3>
<div id='jqxWidget' style="font-size: 13px;float:left">
            <div id="jqbutton-wrap" style="margin-left: 10px; float: left;">
<!--
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="addrowbutton" type="button" value="Add New CV" />
                </div>-->

                <div class="jqbutton">
                    <input class="jqxinputbutton" id="deleterowbutton" type="button" value="Delete Selected CV" />
                </div>
<!--
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="updaterowbutton" type="button" value="Update Selected CV" />
                </div>-->

            </div>
    <div id="jqxgrid"></div>
    <div id="selectrowindex"></div>

</div>
<!--FOOTER----------------------------------------->
<?php
include ("footer.php");
?>
<script>
    $(document).ready(function() {
        var featured = '<?php echo $featured;?>';
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
        if(featured == 'true'){
            var url = "incs/db.inc.php?type=cvsfeatured";
        }else{
            var url = "incs/db.inc.php?type=cvs";
        }
        var modUrl = "incs/db.inc.php";
        // prepare the data
        var source = {
        datatype : "json",
        datafields : [{
            name : 'id',
            type : 'int'
        }, {
            name : 'name',
            type : 'string'
        }, {
            name : 'county',
            type : 'string'
        }, {
            name : 'jobtitle',
            type : 'string'
        }, {
            name : 'how',
            type : 'string'
        }, {
            name : 'salary',
            type : 'string'
        }],
        id : 'id',
        url : url,
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            var data = "tbl=cvs&update=true&" + $.param(rowdata);
                $.ajax({
                    dataType: 'json',
                    url: 'http://www.employmenow.co.uk/web/office/' + modUrl,
                    cache: false,
                    data: data,
                    success: function (data, status, xhr) {
                        // update command is executed.
                        console.log(status);
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
            var data = "tbl=cvs&delete=true&" + $.param({id: rowid});
            console.log($.param({id: rowid}));
            $.ajax({
                dataType: 'json',
                url: 'http://www.employmenow.co.uk/web/office/' + modUrl,
                cache: false,
                data: data,
                success: function (data, status, xhr) {
                // delete command is executed.
                    commit(true);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    commit(false);
                }
        });
        },
        sortcolumn : 'name',
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
            selectionmode: 'multiplerows',
            columns : [{
                text : 'ID',
                datafield : 'id',
                editable: false,
                pinned: true,
                width : 50,
            }, {
                text : 'Name',
                datafield : 'name',
                altrows : true,
                width: 210,
            }, {
                text : 'County',
                datafield : 'county',
            }, {
                text : 'Job Title',
                datafield : 'jobtitle',
            }, {
                text : 'Find Us How',
                datafield : 'how',
            }, {
                text : 'Salary',
                datafield : 'salary',
                cellsformat: 'c3',
            }, {
                text: 'Edit',
                //selectionmode: 'none',
                datafield: 'Edit',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Edit";
                  }, buttonclick: function (row) {

                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                     //console.log(selectedrowindex);
                    //if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        location.href='cv_details.php?id=' + id;
                       //}
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
                var datarow = generaterow();
                $("#jqxgrid").jqxGrid('addrow', null, {}, 'last');
            });
            $("#deleterowbutton").bind('click', function () {
                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindexes');
                $.each(selectedrowindex, function(i,val){
                    //TODO multi-delete from below
                    console.log(val);
                });

                var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        $("#jqxgrid").jqxGrid('deleterow', selectedrowindex);
                       }
            });
/*
            $("#updaterowbutton").bind('click', function () {
                var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        $("#jqxgrid").jqxGrid('updaterow', id, data);
                    }

});*/
        //ENd go to details page
    });
</script>