$(document).ready(function() {
    $.noConflict();
    $('#myTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-MX.json"
        },
        "columnDefs": [{
                "targets": "_all",
                className: 'dt-head-center'
            },
            {
                "targets": "_all",
                className: 'dt-body-center'
            },
            {
                "targets": -1,
                "orderable": false
            }
        ]
    });
});