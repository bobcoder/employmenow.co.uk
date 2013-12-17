/**
 * @author Robert E Broomfield
 */
    $(function() {//On doc ready
        console.log("ready");
        var url = "inc/get_jobs.php";
        var theme = getDemoTheme();
        var employers_source =
            {
                datatype: "json",
                datafields: [
                    { name: 'ProductName', type: 'string' }
                ],
                id: 'ProductID',
                url: url
            };

            var employers_dataAdapter = new $.jqx.dataAdapter(employers_source, {
                downloadComplete: function (data, status, xhr) { },
                loadComplete: function (data) { },
                loadError: function (xhr, status, error) { }
            });
            // initialize jqxGrid
            $("#jqxgrid_employers").jqxGrid(
            {
                width: 970,
                source: employers_dataAdapter,
                theme: theme,
                pageable: true,
                autoheight: true,
                sortable: true,
                altrows: true,
                columns: [
                  { text: 'Product Name', columngroup: 'ProductDetails', datafield: 'ProductName', width: 250 }
                ]
            });
    });