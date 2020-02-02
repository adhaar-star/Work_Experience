$(document).ready(function () {
        var table = $('#DateTablePPMHUB').DataTable();

        $('#DateTablePPMHUB').on('click', '#modal_popup', function () {
            console.log(this);
            var pId = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val();
                    $.ajax({
                       method: 'POST', 
                       url: 'projectData/ajaxrequest', 
                       data: {
                           'id': pId,
                           '_token': _token
                       }, 
                       success: function (response) {
                           $('#breadCrumPId').html(response.data.project_Id);
                           $('#projectId').html(response.data.project_Id);
                           $('#projectName').html(response.data.project_name);
                           $('#projectType').html(response.data.project_type_name);
                           $('#projectDesc').html(response.data.project_desc);
                           $('#portName').html(response.data.portfolio_name);
                           $('#portId').html(response.data.portfolio_id);
                           $('#portType').html(response.data.portfolio_type);
                           $('#bucketName').html(response.data.bucket_name);
                           $('#bucketId').html(response.data.buck_id);
                           $('#prjLocation').html(response.data.location);
                           $('#costCentre').html(response.data.cost_centre_name);
                           $('#departmentName').html(response.data.department_name);
                           $('#pstartDate').html(response.data.pr_start_date);
                           $('#pendDate').html(response.data.pr_end_date);
                           $('#actualSdate').html(response.data.a_start_date);
                           $('#actualEdate').html(response.data.a_end_date);
                           $('#foreSdata').html(response.data.f_start_date);
                           $('#foreEdata').html(response.data.f_end_date);
                           $('#schedDate').html(response.data.sch_date);
                           $('#plannedSdate').html(response.data.p_start_date);
                           $('#plannedEdate').html(response.data.p_end_date);
                           $('#createdOn').html(response.data.created_at);
                           $('#createdBy').html(response.data.createt_by_role_name);
                           $('#statusP').html(response.data.statusP);

                       },
                       error: function (jqXHR, textStatus, errorThrown) { // What to do if we fail
                           console.log(JSON.stringify(jqXHR));
                           console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                       }
                   });
        });
});