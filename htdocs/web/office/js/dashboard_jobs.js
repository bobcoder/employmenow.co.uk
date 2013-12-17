/**
 * @author Robert E Broomfield
 */
    $(function() {//On doc ready
        var url = "incs/get_unapproved_jobs.php";
        var theme = getDemoTheme();
        var source =
            {
                datatype: "json",
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
                        type : 'date'
                    }],
                id: 'jobs_id',
                url: url,
                updaterow: function (rowid, rowdata, commit) {
                    // synchronize with the server - send update command
                    var data = $.param({jobid: rowid});
                        $.ajax({
                            dataType: 'text',
                            type: 'post',
                            url: 'incs/approve_jobs.php',
                            cache: false,
                            data: data,
                            success: function (Data, status, xhr) {
                                commit(true);
                            },
                            error: function(jqXHR, textStatus, errorThrown)
                            {
                                console.log(textStatus);
                                commit(false);
                            }
                        });
                },
            };

            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
            {
                width: 970,
                source: dataAdapter,
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
                    width : 90,
                    selectionmode: 'none',
                    datafield: 'View',
                    columntype: 'button',
                    cellsrenderer: function () {
                     return "View";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                     var datajson2 = $('#jqxgrid').jqxGrid('getrowdata', selectedrowindex);
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        //Redirect to view page
                        //document.location.href='view.php?id=' + datajson2.userId + '&jview=true&cvid=' + datajson2.app_id;
                        location.href='job_update.php?action=updatejob&id=' + id;
                        }
                        $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                  }
                },{
                text: '',
                width : 100,
                selectionmode: 'none',
                datafield: 'Approve',
                columntype: 'button',
                cellsrenderer: function () {
                     return "Approve";
                  }, buttonclick: function (row) {
                     var selectedrowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                     var rowscount = $("#jqxgrid").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) {
                        var id = $("#jqxgrid").jqxGrid('getrowid', selectedrowindex);
                        $("#jqxgrid").jqxGrid('updaterow', id, '{test: rob}');
                       }
                       $('#jqxgrid').jqxGrid('unselectrow', selectedrowindex);
                     //console.log(id);
                 }
                 }]
            });
    });