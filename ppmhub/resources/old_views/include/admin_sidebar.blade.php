<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('admin/portfolio')}}"><i class="fa fa-briefcase"></i> Portfolio </a>
                  <li><a href="{{url('admin/buckets')}}"><i class="fa fa-briefcase"></i> Buckets </a>
                  <li><a href="{{url('admin/bucketfp')}}"><i class="fa fa-briefcase"></i> Bucket Financial Planning </a>
                  <li><a ><i class="fa fa-cog"></i> Project <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('admin/project')}}">Project</a></li>
                      <li><a href="{{url('admin/projectphase')}}">Phase</a></li>
                      <li><a href="{{url('admin/projecttask')}}">Task/SubTask</a></li>
                      <li><a href="{{url('admin/projectchecklist')}}">Checklist</a></li>
                      <li><a href="#">Milestone</a></li>
                      <li><a href="#">Project Cost Plan</a></li>
                      <li><a href="#">Project Resource Plan</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('admin/portfoliotypes')}}">Portfolio Type</a></li>
					  <li><a href="{{url('admin/projecttype')}}">Project Type</a></li>
					  <li><a href="{{url('admin/phasetype')}}">Phase Type</a></li>
                      <!-- <li><a href="#">Fiscal Year</a></li> -->
                      <li><a href="{{url('admin/currencies')}}">Currency</a></li>
                      <li><a href="{{url('admin/capacityunits')}}">Capacity Units</a></li>
                      <li><a href="{{url('admin/periodtype')}}">Period Types</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('admin/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

