u$(document).ready(function () {
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
                    url: 'taskdetail-data?'+$(this).serialize(),
                },
               columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'project_phase_id', name: 'project_phase_id'},
                    {data: 'phase_name', name: 'phase_name'},
                    {data: 'task_Id', name: 'task_Id'},
                    {data: 'task_name', name: 'task_name'},
                    {data: 'start_date', name: 'start_date', searchable: false},
                    {data: 'end_date', name: 'end_date', searchable: false},
                    {data: 'completion', name: 'completion'},
                    {data: 'duration', name: 'duration'},
                    {data: 'firstName', name: 'firstName'},
                    {data: 'task_sub_status', name: 'task_sub_status'},
                ]
            });
        }
    });
});