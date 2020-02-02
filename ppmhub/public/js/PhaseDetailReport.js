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
                    url: 'phaseDetail-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'phase_Id', name: 'phase_Id'},
                    {data: 'phase_name', name: 'phase_name'},
                    {data: 'portfolio_id', name: 'portfolio_id'},
                    {data: 'portfolio_name', name: 'portfolio_name'},
                    {data: 'bucket_ID', name: 'bucket_ID',searchable: false},
                    {data: 'bucket_name', name: 'bucket_name',searchable: false},
                    {data: 'costcentre_name', name: 'costcentre_name',searchable: false},
                    {data: 'responsible_person', name: 'responsible_person',searchable: false},
                    {data: 'department_name', name: 'department_name',searchable: false},
                    {data: 'created_date', name: 'created_date',searchable: false},
                    {data: 'start_date', name: 'start_date',searchable: false},
                    {data: 'end_date', name: 'end_date',searchable: false},
                    {data: 'status', name: 'status',searchable: false},
                ]
            });
        }
    });
});