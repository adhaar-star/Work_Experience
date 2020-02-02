$(document).ready(function () {
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: 'milestone-data',
    });
    $(".reportClass").submit(function (e) {
        if ($(".reportClass").valid()) {
            console.log('form data', $(this).serialize());
            var table = $("#DateTablePPMHUB").DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    url: 'milestone-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'phase_Id', name: 'phase_Id'},
                    {data: 'task_Id', name: 'task_Id'},
                    {data: 'milestone_Id', name: 'milestone_Id'},
                    {data: 'milestone_name', name: 'milestone_name'},
                    {data: 'schedule_date', name: 'schedule_date', searchable: false},
                    {data: 'actual_date', name: 'actual_date', searchable: false},
                ]
            });
        }
    });
});