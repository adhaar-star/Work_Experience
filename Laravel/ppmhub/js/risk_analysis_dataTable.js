$(document).ready(function () {
    if ($(".myalert").is(':visible')) {
        $('.myalert').show(0).delay(5000).hide(1000);
    }
    var table = $("#DateTablePPMHUB").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: {
            url: '/admin/risk-managment-datatable',
        }, createdRow: function (row, data, dataIndex) {
            $(row).find('td:eq(5)').attr('style', 'text-align:center');
            $(row).find('td:eq(6)').attr('style', 'text-align:center');
        },
        columns: [
            {data: 'project_id', name: 'project_id'},
            {data: 'qual_risk_id', name: 'qual_risk_id'},
            {data: 'risk_type', name: 'risk_type'},
            {data: 'qual_category', name: 'qual_category'},
            {data: 'qual_status', name: 'qual_status'},
            {data: 'risk_score', name: 'risk_score'},
            {data: 'risk_score_status', name: 'risk_score_status'},
            {data: 'action', name: 'action', searchable: false, "orderable": false},
            {data: 'context', name: 'context', searchable: false, "orderable": false},
        ]
    });
    table.draw();

    $('#DateTablePPMHUB tbody').on('click', '.deleteRisk', function () {
        var id = $(this).attr('data-id');
        var urltype = $(this).attr('data-type');
        var _token = $('_token').val();

        var res = confirm('Are you sure you want to delete this qualitative risk?');
        if (res) {
            if (urltype == "quantitative_risk") {
                urltype = "/admin/quantitative_risk/" + id;
            } else {
                urltype = "/admin/qualitative_risk/" + id;
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "DELETE",
                url: urltype,
                data: {'_token': _token},
                success: function (result) {
                    if (result.status == 'msg')
                    {
                        $('.message').show(0).delay(5000).hide(1000);
                        $('#msg').html(result.data);
                    } else
                    {
                        $('.message1').show(0).delay(5000).hide(1000);
                        $('#msg1').html(result.data);
                    }
                    console.log('here result', result);
                    table.draw();
                }
            });

        }

    });
    $('#DateTablePPMHUB tbody').on('click', '.viewRisk', function () {
        var id = $(this).attr('data-id');
        var urltype = $(this).attr('data-type');
        var url = $(this).attr('data-type');


        if (urltype == "quantitative_risk") {
            urltype = "/admin/quantitative_risk/" + id;
        } else {
            urltype = "/admin/qualitative_risk/" + id;
        }

        var _token = $('_token').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: urltype,
            data: {'_token': _token},
            success: function (r) {
                if (url == "quantitative_risk") {
                    $("#table-view-popup_quan").modal("show");
                    $("#brquan_risk_id").text(r.data.quan_risk_id);
                    $("#quan_risk_id").text(r.data.quan_risk_id);
                    $("#project_id").html(r.data.project_id);

                    var categ = r.data.quan_category;
                    if (categ === 1) {
                        $("#quan_category").html("Supplier risk");
                    }
                    else if (categ === 2)
                    {
                        $("#quan_category").html("Technology risk");
                    } else if (categ === 3)
                    {
                        $("#quan_category").html("Infrastructure risk");
                    } else if (categ === 4)
                    {
                        $("#quan_category").html("Government Policy risk");
                    } else
                    {
                        $("#quan_category").html("Resource risk");
                    }
                    $("#quan_risk_desc").html(r.data.quan_risk_desc);
                    $("#quan_probability").html(r.data.quan_probability);
                    $("#short_code").html(r.data.short_code);
                    $("#quan_total_loss").html(r.data.quan_total_loss);
                    $("#risk_mitigation_action").html(r.data.risk_mitigation_action);
                    $("#status").html(r.data.status);
                    $("#quan_expected_loss").html(r.data.quan_expected_loss);
                    $("#quan_risk_score").html(r.data.quan_risk_score);
                    $("#createdOn").html(r.data.created_on);
                    $("#createdBy").html(r.data.created_by);
                    $("#changeOn").html(r.data.changed_by);
                    $("#popupEdit").attr("href", '/admin/' + url + '/' + id + '/edit');
                }
                else {
                    $("#table-view-popup").modal("show");
                    $("#brqual_risk_id").text(r.data.qual_risk_id);
                    $("#qual_project_id").html(r.data.project_id);
                    $("#qual_risk_id").html(r.data.qual_risk_id);
                    var categ = r.data.qual_category;
                    if (categ === 1) {
                        $("#qual_category").html("Supplier risk");
                    }
                    else if (categ === 2)
                    {
                        $("#qual_category").html("Technology risk");
                    } else if (categ === 3)
                    {
                        $("#qual_category").html("Infrastructure risk");
                    } else if (categ === 4)
                    {
                        $("#qual_category").html("Government Policy risk");
                    } else
                    {
                        $("#qual_category").html("Resource risk");
                    }
//                      $("#qual_category").html(r.data.qual_category);
                    $("#qual_risk_desc").html(r.data.qual_risk_desc);
                    $("#qual_likelihood").html(r.data.qual_likelihood);
                    $("#qual_consequence").html(r.data.qual_consequence);
                    $("#risk_score").html(r.data.risk_score);
                    $("#qual_risk_mitigation_action").html(r.data.risk_mitigation_action);
                    $("#qual_createdOn").html(r.data.qual_createdon);
                    $("#qual_createdBy").html(r.data.qual_createdby);

                    $("#qual_changedOn").html(r.data.qual_updatedon);
                    $("#qual_changedBy").html(r.data.qual_changedby);

                    $("#qual_status").html(r.data.qual_status);
                    $("#qual_popupEdit").attr("href", '/admin/' + url + '/' + id + '/edit');


                }
                console.log('here result', r.data);
            }
        });
    });
});

