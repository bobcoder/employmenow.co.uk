/**
 * @author Robert E Broomfield
 */
    $(function() {//On doc ready

        var url = "incs/get_top10_cvs.php";
        var theme = getDemoTheme();
        var candidates_top10_source =
            {
                datatype: "json",
                datafields: [{
                    name: 'name',
                    type: 'string'
                    },{
                    name: 'email',
                    type: 'string'
                    },{
                    name: 'mobile',
                    type: 'string'
                    },{
                    name: 'town',
                    type: 'string'
                    },{
                    name: 'county',
                    type: 'string'
                    },{
                    name: 'views',
                    type: 'int'
                    }],
                id: 'id',
                url: url
            };

            var candidates_top10_dataAdapter = new $.jqx.dataAdapter(candidates_top10_source, {
                downloadComplete: function (data, status, xhr) { console.log(data);},
                loadComplete: function (data) { },
                loadError: function (xhr, status, error) {console.log(error); }
            });
            // initialize jqxGrid
            $("#jqxgrid_top10").jqxGrid(
            {
                width: 970,
                source: candidates_top10_dataAdapter,
                theme: theme,
                pageable: true,
                autoheight: true,
                sortable: true,
                altrows: true,
                columns: [
                  { text: 'Name', datafield: 'name', width: 150 },
                  { text: 'Email', datafield: 'email', width: 250 },
                  { text: 'Mobile', datafield: 'mobile', width: 150 },
                  { text: 'Town', datafield: 'town', width: 150 },
                  { text: 'County', datafield: 'county', width: 150 },
                  { text: 'Views', datafield: 'views'}
                ]
            });
    });