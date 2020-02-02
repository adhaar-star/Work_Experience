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
                    url: 'goodsReceiptReport-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'purchase_order_number', name: 'purchase_order_number'},
                    {data: 'item_no', name: 'item_no'},
                    {data: 'total_value', name: 'total_value'},
                    {data: 'gr_cost', name: 'gr_cost',searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'posting_date', name: 'posting_date',searchable: false},
                    {data: 'dr_cr_indicator', name: 'dr_cr_indicator'},
                    {data: 'item_cost', name: 'item_cost'},
                    {data: 'quantity_received', name: 'quantity_received'},
                    {data: 'gl_account_number', name: 'gl_account_number'},
                    {data: 'cost_centre', name: 'cost_centre'},
                ]
            });
        }
    });
});