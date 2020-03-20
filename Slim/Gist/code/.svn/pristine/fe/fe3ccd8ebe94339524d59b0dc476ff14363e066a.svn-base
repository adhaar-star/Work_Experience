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
<div class="side-menu upcoming">
    <?php include_once $this->getPart('/admin/sideMenu.php'); ?> 
</div>
<!-- Main Content -->

<div class="side-body">
    <div class="admin_header_outer">
        <div class="page_name_heading">
            <h1>Completed Sessions</h1>
        </div>
        <!-- <div class="notification_heading">
                <ul>
                    <li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i></a><span>5</span></li>
                </ul>
            </div>-->
    </div>

    <table id="example" class="table table-striped table-bordered complete-session completeSessionTable">
        <thead>
            <tr>
                <th>Session Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>Region</th>
                <th>Group</th>
                <th>Duration (Minutes)</th>
                <th>Session Date/Time</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
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

            /// uncomment code for absolute positioning tweek see top comment in css
            //$('.absolute-wrapper').removeClass('slide-in');

        });
    });
    /*
     * get the complete sessions using datatables
     * @author Loveleen 
     * @date 11 Jan, 2018
     * @return complete session data in table
     */
    $('.completeSessionTable').DataTable({
        "order": [[0, "desc"]],
        "aLengthMenu": [10, 20, 30, 50],
        "pageLength": 10,
        "bProcessing": true,
        "bServerSide": true,
        "columnDefs": [
            {"orderable": false, "targets": [3, 4, 6]}
        ],
        "language": {
            "emptyTable": "No completed sessions."
        },
        "sAjaxSource": Data.base_url + "admin/completeSessionDetail/",
    });

    // Tooltip in bootstrap for datatables
    $('.completeSessionTable').on('draw.dt', function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
<div class="loader_img-outer loader" style="display:none;">
    <div class="loader_img">
        <img src="<?= $app['base_assets_url']; ?>images/loading-icon.gif">
    </div>
</div>
</body>

</html>
