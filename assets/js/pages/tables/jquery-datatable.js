$(function () {

    var admin_datatable = $('.admin-datatable').DataTable({
        dom: 'lBfrtip',
        // 'scrollX': true,
        "autoWidth": true,
        searchHighlight: true,

        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'colvis',
            },

        ],

    });

    // -------------------------------------------------------------------------------

        // Task Datatable
        $('.emp-datatable').DataTable();
    });
