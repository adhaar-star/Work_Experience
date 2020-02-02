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
                    url: 'portfolioReport-data?'+$(this).serialize(),
                },
                columns: [
                    {data: 'project_Id', name: 'project_Id'},
                    {data: 'project_desc', name: 'project_desc'},
                    {data: 'buckets_ID', name: 'buckets_ID'},
                    {data: 'bucket_name', name: 'bucket_name'},
                    {data: 'portfolio_id', name: 'portfolio_id'},
                    {data: 'portfolio_name', name: 'portfolio_name'},
                ]
            });
        }
    });
});