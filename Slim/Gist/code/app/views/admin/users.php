<?php include_once $this->getPart('/admin/common/header.php'); ?> 
<body>
    <link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">
    <script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js "></script>
    <script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
    <script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js "></script>
    
    <style>
        .tooltip .tooltip-inner {
            max-width: 40em;
            white-space: normal;
            word-wrap: break-word;
        }
    </style>

    <?php include_once $this->getPart('/admin/sideMenu.php'); ?> 
    <!-- Main Content -->
    <div class="side-body users_list">
        <div class="admin_header_outer">
            <div class="page_name_heading">
                <h1>Users</h1>
            </div>
        </div>

        <table id="example" class="table table-striped table-bordered users usersTable users_data">
            <thead>
                <tr class="users_heading">
                    <th>Id</th>
                    <th>Name</th>
                    <th>UserName</th>
                    <th>User Type</th>
                    <th>Moderator Status</th>
                    <th>Moderator Reason</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Phone No.</th>
                    <th>Diagnosis</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
    <!--For Delete Users Starts-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Delete User</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete this user?</div>
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

    <!--For active/inactive Users Starts-->
    <div class="modal fade" id="active_deactive_user" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Activate / Deactivate</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to change the user status?</div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" id="change_status">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--For active/inactive Users Ends-->

    <div class="modal fade" id="approveModeratorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Approved as a Moderator</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to approve this user as a Moderator ?</div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" id="change_approval">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unApproveModeratorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align">Un-approved as a Moderator</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Please give the reason below for un-approving as a Moderator.</div>
                    <textarea class="form-control" rows="4" cols="50" id="unapprove_reason"></textarea>
                    <div id="reason_error" style="display: none;color: red;">Please enter the valid reason.</div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-success" id="change_to_unapproval">Ok</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <div class="loader_img-outer loader" style="display:none;">
        <div class="loader_img">
            <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
        </div>
    </div>

    <script>
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
        });

        /**
         * open the user approval dialoge box
         * @author Raman 
         * @date 29 Oct, 2018
         */
        $('body').on('click', '.approval_moderator', function () {
            moderator_user_id = $(this).data('user_id'); // set the user id
            $('#approveModeratorModal').modal('show');
        });

        /**
         * open the user un-approval dialoge box
         * @author Raman 
         * @date 29 Oct, 2018
         */
        $('body').on('click', '.unapproval_moderator', function () {
            $("#reason_error").hide(); // hide error msg
            moderator_user_id = $(this).data('user_id'); // set the user id
            $('#unApproveModeratorModal').modal('show');
        });


        /**
         * change approval
         * @author Raman 
         * @date 29 Oct, 2018
         */
        $('body').on('click', '#change_approval', function () {
            $('#approveModeratorModal').modal('hide');
            if (moderator_user_id !== '') { // if user id is set
                approveUnapproveModerator(moderator_user_id, 'approve');
            }
        });
        
        /**
         * change unapproval
         * @author Raman 
         * @date 29 Oct, 2018
         */
        $('body').on('click', '#change_to_unapproval', function () {
            
            if (moderator_user_id !== '') { // if user id is set
                
                var reason = $("#unapprove_reason").val();
                if (reason === '') { // reason not empty
                    $("#reason_error").show();
                    $("#unapprove_reason").focus();
                    return false;
                }
                
                $('#unApproveModeratorModal').modal('hide');
                approveUnapproveModerator(moderator_user_id, 'unapprove');
            }
        });

        $(document).ready(function () {

            /*
             * get the user data using datatables
             * @author Loveleen 
             * @date 11 Jan, 2018
             * @return user data in table
             */
            $('.usersTable').DataTable({
                "order": [[1, "asc"]],
                "aLengthMenu": [10, 20, 30, 50],
                "pageLength": 10,
                "bProcessing": true,
                "bServerSide": true,
                "columnDefs": [
                    {"orderable": false, "targets": [11]}
                ],
                "language": {
                    "emptyTable": "No user avaialble."
                },
                "sAjaxSource": Data.base_url + "admin/userDetail/",
            });

            // Tooltip in bootstrap for datatables
            $('.usersTable').on('draw.dt', function () {
                $('[data-toggle="tooltip"]').tooltip();
            });

            /*
             * for opening user delete dialogbox 
             * @author Loveleen 
             * @date 11 Jan, 2018
             */

            $('body').on('click', '.delete', function () {
                // set the user id which is needed to be deleted
                field_to_be_deleted = $(this).attr('id');
                $('#delete').modal('show');
            });

            /*
             * activate or deactivate user dialog box open
             * @author Loveleen 
             * @date 11 Jan, 2018
             */
            $('body').on('click', '.active_deactive', function () {
                change_status = $(this).attr('id'); // the user id for activate or deactive
                $('#active_deactive_user').modal('show'); // show modal and ask for status change
            });

            /*
             * delete user account on basis of user id , call the api
             * @author Loveleen 
             * @date 11 Jan, 2018
             */
            $('#delete_user').click(function () {
                $('#delete').modal('hide');
                if (field_to_be_deleted !== '') { // if user id is set
                    deleteAndChangeStatus(field_to_be_deleted, 'delete'); // call function for delete user
                    field_to_be_deleted = '';
                }
            });

            /*
             * change the selected user status , call the api 
             * @author Loveleen 
             * @date 11 Jan, 2018
             */
            $('#change_status').click(function () {
                $('#active_deactive_user').modal('hide');
                if (change_status !== '') { // if user id is set
                    deleteAndChangeStatus(change_status, 'setStatus'); // call function for status update
                    change_status = '';
                }
            });
        });

        /*
         * function for deleting user record or updating user status active/inactive
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        function deleteAndChangeStatus(id, action) {
            var data = {};
            data.body = {'user_id': id, action: action};
            $(".loader").show(); // show loader
            $.when(delAndSetStatusOfUser(data)).then(function (data) {
                if (data.meta.success) { // the action is in success
                    if (action == 'delete') { // if delete action successfull , show toastr
                        $('.usersTable').DataTable().ajax.reload();
                        setTimeout(function () {
                            $(".loader").hide(); // hide loader
                            toastr.success('User removed successfully.');
                        }, 2000);
                    } else if (action == 'setStatus') { // if activate/deactivate action successfull , show toastr
                        $('.usersTable').DataTable().ajax.reload();
                        setTimeout(function () {
                            $(".loader").hide(); // hide loader
                            toastr.success(data.data.message);
                        }, 2000);
                    }
                }
            });
        }

        function approveUnapproveModerator(user_id, status) {
            var data = {};
            data.body = {user_id: user_id, status: status, unapprove_reason: $('#unapprove_reason').val()};
            $(".loader").show(); // show loader
            $.when(userApproveUnapproveModerator(data)).then(function (data) {
                $(".loader").hide();
                if (data.meta.success) { // the action is in success
                    $('.usersTable').DataTable().ajax.reload();
                    var msg = data.data.message;
                    toastr.success(msg);
                }
            });
        }

    </script>
</body>

</html>
