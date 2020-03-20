<?php include_once $this->getPart('/admin/common/header.php'); ?>

<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js "></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js "></script>

<?php include_once $this->getPart('/admin/sideMenu.php'); ?>
<!-- Main Content -->
<div class="admin_page_outer">
    <div class="side-body">
        <div class="admin_header_outer">
            <div class="page_name_heading">
                <h1>Participants of "<?= $session_name; ?>" Session</h1>
            </div>
            <div class="pull-right">
                <div class="text-right right"><a class="btn save-btn" href="<?= $app['base_admin_url']; ?>upcomingSession/" title="Back">Back</a></div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="participant_table">
                            <thead class="detail_inner">
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Contact no.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="no_record" style="display:none">
                                    <td colspan="6" style="text-align: center;">No participant found.</td>
                                </tr>
                                <?php
//                                echo "<pre>"; print_r($is_moderator_set);die;
                                foreach ($user_data as $key => $value) {
                                    ?>
                                    <tr data-row_id = "<?= $value['user_id'] ?>" >
                                        <td>
                                            <?= $value['user_id']; ?>
                                        </td>
                                        <td>
                                            <?= $value['first_name'] . ' ' . $value['last_name']; ?>
                                        </td>
                                        <td >
                                            <?= $value['email']; ?>
                                        </td>
                                        <td >
                                            <?= $value['username']; ?>
                                        </td>
                                        <td>
                                            <?= '+' . $value['phone_code'] . '-' . $value['phone_number'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>

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
                <h4 class="modal-title custom_align">Delete User</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete this user?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="delete_user">Ok</button>
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
    });


    //accordin
    $(document).ready(function () {
        var row_count = $('#participant_table tr').length;
        if (row_count == '2') { // no record
            $("#no_record").show();
        }
        /**
         * open the user delete dialoge box
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('.delete').click(function () {
            table_id = $(this).data('table_id'); // participant id
            field_to_be_deleted = $(this).data('user_id'); // set the user id
            $('#delete').modal('show');
        });

        /**
         * set the moderator
         * @author Loveleen 
         * @date 24 Jan, 2018
         */
        $('.setModerator').click(function () {
            table_id = $(this).data('table_id'); // participant id
            moderator_to_be_set = $(this).data('moderator_id'); // set the user id
            $('#moderator').modal('show');
        });

        /**
         * delete the user record
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('#delete_user').click(function () {
            $('#delete').modal('hide');
            if (field_to_be_deleted !== '' && table_id !== '') { // if user id is set
                deleteUserAndSetModerator(field_to_be_deleted, table_id, 'delUser'); // call function for delete user
                table_id = ''; // empty partcipant id
            }
        });

        /**
         * set the user as moderator
         * @author Loveleen 
         * @date 12 Jan, 2018
         */
        $('#set_moderator').click(function () {
            $('#moderator').modal('hide');
            if (moderator_to_be_set !== '' && table_id !== '') { // if user id is set
                deleteUserAndSetModerator(moderator_to_be_set, table_id, 'setModerator'); // call function to set moderator
                table_id = ''; // empty partcipant id
            }
        });
    });

    /*
     * function for deleting user record in session participant or for seting the moderator
     * @author Loveleen 
     * @date 12 Jan, 2018
     * @return reload the page
     */
    function deleteUserAndSetModerator(id, table_id, action) {
        var data = {};
        data.body = {'user_id': id, 'participant_id': table_id, 'action': action, 'session_id': '<?= $session_id ?>'};
        $(".loader").show(); // show loader
        $.when(delAndSetModeratorUser(data)).then(function (data) {
            if (data.meta.success) { // the action is in success
                toastr.success(data.data.message); // show messages
                if (data.data.type === 'delUser') {
                    $("*[data-row_id =" + field_to_be_deleted + "]").remove(); // remove the field to be deleted
                    field_to_be_deleted = ''; // empty the content
                    var rowCount = $('#participant_table tr').length;
                    if (rowCount == '2') {
                        $("#no_record").show();
                    }
                    $(".loader").hide(); // hide loader
                } else {
                    console.log(moderator_to_be_set);
//                    $("*[data-moderator_id =" + moderator_to_be_set + "]").html('Moderator'); // change the button to moderator
                    $("*[data-moderator_id =" + moderator_to_be_set + "]").removeClass('setModerator'); // remove the button class to prevent it from removing
                    $("*[data-user_id =" + moderator_to_be_set + "]").remove(); // remove moderator button
                    $("*[data-moderator_id =" + moderator_to_be_set + "]").attr('disabled', true); // disabled the remove button of moderator
                    $("*[data-moderator_id =" + moderator_to_be_set + "]").attr('title', 'Moderator'); // disabled the remove button of moderator
                    $(".setModerator").remove(); // remove other moderator
//
                    moderator_to_be_set = ''; // empty the content
                    $(".loader").hide(); // hide loader

                }
            }
        });
    }

</script>
<div class="loader_img-outer loader" style="display:none;">
    <div class="loader_img">
        <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
