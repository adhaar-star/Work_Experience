<?php include_once $this->getPart('/admin/common/header.php'); ?>

<link rel="stylesheet" href="<?= $app['base_assets_admin_url']; ?>css/dataTables.bootstrap.min.css">
<script src="<?= $app['base_assets_admin_url']; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= $app['base_assets_admin_url']; ?>js/dataTables.bootstrap.min.js"></script>

<?php include_once $this->getPart('/admin/sideMenu.php'); ?>
<!-- Main Content -->
<div class="admin_page_outer">
    <div class="side-body">
        <div class="admin_header_outer">
            <div class="page_name_heading">
                <h1>Dashboard</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 space_dash">
                <div class="white-box blue user_list_box">
                    <a href="<?= $app['base_admin_url']; ?>users/" title="Users list">
                        <div class="r-icon-stats">
                            <i class="fa fa-users" aria-hidden="true"></i>

                            <div class="bodystate user_list_outer">

                                <!--    <h4 class="counter" data-count="<?= count($user_list) ?>"></h4>-->
                                <!--  <span class="text-muted">Users List</span>-->
                                <div class="users_dashboard">
                                    <span class="inactive_user"><p class="counter" data-count="<?= count($active_user_list) ?>"></p>  Active Users</span>
                                    <span class="inactive_user"><p class="counter" data-count="<?= count($inactive_user_list) ?>"></p>  Inactive Users</span>
                                    <span class="inactive_user"><p class="counter" data-count="<?= count($user_list) ?>"></p>  Total Users</span>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 space_dash">
                <div class="white-box orange" title="Upcoming Sessions">
                    <a href="<?= $app['base_admin_url']; ?>upcomingSession/">
                        <div class="r-icon-stats">
                            <i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                            <div class="bodystate">
                                <h4 class="counter" data-count="<?= count($upcoming_session) ?>"></h4>
                                <span class="text-muted">Upcoming Sessions</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4  col-sm-6 space_dash">
                <div class="white-box green">
                    <a href="<?= $app['base_admin_url']; ?>completeSession/" title="Completed Sessions">
                        <div class="r-icon-stats">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>

                            <div class="bodystate">
                                <h4 class="counter" data-count="<?= count($complete_session) ?>"></h4>
                                <span class="text-muted">Completed Sessions</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4  col-sm-6 space_dash">
                <div class="white-box purple" title="Missed Sessions">
                    <div class="r-icon-stats">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <div class="bodystate">
                            <h4 class="counter" data-count="<?= count($missed_session) ?>"></h4>
                            <span class="text-muted">Missed Sessions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<script>
    //for navigation
    $(function () {

        $('[data-toggle="tooltip"]').tooltip();

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

    $('.counter').each(function () {
        var $this = $(this),
                countTo = $this.attr('data-count');
        $({
            countNum: $this.text()
        }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'linear',
            step: function () {
                $this.text(Math.floor(this.countNum));
            },
            complete: function () {
                $this.text(this.countNum);
            }
        });
    });

</script>
</body>

</html>
