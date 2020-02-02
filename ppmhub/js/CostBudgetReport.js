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
                    url: 'costBudget-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_PID', name: 'project_PID'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'planned_cost', name: 'planned_cost'},
                    {data: 'actual_cost', name: 'actual_cost'},
                    {data: 'budget_org_overall', name: 'budget_org_overall'},
                    {data: 'available_budget', name: 'available_budget',searchable: false},
                    {data: 'p_start_date', name: 'p_start_date',searchable: false},
                    {data: 'p_end_date', name: 'p_end_date',searchable: false},
                ]
            });
        }
    });
});