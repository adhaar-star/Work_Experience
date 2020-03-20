<?php include_once $this->getPart('/admin/common/header.php'); ?>
<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/select.min.css" />
<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/datetimepicker.css" />
<script src="<?= $app['base_assets_admin_url']; ?>js/moment.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/datetimepicker.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/select.min.js"></script>
<?php include_once $this->getPart('/admin/sideMenu.php'); ?>
<!-- Main Content -->


<div class="side-body">
    <div class="admin_header_outer">
        <div class="page_name_heading">
            <h1>Create New Session</h1>
        </div>

    </div>


    <form id="create_user_form" name="create_user_form" class="create_user_form" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="new-user">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>Title:</label>
                        <input type="text" id="title" name="title" class="form-control">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Timezone:</label>
                        <div class="form-group">
                            <select id="timezone_id" name="timezone_id" class="selectpicker form-control" data-live-search="true">
                                <option value="" selected disabled>Select the timezone</option>
                                <?php
                                foreach ($timezones as $t_key => $t_value) {
                                    $signDisplay = "";
                                    $sign = substr($t_value['timezone_format'], 0, 1);
                                    if ($sign != "-") { // set sign
                                        $signDisplay = "+";
                                    }
                                    if ($t_value['timezone_format'] == "00:00") { // set timezone name in case 00:00
                                        $timezone = '(UTC) ' . $t_value['timezone_name'];
                                    } else { // set according to timezone name
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
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="date_time" id="date_time" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label> Duration:</label>
                        <div class="form-group">
                            <select id="duration" name="duration" data-toggle="tooltip" title="Select Duration" class="selectpicker form-control">
                                <option value="" selected disabled>Select Duration</option>
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
                            <select id="continent_id" name="continent_id" data-toggle="tooltip" title="Select the Region" class="selectpicker form-control">
                                <option value="" selected disabled>Select the Region</option>
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

                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12 groups" style="display:none">
                        <label> Group:</label>
                        <div class="form-group">
                            <select id="group_id" name="group_id" class="selectpicker form-control">


                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label> Description:</label>
                        <textarea id="description" name="description" class="form-control" row="2"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div class="new-button">
                        <input type="hidden" class="form-control" id="action" value="add" name="action">
                        <input name="create_user_submit" data-toggle="tooltip" class="save-btn" type="submit" value="Submit" title="Submit">
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>

<script>
    //for navigation
    $(function () {

        $('#datetimepicker1').datetimepicker({
            //minDate: new Date(),
            sideBySide: true,
            minDate: '<?= date('Y-m-d H:i:s'); ?>',
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

        });
    });

    // Get current date time of selected timezone
    $(document).on('change', '#timezone_id', function () {

        var data = {};
        data.body = {timezone_id: $(this).val()};
        $(".loader").show(); // show loader

        $.when(getCurrentDateTimeByTimezoneId(data)).then(function (data) {
            $(".loader").hide(); // hide loader
            if (data.meta.success) { // ajax sucess
                $('.date_time_block').html("<div class='input-group date' id='datetimepicker1'>" +
                        "<input type='text' name='date_time' id='date_time' class='form-control' />" +
                        "<span class='input-group-addon'>" +
                        "<span class='glyphicon glyphicon-calendar'></span>" +
                        "</span>" +
                        "</div>");
                $('#datetimepicker1').datetimepicker({
                    defaultDate: data.data.date_time,
                    sideBySide: true,
                    minDate: data.data.date_time
                });
            }
        });
    });


    $(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $('#continent_id').on('change', function (e) {
            $(".groups").hide();
            var optionSelected = $(this).val();
            var region = <?= json_encode($regions) ?>;


            if (region[optionSelected]) {
                var region_list = region[optionSelected];
            } else {
                var region_list = '';
            }

            var group = <?= json_encode($groups) ?>;
            $('#group_id').html('');
            var group_region = '<option value="" selected disabled>Select the Group</option>';

            if (region_list != '') {
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
            } else {
                $("#group_id").append(group_region);
                group_region = '';
            }

            $('.selectpicker').selectpicker('refresh');
            $(".groups").show();
        });

        /*
         * Validate forgot form
         */
        $('#create_user_form').validate({
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
                },
                duration: {
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
                },
                duration: {
                    required: 'Please select session duration.'
                }
            },
            submitHandler: function () {

                toastr.clear();

                $('#create_user_submit').attr('disabled', true);

                var data = {};
                data.body = $('#create_user_form').serializeObject();
                var region_id = $('#group_id option:selected').data('region');
                data.body.region_id = region_id;
                $(".loader").show(); // show loader

                $.when(createUpdateSession(data)).then(function (data) {

                    if (data.meta.success) { // ajax success
                        toastr.success("Session created successfully."); // show message
                        setTimeout(function () {
                            // if data success redirect to user
                            window.location.href = Data.base_admin_url + 'upcomingSession/';
                            $(".loader").hide(); // show loader
                        }, 3000)
                    } else { // if error occur
                        $(".loader").hide();
                        $('#create_user_submit').attr('disabled', false);
                    }
                });
            }
        });

    });

</script>
<!--loader-->
<div class="loader_img-outer loader" style="display:none;"> 
    <div class="loader_img">
        <img src="<?= $app['base_assets_admin_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
