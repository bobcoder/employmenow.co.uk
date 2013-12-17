<?php
require_once ("header.php");
if ($_SESSION['username'] == '') {
    header('location: login.php');
    $logout = "Log In";
}
?>
<h3 id='categories'>Job Industries</h3>
<div id='jqxWidget' style="font-size: 13px;float:left">
            <div id="jqbutton-wrap" style="margin-left: 10px; float: left;">
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="addrowbutton" type="button" value="Add New Industry" />
                </div>
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="deleterowbutton" type="button" value="Delete Selected Industry" />
                </div>
<!--
                <div class="jqbutton">
                    <input class="jqxinputbutton" id="updaterowbutton" type="button" value="Update Selected Industry" />
                </div>-->

            </div>
    <div id="jqxgrid"></div>
    <div id="selectrowindex"></div>

</div>
<div id="dialog" title="Add Industry">
    <form id="formindustry" name="formindustry">
  <p><input type="text" id="industry" name="industry" size="40"/></p>
  </form>
</div>
<!--FOOTER----------------------------------------->
<?php
include ("footer.php");
?>
<script>
    $(document).ready(function() {
        var data = {};
        var generaterow = function (id) {
            var row = {};
            row["ID"] = id;
            row["Industry"] = null;
            return row;
        }//ENd generate row
        //Get and display data from json
        var theme = getDemoTheme();
        //URL to get json data
        var url = "incs/db.inc.php?type=industries";
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
        }],
        id : 'id',
        url : url,
        addrow: function (rowid, rowdata, position, commit) {
            commit(true);
        },
        updaterow: function (rowid, rowdata, commit) {
            // synchronize with the server - send update command
            var data = "tbl=industries&update=true&" + $.param(rowdata);
            console.log(rowdata);
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
                        console.log(textstatus);
                        commit(false);
                    }
                });
        },
        deleterow: function (rowid, commit) {
            var data = "tbl=industries&delete=true&" + $.param({id: rowid});
            $.ajax({
                dataType: 'json',
                url: 'http://www.employmenow.co.uk/web/office/' + modUrl,
                cache: false,
                data: data,
                success: function (data, status, xhr) {
                    $("#jqxgrid").jqxGrid('clearselection');
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
            pagesizeoptions: ['10', '30', '40', '50','100', '200'],
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
                width : 50,
            }, {
                text : 'Industry',
                datafield : 'name',
            }]
        });
        //ENd display grid
            $("#addrowbutton").jqxButton({ theme: theme });
            $("#deleterowbutton").jqxButton({ theme: theme });
            $("#updaterowbutton").jqxButton({ theme: theme });
        // Go to details page
            $("#addrowbutton").bind('click', function () {
                var industry = $( "#industry" )
                $( "#dialog" ).dialog({
                    modal: true,
                    width: 380,
                    buttons: {
                            "Add Industry": function() {
                            var dataToSend = $("#industry").val();
                            $.ajax({
                                type: "POST",
                                dataType: 'json',
                                url: 'job_add_db.php?action=addIndustry',
                                cache: false,
                                data: { industry: dataToSend },
                                success: function (data, status, xhr) {
                                    //$('#jqxgrid').trigger( 'reloadGrid' );
                                    $("#jqxgrid").jqxGrid('updatebounddata', 'cells');

                                },
                                    error: function(jqXHR, textStatus, errorThrown)
                                {
                                    console.log(textStatus);
                                }
                            });
                             $( this ).dialog( "close" );
                            },
                             Cancel: function() {
                             $( this ).dialog( "close" );
                            }
                          }
                });
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