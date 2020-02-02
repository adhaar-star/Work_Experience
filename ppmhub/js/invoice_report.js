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
                    url: 'invoiceverification-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'po_order_number', name: 'po_order_number'},
                    {data: 'purchase_order_item_no', name: 'purchase_order_item_no'},
                    {data: 'total_cost', name: 'total_cost'},
                    {data: 'invoice_value', name: 'invoice_value',searchable: false},
                    {data: 'invoice_value', name: 'invoice_value',searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'posting_date', name: 'posting_date'},
                    {data: 'gr_ir_gl_account', name: 'gr_ir_gl_account'},
                    {data: 'gr_ir_amount', name: 'gr_ir_amount'},
                    {data: 'gr_ir_indicator', name: 'gr_ir_indicator'},
                    {data: 'account_payable_gl', name: 'account_payable_gl'},
                    {data: 'indicator', name: 'indicator'},
                    {data: 'payable', name: 'payable'},
                ]
            });
        }
    });
});