$(document).ready(function() {
    $.noConflict();
    $('#myTable').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "columnDefs": [{
                "targets": "_all",
                className: 'dt-head-center'
            },
            {
                "targets": -1,
                "orderable": false
            }
        ]
    });
});