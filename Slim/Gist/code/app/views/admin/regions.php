<?php include_once $this->getPart('/admin/common/header.php'); ?>
<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/select.min.css" />
<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/datetimepicker.css" />
<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">

<script src="<?= $app['base_assets_admin_url']; ?>js/moment.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/datetimepicker.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/select.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js "></script>

<?php include_once $this->getPart('/admin/sideMenu.php'); ?>

<!-- Main Content -->
<div class="side-body upcoming">

    <div class="admin_header_outer">
        <div class="page_name_heading">
            <h1 class="heading">Manage Support Groups</h1>
        </div>
        <div class="pull-right">
            <div data-placement="bottom" data-toggle="tooltip" title="Create Group" class="text-right right add">
                <a class="btn save-btn" data-toggle="modal" data-target="#createGroup">Create Group</a>
            </div>
        </div>
        <div class="pull-right button_gap">
            <div data-placement="bottom" data-toggle="tooltip" title="Create Sub Region" class="text-right right add">
                <a class="btn save-btn" data-toggle="modal" data-target="#createRegion">Create Sub Region</a>
            </div>
        </div>
    </div>

    <div class="groups_regional">


        <div class="count_chat_outer">

            <div class="row">
                <div class="regional_name_outer">
                    <div class="regional_name">
                        <?php
                        foreach ($continents as $c_index => $c_value) {
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h2>
                                    <?= $c_value['continent_name'] ?>
                                </h2>
                                <div class="panel-group date-accordin" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php
                                    foreach ($regions as $r_index => $r_value) {
                                        if ($c_value['continent_id'] == $r_value['continent_id']) {
                                            ?>
                                            <div class="panel panel-default view-activity-log">
                                                <div class="panel-heading panel panel_icon" role="tab" id="heading<?= $r_value['region_id']; ?>">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $r_value['region_id'] ?>" aria-expanded="<?= $r_value['region_id'] == 200000 ? 'true' : 'false' ?>" aria-controls="collapse<?= $r_value['region_id'] ?>">
                                                            <?= $r_value['region_name'] ?>
                                                        </a>
                                                    </h4>
                                                     <p data-placement="top" data-toggle="tooltip"><button class="btn btn-primary btn-xs edit_region button_icon1" data-toggle="tooltip" data-edit="<?= $r_value['region_id'] ?>" title="Edit Sub Region"><span class=" glyphicon glyphicon-pencil pencil_gylo"></span></button></p>
                                                    <p data-placement="top" data-toggle="tooltip"><button class="btn btn-danger btn-xs delete_region button_icon" data-toggle="tooltip" data-delete="<?= $r_value['region_id'] ?>" title="Delete Sub Region"><span class="glyphicon glyphicon-trash gylo_pencil"></span></button></p>
                                                </div>
                                                <div id="collapse<?= $r_value['region_id'] ?>" class="panel-collapse collapse <?= $r_value['region_id'] == 200000 ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading<?= $r_value['region_id'] ?>">
                                                    <div class="panel-body">

                                                        <?php
                                                        if (isset($groups[$r_value['region_id']])) {
                                                            foreach ($groups[$r_value['region_id']] as $g_key => $g_value) {
                                                                ?>
                                                                <div class="com_outer">
                                                                    <div class="col-md-9 col-left">
                                                                        <div class="inner_region">
                                                                            <h4>
                                                                                <?= $g_value ?>
                                                                            </h4>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3 col-right pull-right">
                                                                        <div class="actions_buttons pull-right">

                                                                            <p data-placement="top" data-toggle="tooltip"><button class="btn btn-primary btn-xs edit" data-toggle="tooltip" data-edit="<?= $g_key ?>" title="Edit Group"><span class=" glyphicon glyphicon-pencil"></span></button></p>
                                                                            <p data-placement="top" data-toggle="tooltip"><button class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-delete="<?= $g_key ?>" title="Delete Group"><span class="glyphicon glyphicon-trash"></span></button></p>

                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="line"></div>
                                                                <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <div class="com_outer">
                                                                <h4 class="text-center">No group created yet.</h4>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h2>
                                <?php // $independentRegion['region_name']; ?>
                                Non Regional Groups
                            </h2>
                            <div class="panel-group date-accordin" id="accordion" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-default view-activity-log">
                                    <div class="panel-heading" role="tab" id="heading<?= $independentRegion['region_id']; ?>">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $independentRegion['region_id']; ?>" aria-expanded="false" aria-controls="collapse<?= $independentRegion['region_id']; ?>">
                                                <?= $independentRegion['region_name']; ?>
                                            </a>
                                        </h4>
                                        <!--<p data-placement="top" data-toggle="tooltip"><button class="btn btn-primary btn-xs edit_region button_icon1" data-toggle="tooltip" data-edit="<?= $independentRegion['region_id'] ?>" title="Edit Region"><span class=" glyphicon glyphicon-pencil pencil_gylo"></span></button></p>-->
                                    </div>
                                    <div id="collapse<?= $independentRegion['region_id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $independentRegion['region_id']; ?>">
                                        <div class="panel-body">

                                            <?php
                                            if (!empty($groupsOfIndenpendentRegion)) {
                                                foreach ($groupsOfIndenpendentRegion as $gr_key => $gr_value) {
                                                    ?>
                                                    <div class="com_outer">
                                                        <div class="col-md-9 col-left">
                                                            <div class="inner_region">
                                                                <h4>
                                                                    <?= $gr_value['group_name']; ?>
                                                                </h4>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 col-right pull-right">
                                                            <div class="actions_buttons pull-right">

                                                                <p data-placement="top" data-toggle="tooltip"><button class="btn btn-primary btn-xs edit" data-toggle="tooltip" data-edit="<?= $gr_value['group_id']; ?>" title="Edit Group"><span class=" glyphicon glyphicon-pencil"></span></button></p>
                                                                <p data-placement="top" data-toggle="tooltip"><button class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-delete="<?= $gr_value['group_id']; ?>" title="Delete Group"><span class="glyphicon glyphicon-trash"></span></button></p>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="line"></div>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <div class="com_outer">
                                                    <h4 class="text-center">No group created yet.</h4>
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>

        </div>



    </div>
</div>
<!--For delete Users starts-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Delete Group</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete this group?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="delete_user">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--For delete Users ends-->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Group</h4>
            </div>
            <div class="modal-body">
                <form id="create_group_form" name="create_group_form" class="create_user_form" method="POST" autocomplete="off" style="width:100%;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="new-user">

                                <div class="clearfix"></div>
                                <div class="">
                                    <label>Select Region:</label>
                                    <div class="form-group">
                                        <select id="region_id" name="region_id" class="selectpicker form-control">
                                            <option value="" selected disabled>Select the Region</option>
                                            <option value="<?= $independentRegion['region_id']; ?>"><?= $independentRegion['region_name']; ?></option>
                                            <?php
                                            foreach ($continents as $c_key => $c_value) {
                                                ?>
                                                <optgroup label="<?= $c_value['continent_name'] ?>">
                                                    <?php
                                                    foreach ($regions as $r_key => $r_value) {
                                                        if ($r_value['continent_id'] == $c_value['continent_id']) { // set region according to continent
                                                            ?>
                                                            <option value="<?= $r_value['region_id'] ?>"><?= $r_value['region_name'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="">
                                    <label> Enter Group Name:</label>
                                    <input type="text" id="group_name" name="group_name" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="new-button">
                                    <input type="hidden" class="form-control" id="group_id" name="group_id">
                                    <!--                        <input type="hidden" class="form-control" id="action" value="add" name="action">-->
                                    <input class="save-btn" data-toggle="tooltip" id="create_group_submit" type="submit" value="Submit" title="Submit">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="createRegion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="regionModalLabel">Create Sub Region</h4>
            </div>
            <div class="modal-body">
                <form id="create_region_form" name="create_region_form" class="create_region_form" method="POST" autocomplete="off" style="width:100%;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="new-user">

                                <div class="clearfix"></div>
                                <div class="">
                                    <label>Select Region:</label>
                                    <div class="form-group">
                                        <select id="continent_id" name="continent_id" class="selectpicker form-control">
                                            <option value="" selected disabled>Select the Region</option>
                                            <?php
                                            foreach ($continents as $c_key => $c_value) {
                                                ?>
                                                <option value="<?= $c_value['continent_id'] ?>"><?= $c_value['continent_name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="">
                                    <label> Enter Sub Region Name:</label>
                                    <input type="text" id="region_name" name="region_name" class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="new-button">
                                    <input type="hidden" class="form-control" id="sub_region_id" name="region_id">
                                    <input class="save-btn" data-toggle="tooltip" id="create_region_submit" type="submit" value="Submit" title="Submit">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteRegion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Delete Region</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete this region?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="delete_region">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
            </div>
        </div>
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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        /*
         * Validate create group form
         */
        $('#create_group_form').validate({
            rules: {
                region_id: {
                    required: true
                },
                group_name: {
                    required: true
                }
            },
            messages: {
                region_id: {
                    required: 'Please select region.'
                },
                group_name: {
                    required: 'Please enter group name.'
                }
            },
            submitHandler: function () {

                toastr.clear();

                $('#create_group_submit').attr('disabled', true);

                $("#createGroup").modal('hide');

                var data = {};
                data.body = $('#create_group_form').serializeObject();

                $(".loader").show(); // show loader

                $.when(createNewGroup(data)).then(function (data) {

                    if (data.meta.success) { // ajax success
                        toastr.success(data.data.message); // show message
                        $(".loader").hide(); // show loader
                        setTimeout(function () {
                            // if data success redirect to user
                            window.location.href = Data.base_admin_url + 'manageSupportGroups/';
                        }, 2000);
                        $('#create_group_submit').attr('disabled', false);
                    } else { // if error occur
                        $(".loader").hide();
                        $('#create_group_submit').attr('disabled', false);
                    }
                });
            }
        });

        /*
         * for deleting group
         */
        $('body').on('click', '.delete', function () {
            // set the session id which is needed to be deleted 
            field_to_be_deleted = $(this).data('delete');
            $('#delete').modal('show');
        });
        /*
         * for opening edit modal
         * @author Loveleen 
         * @date 28 Feb, 2018
         */
        $('body').on('click', '.edit', function () {
            var group_id = $(this).data('edit');
            getGroupDetail(group_id);

        });

        // modal on hide 
        $('#createGroup').on('hidden.bs.modal', function () {
            $("#myModalLabel").html('Create Group');
            $('label.error').text(''); // hide error
            $('.form-control').val(''); // reset form fields
            $("#region_id").selectpicker("refresh");

            $("#create_group_submit").val('Submit');
            $("#create_group_submit").attr('data-original-title', 'Submit');
        });

        /*
         * delete session on basis of session id , call the api
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        $('#delete_user').click(function () {
            $('#delete').modal('hide');
            if (field_to_be_deleted !== '') { // if session id is set
                deleteGroup(field_to_be_deleted); // call function for delete session
                field_to_be_deleted = ''; // empty the content
            }
        });

        /*
         * Validate create region form
         */
        $('#create_region_form').validate({
            rules: {
                continent_id: {
                    required: true
                },
                region_name: {
                    required: true
                }
            },
            messages: {
                continent_id: {
                    required: 'Please select region.'
                },
                region_name: {
                    required: 'Please enter sub region name.'
                }
            },
            submitHandler: function () {

                toastr.clear();

                $('#create_region_submit').attr('disabled', true);

                $("#createRegion").modal('hide');

                var data = {};
                data.body = $('#create_region_form').serializeObject();

                $(".loader").show(); // show loader

                $.when(createNewRegion(data)).then(function (data) {

                    if (data.meta.success) { // ajax success
                        toastr.success(data.data.message); // show message
                        $(".loader").hide(); // show loader
                        setTimeout(function () {
                            // if data success redirect to user
                            window.location.href = Data.base_admin_url + 'manageSupportGroups/';
                        }, 2000);
                        $('#create_region_submit').attr('disabled', false);
                    } else { // if error occur
                        $(".loader").hide();
                        $('#create_region_submit').attr('disabled', false);
                    }
                });
            }
        });
    });

    /*
     * for open modal of deleting region
     */
    $('body').on('click', '.delete_region', function () {
        // set the session id which is needed to be deleted 
        field_to_be_deleted = $(this).data('delete');
        $('#deleteRegion').modal('show');
    });


    /*
     * delete region 
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    $('#delete_region').click(function () {
        $('#deleteRegion').modal('hide');
        if (field_to_be_deleted !== '') { // if session id is set
            deleteRegion(field_to_be_deleted); // call function for delete session
            field_to_be_deleted = ''; // empty the content
        }
    });

    /*
     * for opening edit region modal
     * @author Loveleen 
     * @date 28 Feb, 2018
     */
    $('body').on('click', '.edit_region', function () {
        var region_id = $(this).data('edit');
        getRegionDetail(region_id);
    });

    // modal on hide 
    $('#createRegion').on('hidden.bs.modal', function () {
        $("#regionModalLabel").html('Create Sub Region');
        $('label.error').text(''); // hide error
        $('.form-control').val(''); // reset form fields
        $("#continent_id").selectpicker("refresh");

        $("#create_region_submit").val('Submit');
        $("#create_region_submit").attr('data-original-title', 'Submit');
    });

    /*
     * function for deleting and updating group
     * @author Loveleen 
     * @date 28 Feb, 2018
     */
    function deleteGroup(id) {
        var data = {};
        data.body = {
            'group_id': id
        };
        $(".loader").show(); // show loader
        $.when(delGroup(data)).then(function (data) {
            $(".loader").hide(); // hide loader
            if (data.meta.success) { // the action is in success
                toastr.success('Group deleted successfully.');
                setTimeout(function () {
                    // if data success redirect to region list
                    window.location.href = Data.base_admin_url + 'manageSupportGroups/';
                }, 2000);

            }
        });
    }

    /*
     * function for getting session details 
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    function getGroupDetail(id) {
        var data = {};
        data.body = {
            'group_id': id
        };
        $(".loader").show(); // show loader
        $.when(detailOfGroup(data)).then(function (response) {
            if (response.meta.success) { //if success
                $(".loader").hide(); // show loader
                // if success set the form fields
                var data = response.data.group_detail;
                $('#group_name').val(data.group_name);
                $('select[name=region_id]').val(data.region_id);
                $('.selectpicker').selectpicker('refresh');
                $("#myModalLabel").html('Edit Group');
                $('#region_id').val(data.region_id);
                $('#group_id').val(data.group_id);
                $("#create_group_submit").val('Update');
                 $("#create_group_submit").attr('data-original-title', 'Update');
                $('#createGroup').modal('show'); // show modal
            }
        });
    }

    /*
     * function for getting region details 
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    function getRegionDetail(id) {
        var data = {};
        data.body = {
            'region_id': id
        };
        $(".loader").show(); // show loader
        $.when(detailOfRegion(data)).then(function (response) {
            if (response.meta.success) { //if success
                $(".loader").hide(); // show loader
                // if success set the form fields
                var data = response.data.region_detail;
                $('#region_name').val(data.region_name);
                $('select[name=continent_id]').val(data.continent_id);
                $('.selectpicker').selectpicker('refresh');
                $("#regionModalLabel").html('Edit Sub Region');
                $('#sub_region_id').val(data.region_id);
                $("#create_region_submit").val('Update');
                $("#create_region_submit").attr('data-original-title', 'Update');
                $('#createRegion').modal('show'); // show modal
            }
        });
    }
    
    /*
     * function for deleting region
     * @author Loveleen 
     * @date 28 Feb, 2018
     */
    function deleteRegion(id) {
        var data = {};
        data.body = {
            'region_id': id
        };
        $(".loader").show(); // show loader
        $.when(delRegion(data)).then(function (data) {
            $(".loader").hide(); // hide loader
            if (data.meta.success) { // the action is in success
                toastr.success('Sub region deleted successfully.');
                setTimeout(function () {
                    // if data success redirect to region list
                    window.location.href = Data.base_admin_url + 'manageSupportGroups/';
                }, 2000);

            }
        });
    }

</script>
<!--loader-->
<div class="loader_img-outer loader" style="display:none;">
    <div class="loader_img">
        <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
