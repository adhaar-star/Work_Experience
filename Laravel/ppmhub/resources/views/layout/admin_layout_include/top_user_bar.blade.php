<nav class="top-menu hidden-print">
    <div class="menu-icon-container hidden-md-up">
        <div class="animate-menu-button left-menu-toggle">
            <div><!-- --></div>
        </div>
    </div>
    <div class="menu">
        <div class="menu-user-block">
            <div class="dropdown dropdown-avatar">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="avatar" href="javascript:void(0);">
                                <img src="{{asset('vendors/common/img/temp/avatars/1.jpg')}}" alt="Alternative text to the image">
                            </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Home</div>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> System Dashboard</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> User Boards</a>
                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-circle-right"></i> Issue Navigator (35 New)</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('admin/logout')}}"><i class="dropdown-icon icmn-exit"></i> Logout</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('admin/changepassword')}}"><i class="dropdown-icon icmn-circle-right"></i> Change Password</a>
                </ul>
            </div>
        </div>
        <div class="menu-user-block menu-notifications">
            <div class="dropdown dropdown-avatar">
                <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="menu-notification-icon icmn-bubbles7"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="" role="menu">
                    <div class="notification-block">
                        <div class="item">
                            <i class="notification-icon icmn-star-full"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">now</span>
                                    <a href="javascript: void(0);">Update Status: <span class="label label-danger font-weight-700">New</span></a>
                                </div>
                                <div class="descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="notification-icon icmn-stack3"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">24 min ago</span>
                                    <a href="javascript: void(0);">Income: <span class="label label-default font-weight-700">$299.00</span></a>
                                </div>
                                <div class="descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="notification-icon icmn-bubbles5"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">30 min ago</span>
                                    <a href="javascript: void(0);">Inbox Message</a>
                                </div>
                                <div class="descr">
                                    From: <a href="javascript: void(0);">David Bowie</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="notification-icon icmn-pie-chart2"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">now</span>
                                    <a href="javascript: void(0);">Update Status: <span class="label label-primary font-weight-700">New</span></a>
                                </div>
                                <div class="descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="notification-icon icmn-books"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">24 min ago</span>
                                    <a href="javascript: void(0);">Income: <span class="label label-warning font-weight-700">$299.00</span></a>
                                </div>
                                <div class="descr">
                                    Failed to get available update data. To ensure the proper functioning of your application, update now.
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <i class="notification-icon icmn-cog util-spin-delayed-pseudo"></i>
                            <div class="inner">
                                <div class="title">
                                    <span class="pull-right">30 min ago</span>
                                    <a href="javascript: void(0);">Inbox Message</a>
                                </div>
                                <div class="descr">
                                    From: <a href="javascript: void(0);">David Bowie</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <div class="menu-info-block">
            <div class="left">
                <div class="header-buttons">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dropdown-inline-button-icon icmn-folder-open"></i>
                            <span class="hidden-lg-down">Issues History</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="javascript:void(0)">Current search</a>
                            <a class="dropdown-item" href="javascript:void(0)">Search for issues</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">Opened</div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-checkmark"></i> CLNUI-253 Project implemen...</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-checkmark"></i> CLNUI-234 Active history iss...</a>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-clock"></i> CLNUI-424 Ionicons intergrat...</a>
                            <a class="dropdown-item" href="javascript:void(0)">More...</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header">Filters</div>
                            <a class="dropdown-item" href="javascript:void(0)">My open issues</a>
                            <a class="dropdown-item" href="javascript:void(0)">Reported by me</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Import issues from CSV</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <i class="dropdown-inline-button-icon icmn-database"></i>
                            <span class="hidden-lg-down">Dashboards</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <div class="dropdown-header">Active</div>
                            <a class="dropdown-item" href="{{url('admin/project_dashboard')}}">Project Management</a>
                            <a class="dropdown-item" href="{{url('admin/portfolio_dashboard')}}">Portfolio Management</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="left hidden-md-down">
                <div class="example-top-menu-chart">
                    <span class="title">Income:</span>
                    <span class="chart" id="topMenuChart">1,3,2,0,3,1,2,3,5,2</span>
                    <span class="count">425.00 USD</span>
                </div>
            </div>
            <div class="right hidden-md-down margin-left-20">
                <div class="search-block">
                    <div class="form-input-icon form-input-icon-right">
                        <i class="icmn-search"></i>
                        <input type="text" class="form-control form-control-sm form-control-rounded" placeholder="Search...">
                        <button type="submit" class="search-block-submit "></button>
                    </div>
                </div>
            </div>
            <div class="right example-buy-btn hidden-xs-down">
            </div>
        </div>
    </div>
</nav>
