<div class="side-menu">
    <nav class="navbar navbar-default">
        <div class="navbar-header">
            <div class="brand-wrapper">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="brand-name-wrapper">
                    <a class="navbar-brand" href="<?= $app['base_admin_url']; ?>dashboard/" data-title="logo">
                        <img src="<?= $app['base_assets_admin_url']; ?>images/brain_logo.png" alt="logo" class="img-responsive">
                    </a>
                </div>
            </div>
        </div>


        <!-- Main Menu -->
        <div class="side-menu-container">
            <ul class="nav navbar-nav">
                <li class="<?= $meta['page_name'] == 'Dashboard' ? 'active' : ''; ?>">
                    <a href="<?= $app['base_admin_url']; ?>dashboard/" data-toggle="tooltip" data-placement="top" title="Dashboard">
                        <span class="side_menu_icon"><i class="fa fa-tachometer" aria-hidden="true"></i>
                        </span>
                        <span class="side_menu">Dashboard</span> 
                    </a>
                </li>

                <li class="<?= $meta['page_name'] == 'Users' ? 'active' : ''; ?>">
                    <a href="<?= $app['base_admin_url']; ?>users/" title="Users list" data-toggle="tooltip" data-placement="top">
                        <span class="side_menu_icon"><i class="fa fa-users" aria-hidden="true"></i>
                        </span>
                        <span class="side_menu ">Users List</span>
                    </a>
                </li>
                
                <li class="<?= $meta['page_name'] == 'regions' ? 'active' : ''; ?>">
                    <a href="<?= $app['base_admin_url']; ?>manageSupportGroups/" title="Support Groups" data-toggle="tooltip" data-placement="top">
                        <span class="side_menu_icon"><i class="fa fa-flag-checkered" aria-hidden="true"></i>
                        </span>
                        <span class="side_menu ">Support Groups</span>
                    </a>
                </li>


                <li class="panel panel-default dropdown" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl2" title="Session list" data-placement="top">
                        <span class="side_menu_icon">  <i class="fa fa-list session_list_icon" aria-hidden="true"></i></span>
                        <span class="side_menu">Session List</span>   <b class="caret"></b>
                    </a>
                    <div id="dropdown-lvl2" class="panel-collapse collapse <?= $meta['page_name'] == 'Create Session' || $meta['page_name'] == 'Upcoming Sessions' || $meta['page_name'] == 'Missed Sessions' || $meta['page_name'] == 'Participants' || $meta['page_name'] == 'Missed Participants' || $meta['page_name'] == 'Complete Sessions' || $meta['page_name'] == 'session' ? 'in' : ''; ?>">
                        <div class="panel-body">
                            <ul class="nav navbar-nav inner-menu">
                                <li class="<?= $meta['page_name'] == 'Create Session' ? 'active' : ''; ?>">
                                    <a href="<?= $app['base_admin_url']; ?>createSession/" title="Create new session" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus-circle" aria-hidden="true"></i>

                                        Create New</a></li>
                                <li class="<?= $meta['page_name'] == 'Upcoming Sessions' || $meta['page_name'] == 'Participants' ? 'active' : ''; ?>">
                                    <a href="<?= $app['base_admin_url']; ?>upcomingSession/" title="Upcoming sessions" data-toggle="tooltip" data-placement="top"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>
                                        Upcoming</a></li>
                                <li class="<?= $meta['page_name'] == 'Complete Sessions' || $meta['page_name'] == 'session' ? 'active' : ''; ?>">
                                    <a href="<?= $app['base_admin_url']; ?>completeSession/" title="Completed sessions" data-toggle="tooltip" data-placement="top"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                        Completed</a></li>
                                <li class="<?= $meta['page_name'] == 'Missed Sessions' || $meta['page_name'] == 'Missed Participants' ? 'active' : ''; ?>">
                                    <a href="<?= $app['base_admin_url']; ?>missedSession/" title="Missed sessions" data-toggle="tooltip" data-placement="top"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                                        Missed</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="<?= $meta['page_name'] == 'logout' ? 'active' : ''; ?>">
                    <a href="<?= $app['base_admin_url']; ?>logout/" title="Logout" data-toggle="tooltip" data-placement="top">
                        <span class="side_menu_icon"><i class="fa fa-power-off" aria-hidden="true"></i>
                        </span>
                        <span class="side_menu" >Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>



<script>
    $(function() {
        $(".dropdown").click(
            function() {
                $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
            },
            function() {
                $('.dropdown').find('div.collapse').not($(this).find('div.collapse')).removeClass("in");
                $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                $(this).toggleClass('open');
                $('b', this).toggleClass("caret caret-up");
                $('.dropdown').find('b').not($(this).find('b')).removeClass("caret caret-up").addClass('caret caret-down');
            });
    });

</script>
