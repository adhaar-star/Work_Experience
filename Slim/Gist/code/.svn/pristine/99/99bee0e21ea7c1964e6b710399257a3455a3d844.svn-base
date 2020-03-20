<?php include_once $this->getPart('/admin/common/header.php'); ?>

<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js "></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js "></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>

<style>
    .user_participants_list th:last-child{
        width: 85px !important;
    }
</style>

<?php include_once $this->getPart('/admin/sideMenu.php'); ?>
<!-- Main Content -->
<div class="admin_page_outer">
    <div class="side-body">
        <div class="admin_header_outer">
            <div class="page_name_heading">
                <h1>Participants of "<?= $session_name; ?>" Session</h1>
            </div>
            <div class="pull-right">
                <div class="text-right right">
                    <a class="btn save-btn" href="<?= $app['base_admin_url']; ?>upcomingSession/" title="Back to Upcoming Sessions">Back to Upcoming Sessions</a>
                    <a class="btn save-btn open_add_user_modal" href="javascript:void(0);" title="Add User">Add User</a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12 user_view">
                <div class="white-box user_id">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered participantTable user_data_list user_participants_list" id="participant_table">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>User Type</th>
                                    <th>Contact no.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Approved Participant</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to approve this participant?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="change_approval">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unApproveUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Un-approved Participant</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please give the reason below for un-approving participant.</div>
                <textarea class="form-control" rows="4" cols="50" id="admin_reason"></textarea>
                <div id="reason_error" style="display: none;color: red;">Please enter the valid reason.</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="change_to_unapproval">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="moderator" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Confirmation!</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to set this user as moderator?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="set_moderator">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg model_border">
        <div class="modal-content">
            <div class="modal-header modal_view_border">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <h4 class="modal-title custom_align">Add Users</h4>
            </div>
            <form id="add_user_form" name="add_user_form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-both">
                            <div class="new-user users_popup">
                                <div class="col-md-6 col-sm-6 col-xs-12 col_popup">
                                    <label class="drop_icon">
                                        Users:</label>
                                    <div class="form-group userSelect user_pop "><i class="fa fa-caret-down icon_down" style="font-size:20px; color:#7f7f7f;"></i>
                                        <select id="userListId" name="userListId" class="form-control" multiple="multiple"> 
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="submit" name="add_user_submit" id="add_user_submit" class="btn btn-default save-btn session_submit" title="Add">Add</button>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-default save-btn session_submit cancel_bttn" title="Cancel">Cancel</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!--For Delete Users Starts-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Delete User</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete user from the session?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="delete_user">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
            </div>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--For Delete Users Ends-->
<script>
    //for navigation
    $(function () {
        $('.navbar-toggle').click(function () {
            $('.navbar-nav').toggleClass('slide-in');
            $('.side-body').toggleClass('body-slide-in');
            $('#search').removeClass('in').addClass('collapse').slideUp(200);
        });

        // Remove menu for searching
        $('#search-trigger').click(function () {
            $('.navbar-nav').removeClass('slide-in');
            $('.side-body').removeClass('body-slide-in');

        });
        
        $(document).on('click', '.icon_down', function(){
            $('.select2-search__field').trigger('click');
        });
        
        // validate add user form
        $('#add_user_form').validate({
            rules: {
                userListId: {
                    required: true
                }
            },
            messages: {
                userListId: {
                    required: 'Please select users.'
                }
            },
            submitHandler: function () {
                var data = {};
                data.body = {users: $('#userListId').val(), session_id: '<?= $session_id; ?>'};
                $('#add_user_submit').attr('disabled', true);
                $(".loader").show(); // show loader
                $.when(addUsersToSesson(data)).then(function (data) {
                    $(".loader").hide();
                    if (data.meta.success) { // the action is in success

                        $('#participant_table').DataTable().ajax.reload();

                        $('#addUserModal').modal('hide');
                        $('#add_user_submit').attr('disabled', false);
                        toastr.success(data.data.message);
                    }
                });
            }
        });
    });
    
    // modal on hide 
    $('#addUserModal').on('hidden.bs.modal', function () {
        $('label.error').text(''); // hide error
        $('#userListId').val(''); // reset form fields
    });

    // Open add user modal
    $(document).on('click', '.open_add_user_modal', function () {
        get_user_list();
    });

    // Open delete user modal
    $(document).on('click', '.participtant_delete', function () {
        $('#deleteModal').modal('show');
        participant_id = $(this).attr('data-id');
    });

    // Delete participtant from session
    $(document).on('click', '#delete_user', function () {

        var data = {};
        data.body = {participant_id: participant_id, session_id: '<?= $session_id; ?>'};
        $(".loader").show(); // show loader
        $.when(deleteUserFromSesson(data)).then(function (data) {
            $(".loader").hide();
            if (data.meta.success) { // the action is in success

                $('#deleteModal').modal('hide');

                $('#participant_table').DataTable().ajax.reload();

                toastr.success(data.data.message);
            }
        });
    });

    //accordin
    $(document).ready(function () {
        /*
         * get the user data using datatables
         * @author Loveleen 
         * @date 11 Jan, 2018
         * @return user data in table
         */
        $('#participant_table').DataTable({
            "order": [[0, "desc"]],
            "aLengthMenu": [10, 20, 30, 50],
            "pageLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "columnDefs": [
                {"orderable": false, "targets": [6]}
            ],
            "language": {
                "emptyTable": "No participant avaialble."
            },
            "sAjaxSource": Data.base_url + "admin/participantDetail/<?= $session_id ?>",
        });


        var row_count = $('#participant_table tr').length;
        if (row_count == '2') { // no record present
            $("#no_record").show();
        }
        /**
         * open the user approval dialoge box
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('body').on('click', '.active_deactive', function () {
            table_id = $(this).data('table_id'); // participant id
            field_to_be_deleted = $(this).data('user_id'); // set the user id
            $('#delete').modal('show');
        });

        /**
         * open the user un-approval dialoge box
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('body').on('click', '.unapproval', function () {
            $("#reason_error").hide(); // hide error msg
            table_id = $(this).data('table_id'); // participant id
            field_to_be_deleted = $(this).data('user_id'); // set the user id
            $('#unApproveUser').modal('show');
        });

        /**
         * set the moderator
         * @author Loveleen 
         * @date 24 Jan, 2018
         */
        $('body').on('click', '.setModerator', function () {
            table_id = $(this).data('table_id'); // participant id
            moderator_to_be_set = $(this).data('moderator_id'); // set the user id
            $('#moderator').modal('show');
        });

        /**
         * change approval
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('body').on('click', '#change_approval', function () {
            $('#delete').modal('hide');
            if (field_to_be_deleted !== '' && table_id !== '') { // if user id is set
                changeApprovalAndSetModerator(field_to_be_deleted, table_id, 'changeApproval', ''); // call function for user approval
                table_id = ''; // empty partcipant id
                field_to_be_deleted = '';
            }
        });

        /**
         * change participant to un-approval
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('body').on('click', '#change_to_unapproval', function () {
            if (field_to_be_deleted !== '' && table_id !== '') { // if user id is set
                var reason = $("#admin_reason").val();
                if (reason === '') { // reason not empty
                    $("#reason_error").show();
                    return false;
                }
                $('#unApproveUser').modal('hide');
                changeApprovalAndSetModerator(field_to_be_deleted, table_id, 'changeApproval', reason); // call function for user approval
                table_id = ''; // empty partcipant id
                field_to_be_deleted = '';
            }
        });

        /**
         * set the user as moderator
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('body').on('click', '#set_moderator', function () {
            $('#moderator').modal('hide');
            if (moderator_to_be_set !== '' && table_id !== '') { // if user id is set
                changeApprovalAndSetModerator(moderator_to_be_set, table_id, 'setModerator', ''); // call function to set moderator
                table_id = ''; // empty partcipant id
            }
        });
    });

    /*
     * function for approving user record in session participant or for seting the moderator
     * @author Loveleen 
     * @date 12 Jan, 2018
     * @return reload the page
     */
    function changeApprovalAndSetModerator(id, table_id, action, reason) {
        var data = {};
        data.body = {'user_id': id, 'participant_id': table_id, 'action': action, 'session_id': '<?= $session_id ?>', 'reason': reason};
        $(".loader").show(); // show loader
        $.when(delAndSetModeratorUser(data)).then(function (data) {
            $(".loader").hide();
            if (data.meta.success) { // the action is in success
                $('#participant_table').DataTable().ajax.reload();
                var msg = data.data.message;
                if (msg == 'Participant approved successfully.' || msg == 'Moderator set successfully.') {
                    toastr.success(msg);
                } else if (msg == 'Participant un-approved successfully.') {
                    toastr.error(msg);
                } else {
                    toastr.warning(msg);
                }
            }
        });
    }

    // Get uswr list
    function get_user_list() {
        var data = {};
        data.body = {method: 'getUserList', session_id: '<?= $session_id; ?>'};
        $(".loader").show(); // show loader
        $.when(getUserList(data)).then(function (data) {
            $(".loader").hide();
            if (data.meta.success) { // the action is in success

                $('#userListId').select2({
                    data: data.data.users,
                    placeholder: "Select Users",
//                    allowClear: true,
                    closeOnSelect: false,
                    width: '100%',
                    templateSelection: formatState,
                    templateResult: formatState1,
                });

                $('#addUserModal').modal('show');
            }
        });
    }

    function formatState1(user) {

        return user.first_name + ' ' + user.last_name + ' | ' + user.user_type + ' | ' + user.email + ' | ' + user.country_name + ' | +' + user.phone_code + ' ' + user.phone_number;
    }

    function formatState(user) {

        return user.first_name + ' ' + user.last_name;
    }

</script>
<div class="loader_img-outer loader" style="display:none;">
    <div class="loader_img">
        <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
