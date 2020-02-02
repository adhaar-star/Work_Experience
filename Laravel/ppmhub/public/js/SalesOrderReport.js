$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: false,
        bDestroy: true
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'salesOrder-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'planned_cost', name: 'planned_cost'},
                    {data: 'actual_cost', name: 'actual_cost'},
                    {data: 'planned_revenue', name: 'planned_revenue'},
                    {data: 'actual_revenue', name: 'actual_revenue',searchable: false},
                    {data: 'salesorder_number', name: 'salesorder_number'},
                    {data: 'status', name: 'status',searchable: false},
                    {data: 'customer_phone_no', name: 'customer_phone_no'},
                    
                ]
            });
        }
    });
});