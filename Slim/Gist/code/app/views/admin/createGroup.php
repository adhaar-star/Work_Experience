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
            <h1>Create New Group</h1>
        </div>
    </div>


    <form id="create_group_form" name="create_group_form" class="create_user_form" method="POST" autocomplete="off">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="new-user">

                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>Select Region:</label>
                        <div class="form-group">
                            <select id="region_id" name="region_id" class="selectpicker form-control">
                                <option value="" selected disabled>Select the Region</option>
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

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label> Enter Group:</label>
                        <input type="text" id="group_name" name="group_name" class="form-control">
                    </div>
                    <div class="clearfix"></div>
                    <div class="new-button">
<!--                        <input type="hidden" class="form-control" id="action" value="add" name="action">-->
                        <input class="save-btn" id="create_group_submit" type="submit" value="Submit" title="Submit">
                    </div>
                </div>
            </div>
        </div>

    </form>

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

    $(document).ready(function () {
        

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
