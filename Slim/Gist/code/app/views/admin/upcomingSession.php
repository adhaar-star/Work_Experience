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
            <h1 class="heading">Upcoming Sessions</h1>
        </div>

        <div class="pull-right">
            <div data-placement="bottom" data-toggle="tooltip" title="Create Session" class="text-right right add"><a class="btn save-btn" href="<?= $app['base_admin_url']; ?>createSession/" >Create Session</a></div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered upcoming-session upcomingSessionTable">
        <thead>
            <tr>
                <th>Session Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Region</th>
                <th>Group</th>
                <th>Duration <br>(Minutes)</th>
                <th>Session Date/Time</th>
                <th>Actions</th>
            </tr>
        </thead>

    </table>
</div>
<!--For delete Users starts-->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align">Delete this entry</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Are you sure you want to delete this record?</div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" id="delete_user">Ok</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--For delete Users ends-->

<!--Update Session starts-->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <h4 class="modal-title custom_align">Edit Session</h4>
            </div>
            <form id="session_form" name="session_form" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-both">
                            <div class="new-user">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>Title:</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>
                                        Timezone:</label>
                                    <div class="form-group">
                                        <select id="timezone_id" name="timezone_id" class="selectpicker form-control" data-live-search="true">
                                            <option value="" disabled>Select the timezone</option>
                                            <?php
                                            foreach ($timezones as $t_key => $t_value) {
                                                $signDisplay = "";
                                                $sign = substr($t_value['timezone_format'], 0, 1);
                                                if ($sign != "-") { // add sign
                                                    $signDisplay = "+";
                                                }
                                                if ($t_value['timezone_format'] == "00:00") { // if time 00:00 set timezone
                                                    $timezone = '(UTC) ' . $t_value['timezone_name'];
                                                } else { // set timezone according to set timezone
                                                    $timezone = "(UTC" . $signDisplay . $t_value['timezone_format'] . ") " . $t_value['timezone_name'];
                                                }
                                                ?>
                                                <option value="<?= $t_value['timezone_id'] ?>"><?= $timezone ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>  Date/Time:</label>
                                    <div class="form-group date_time_block">
                                        <div class="input-group date" id="datetimepicker1">
                                            <input type='text' name="date_time" id="date_time" class="form-control">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label> Duration:</label>
                                    <div class="form-group">
                                        <select id="duration" name="duration" class="selectpicker form-control">
                                            <option value="" disabled>Select Duration</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                            <option value="60">60</option>
                                            <option value="90">90</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label> Region:</label>
                                    <div class="form-group">
                                        <select id="continent_id" name="continent_id" class="selectpicker form-control">
                                            <option value="" disabled>Select the Region</option>
                                            <option value="<?= $independentRegion['continent_id']; ?>"><?= $independentRegion['region_name']; ?></option>
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

                                <div class="col-md-12 col-sm-12 col-xs-12 groups">
                                    <label> Group:</label>
                                    <div class="form-group">
                                        <select id="group_id" name="group_id" class="selectpicker form-control">
                                            <!--                                            <option value="" disabled>Select the Group</option>-->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label> Description:</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer ">
                    <input type="hidden" class="form-control" id="session_id" name="session_id" value="">
                    <input type="hidden" class="form-control" id="action" value="edit" name="action">
                    <button type="submit" name="submit" class="btn btn-default save-btn session_submit">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Update Session ends-->

<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({
            sideBySide: true,
            minDate: new Date()
        });
        $('.navbar-toggle').click(function () {
            $('.navbar-nav').toggleClass('slide-in');
            $('.side-body').toggleClass('body-slide-in');
            $('#search').removeClass('in').addClass('collapse').slideUp(200);
        });

        // Remove menu for searching
        $('#search-trigger').click(function () {
            $('.navbar-nav').removeClass('slide-in');
            $('.side-body').removeClass('body-slide-in');

            /// uncomment code for absolute positioning tweek see top comment in css
            //$('.absolute-wrapper').removeClass('slide-in');

        });
    });

    // Get current date time of selected timezone
    $(document).on('change', '#timezone_id', function () {

        var data = {};
        data.body = {timezone_id: $(this).val()};
        $(".loader").show(); // show loader

        $.when(getCurrentDateTimeByTimezoneId(data)).then(function (data) {
            $(".loader").hide(); // hide loader
            if (data.meta.success) { // if result is in success
                $('.date_time_block').html("<div class='input-group date' id='datetimepicker1'>" +
                        "<input type='text' name='date_time' id='date_time' class='form-control' />" +
                        "<span class='input-group-addon'>" +
                        "<span class='glyphicon glyphicon-calendar'></span>" +
                        "</span>" +
                        "</div>");
                $('#datetimepicker1').datetimepicker({
                    sideBySide: true,
                    defaultDate: data.data.date_time,
                    minDate: data.data.date_time
                });
            }
        });
    });


    $(document).ready(function () {
        $('#continent_id').on('change', function (e) {
            $(".groups").hide();
            var optionSelected = $(this).val();
            var region = <?= json_encode($regions) ?>;
            var region_list = region[optionSelected];
            var group = <?= json_encode($groups) ?>;
            $('#group_id').html('');
            var group_region = '<option value="" selected disabled>Select the Group</option>';
            $.each(region_list, function (index, value) {
                group_region += '<optgroup label="' + value + '">';
                if (group[index] !== undefined) {
                    $.each(group[index], function (i, v) {
                        group_region += '<option value="' + i + '" data-region=' + index + '>' + v + '</option>';
                    });
                    group_region += '</optgroup>';
                } else {
                    group_region += '</optgroup>';
                }
                $("#group_id").append(group_region);
                group_region = '';
            });
            $('.selectpicker').selectpicker('refresh');
            $(".groups").show();
        });
        /*
         * Validate forgot form
         */
        $('#session_form').validate({
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                continent_id: {
                    required: true
                },
                group_id: {
                    required: true
                },
                timezone_id: {
                    required: true
                },
                date_time: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: 'Please enter title.'
                },
                description: {
                    required: 'Please enter description.'
                },
                timezone_id: {
                    required: 'Please select timezone.'
                },
                continent_id: {
                    required: 'Please select region.'
                },
                group_id: {
                    required: 'Please select group.'
                },
                date_time: {
                    required: 'Please select session date/time.'
                }
            },
            submitHandler: function () {

                toastr.clear();

                $('#session_submit').attr('disabled', true);

                var data = {};
                data.body = $('#session_form').serializeObject();
                var region_id = $('#group_id option:selected').data('region');
                data.body.region_id = region_id;


                console.log(data.body);

                $.when(createUpdateSession(data)).then(function (data) {

                    if (data.meta.success) {// if data success update Table data 
                        toastr.success(data.data.message);
                        $("#add").modal("hide"); // hide the add modal
                        setTimeout(function () { // reload datatable content
                            $('.upcomingSessionTable').DataTable().ajax.reload();
                        }, 1000);
                    } else { // in case error
                        $('#create_user_submit').attr('disabled', false);
                    }
                });
            }
        });
        /*
         * get the upcoming sessions using datatables
         * @author Loveleen 
         * @date 11 Jan, 2018
         * @return upcoming session data in table
         */
        $('.upcomingSessionTable').DataTable({
            "order": [[0, "desc"]],
            "aLengthMenu": [10, 20, 30, 50],
            "pageLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "columnDefs": [
                {"orderable": false, "targets": [3, 4, 7]}
            ],
            "language": {
                "emptyTable": "No upcoming sessions."
            },
            "sAjaxSource": Data.base_url + "admin/upcomingSessionDetail/",
        });

        // Tooltip in bootstrap for datatables
        $('.upcomingSessionTable').on('draw.dt', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        /*
         * for opening delete session dialogbox 
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        $('body').on('click', '.delete', function () {
            // set the session id which is needed to be deleted
            field_to_be_deleted = $(this).attr('id');
            $('#delete').modal('show');
        });
        /*
         * for opening delete session dialogbox 
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        $('body').on('click', '.edit', function () {
            var participants = $(this).parent().attr('class'); // get the number of participants
            if (participants === '1') { // if session seats are not confirmed
                session_id = $(this).attr('id');
                getSessionDetail(session_id);
            } else { // if session seats are confirmed
                toastr.error("Session seats are confirmed. Now you can't edit the session");
            }
        });

        /*
         * for opening edit session popup
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        $("#addUser").click(function () {

            $('.error').text('');
            $('#email').prop('readonly', false);
            $('#username').prop('readonly', false);
            $("#action").val('add');
            $("#add").modal('show');
        });

        /*
         * delete session on basis of session id , call the api
         * @author Loveleen 
         * @date 11 Jan, 2018
         */
        $('#delete_user').click(function () {
            $('#delete').modal('hide');
            if (field_to_be_deleted !== '') { // if session id is set
                deleteSession(field_to_be_deleted); // call function for delete session
                field_to_be_deleted = ''; // empty the content
            }
        });

        // Enter session
        $('body').on('click', '.enter_session', function () {
            var session_id = $(this).attr('data-session_id');

            var data = {};
            data.body = {'session_id': session_id};
            $(".loader").show(); // show loader
            $.when(enterSession(data)).then(function (data) {
                $(".loader").hide();
                if (data.meta.success) { // the action is in success
                    var url = Data.base_url + 'profile/?id=' + btoa(session_id) + '#systemCheck';
                    window.open(url, '_blank');
                }
            });

        });

        // modal on hide 
        $('#add').on('hidden.bs.modal', function () {
            $('label.error').text(''); // hide error
        });

    });

    /*
     * function for deleting session record
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    function deleteSession(id) {
        var data = {};
        data.body = {'session_id': id};
        $(".loader").show(); // show loader
        $.when(delSession(data)).then(function (data) {
            if (data.meta.success) { // the action is in success
                $('.upcomingSessionTable').DataTable().ajax.reload(); // show messages
                setTimeout(function () { // update table data after delete
                    toastr.success('Session deleted successfully.');
                    $(".loader").hide(); // show loader
                }, 1000);
            }
        });
    }

    /*
     * function for getting session details 
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    function getSessionDetail(id) {
        var data = {};
        data.body = {'session_id': id};
        $(".loader").show(); // show loader
        $.when(detailOfSession(data)).then(function (response) {
            if (response.meta.success) { //if success
                $(".loader").hide(); // show loader
                // if success set the form fields
                console.log(response.data.session_data);
                var data = response.data.session_data;
                $('#title').val(data.title);
                $('#description').val(data.description);
                var optionSelected = data.continent_id;
                var region = <?= json_encode($regions) ?>;
                var region_list = region[optionSelected];
                var group = <?= json_encode($groups) ?>;
                $('#group_id').html('');
                var group_region = '<option value="" selected disabled>Select the Group</option>';
                $.each(region_list, function (index, value) {
                    group_region += '<optgroup label="' + value + '">';
                    if (group[index] !== undefined) {
                        $.each(group[index], function (i, v) {
                            group_region += '<option value="' + i + '" data-region=' + index + '>' + v + '</option>';
                        });
                        group_region += '</optgroup>';
                    } else {
                        group_region += '</optgroup>';
                    }
                    $("#group_id").append(group_region);
                    group_region = '';
                });

                $('select[name=timezone_id]').val(data.timezone_id);
                $('select[name=continent_id]').val(data.continent_id);
                $('select[name=group_id]').val(data.group_id);
                $('select[name=duration]').val(data.duration);
                $('.selectpicker').selectpicker('refresh');
                $('#timezone_id').val(data.timezone_id);
                $('#duration').val(data.duration);
                $('#region_id').val(data.region_id);
                //$('#datetimepicker1').data("DateTimePicker").date(new Date(data.date_time));


                $('.date_time_block').html("<div class='input-group date' id='datetimepicker1'>" +
                        "<input type='text' name='date_time' id='date_time' class='form-control' />" +
                        "<span class='input-group-addon'>" +
                        "<span class='glyphicon glyphicon-calendar'></span>" +
                        "</span>" +
                        "</div>");
                $('#datetimepicker1').datetimepicker({
                    defaultDate: data.date_time,
                    sideBySide: true,
                    minDate: response.data.current_date_time
                });

                $("#session_id").val(data.session_id);
                $('#add').modal('show'); // show modal
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
