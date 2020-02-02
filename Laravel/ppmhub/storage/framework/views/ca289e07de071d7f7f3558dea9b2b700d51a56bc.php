<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $__env->yieldContent('title'); ?></title>

        <link href="../assets/common/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
        <link href="../assets/common/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
        <link href="../assets/common/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
        <link href="../assets/common/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
        <link href="../assets/common/img/favicon.png" rel="icon" type="image/png">
        <link href="favicon.ico" rel="shortcut icon">

        <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Vendors Styles -->
        <!-- v1.0.0 -->
		 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/dashboard/style.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/common/css/source/themes/style.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/bootstrap/dist/css/bootstrap.min.css')); ?>">



        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/jscrollpane/style/jquery.jscrollpane.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/ladda/dist/ladda-themeless.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/select2/dist/css/select2.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/fullcalendar/dist/fullcalendar.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/cleanhtmlaudioplayer/src/player.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/cleanhtmlvideoplayer/src/player.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/bootstrap-sweetalert/dist/sweetalert.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/summernote/dist/summernote.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/owl.carousel/dist/assets/owl.carousel.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/ionrangeslider/css/ion.rangeSlider.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/datatables/media/css/dataTables.bootstrap4.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/c3/c3.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/chartist/dist/chartist.min.css')); ?>">
        <!-- v1.4.0 -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/nprogress/nprogress.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/jquery-steps/demo/css/jquery.steps.css')); ?>">
        <!-- v1.4.2 -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>">
        <!-- v1.7.0 -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/dropify/dist/css/dropify.min.css')); ?>">

        <!-- Clean UI Styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/editable-grid/editable_custom.css')); ?>" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/common/css/source/main.css')); ?>">
        <!-- Vendors Scripts -->
        <!-- v1.0.0 -->
        <script src="<?php echo e(asset('vendors/jquery/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/tether/dist/js/tether.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jquery-mousewheel/jquery.mousewheel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jscrollpane/script/jquery.jscrollpane.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/spin.js/spin.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/ladda/dist/ladda.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/select2/dist/js/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/html5-form-validation/dist/jquery.validation.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jquery-typeahead/dist/jquery.typeahead.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/autosize/dist/autosize.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/bootstrap-show-password/bootstrap-show-password.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/moment/min/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/cleanhtmlaudioplayer/src/jquery.cleanaudioplayer.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/cleanhtmlvideoplayer/src/jquery.cleanvideoplayer.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/bootstrap-sweetalert/dist/sweetalert.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/summernote/dist/summernote.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/owl.carousel/dist/owl.carousel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/ionrangeslider/js/ion.rangeSlider.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/nestable/jquery.nestable.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/datatables/media/js/dataTables.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/datatables-fixedcolumns/js/dataTables.fixedColumns.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/datatables-responsive/js/dataTables.responsive.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/editable-table/mindmup-editabletable.js')); ?>"></script>
        <script src="<?php echo e(url('http://cdn.datatables.net/plug-ins/1.10.15/api/sum().js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/handsontable/handsontable.full.js')); ?>"></script>

        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid_editors.js')); ?>" ></script>
        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid_renderers.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid_utils.js')); ?>" ></script>
        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid_validators.js')); ?>" ></script>
        <script src="<?php echo e(asset('vendors/editable-grid/editablegrid_charts.js')); ?>" ></script>
        <link rel="stylesheet" href="<?php echo e(asset('vendors/editable-grid/editablegrid.css')); ?>" type="text/css" media="screen">


        <script src="<?php echo e(asset('vendors/d3/d3.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/c3/c3.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/chartist/dist/chartist.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/peity/jquery.peity.min.js')); ?>"></script>
        <!-- v1.0.1 -->
        <script src="<?php echo e(asset('vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js')); ?>"></script>
        <!-- v1.1.1 -->
        <script src="<?php echo e(asset('vendors/gsap/src/minified/TweenMax.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/hackertyper/hackertyper.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jquery-countTo/jquery.countTo.js')); ?>"></script>
        <!-- v1.4.0 -->
        <script src="<?php echo e(asset('vendors/nprogress/nprogress.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/jquery-steps/build/jquery.steps.min.js')); ?>"></script>
        <!-- v1.4.2 -->
        <script src="<?php echo e(asset('vendors/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/chart.js/src/Chart.bundle.min.js')); ?>"></script>
        <!-- v1.7.0 -->
        <script src="<?php echo e(asset('vendors/dropify/dist/js/dropify.min.js')); ?>"></script>
        <!-- Clean UI Scripts -->
        <script src="<?php echo e(asset('vendors/common/js/common.js')); ?>"></script>
        <script src="<?php echo e(asset('vendors/common/js/demo.temp.js')); ?>"></script>
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(env('GOOGLE_ANALYTICS_APP_KEY')); ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments)};
          gtag('js', new Date());

           gtag('config', '<?php echo e(env("GOOGLE_ANALYTICS_APP_KEY")); ?>');
        </script>
        <script>
            if (!Array.prototype.forEach) {

                Array.prototype.forEach = function (callback/*, thisArg*/) {

                    var T, k;

                    if (this == null) {
                        throw new TypeError('this is null or not defined');
                    }

                    // 1. Let O be the result of calling toObject() passing the
                    // |this| value as the argument.
                    var O = Object(this);

                    // 2. Let lenValue be the result of calling the Get() internal
                    // method of O with the argument "length".
                    // 3. Let len be toUint32(lenValue).
                    var len = O.length >>> 0;

                    // 4. If isCallable(callback) is false, throw a TypeError exception. 
                    // See: http://es5.github.com/#x9.11
                    if (typeof callback !== 'function') {
                        throw new TypeError(callback + ' is not a function');
                    }

                    // 5. If thisArg was supplied, let T be thisArg; else let
                    // T be undefined.
                    if (arguments.length > 1) {
                        T = arguments[1];
                    }

                    // 6. Let k be 0.
                    k = 0;

                    // 7. Repeat while k < len.
                    while (k < len) {

                        var kValue;

                        // a. Let Pk be ToString(k).
                        //    This is implicit for LHS operands of the in operator.
                        // b. Let kPresent be the result of calling the HasProperty
                        //    internal method of O with argument Pk.
                        //    This step can be combined with c.
                        // c. If kPresent is true, then
                        if (k in O) {

                            // i. Let kValue be the result of calling the Get internal
                            // method of O with argument Pk.
                            kValue = O[k];

                            // ii. Call the Call internal method of callback with T as
                            // the this value and argument list containing kValue, k, and O.
                            callback.call(T, kValue, k, O);
                        }
                        // d. Increase k by 1.
                        k++;
                    }
                    // 8. return undefined.
                };
            }
        </script>
        <!-- live chat js -->
        <!--<script type="text/javascript" src="http://www.ppmhub.com.au/public/jarvis/widget"></script>-->

        <style>
            .no-pade{padding: 0 !important;}
            .active-btn{background: green none repeat scroll 0 0 !important;}
            .inactive-btn{background-color: #f00 !important;}
            * {margin: 0; padding: 0;}

            .tree ul {
                padding-top: 20px; position: relative;

                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }

            .tree li {
                float: left; text-align: center;
                list-style-type: none;
                position: relative;
                padding: 20px 5px 0 5px;

                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }



            .tree li::before, .tree li::after{
                content: '';
                position: absolute; top: 0; right: 50%;
                border-top: 2px solid #ccc;
                width: 50%; height: 20px;
            }
            .tree li::after{
                right: auto; left: 50%;
                border-left: 2px solid #ccc;
            }


            .tree li:only-child::after, .tree li:only-child::before {
                display: none;
            }

            .tree li:only-child{ padding-top: 0;}


            .tree li:first-child::before, .tree li:last-child::after{
                border: 0 none;
            }
            .tree li:last-child::before{
                border-right: 2px solid #ccc;
                border-radius: 0 5px 0 0;
                -webkit-border-radius: 0 5px 0 0;
                -moz-border-radius: 0 5px 0 0;
            }
            .tree li:first-child::after{
                border-radius: 5px 0 0 0;
                -webkit-border-radius: 5px 0 0 0;
                -moz-border-radius: 5px 0 0 0;
            }

            .tree ul ul::before{
                content: '';
                position: absolute; top: 0; left: 50%;
                border-left: 2px solid #ccc;
                width: 0; height: 20px;
            }

            .tree li a{
                border: 2px solid #ccc;
                padding: 5px 12px;
                text-decoration: none;
                color: #fff;
                font-family: arial, verdana, tahoma;
                font-size: 14px;
                display: inline-block;
                background-color: #004da6;	
                border-radius: 5px;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;

                transition: all 0.5s;
                -webkit-transition: all 0.5s;
                -moz-transition: all 0.5s;
            }

            .tree li a:hover, .tree li a:hover+ul li a {
                background: #c8e4f8; color: #000; border: 2px solid #94a0b4;
            }
            .tree li a:hover+ul li::after, 
            .tree li a:hover+ul li::before, 
            .tree li a:hover+ul::before, 
            .tree li a:hover+ul ul::before{
                border-color:  #94a0b4;
            }

            .tree-struc .choose-port1 {
                float: left;
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 25px;
                margin-right: 20px;
            }
            .tree-struc select {
                float: left;
                width: 250px;
            }



            .dropdown-menu.setBoxWidth__Recent {
                width: 300px; 
            }
            .ddplace{

                position: relative; top: 6px; left: -23px;}

            .setBoxWidth__Recent li {display: contents;}
            .paddingSet__History{padding: 10px;}

            .setratio{
                position: absolute;
                left: 75px;
                z-index: 999;
                margin-top: 13px;


            }

            .FilterSearch{
                left: 86px;

            }
            .FilterSearch li{  padding: 15px;}
            .FilterSearch li,
            #PhaseIdSet_Filter .dropdown-menu li,
            #PhaseIdSet_FilterAssignee .dropdown-menu li,
            #PhaseIdSet_FilterprojectId .dropdown-menu li,
            #PhaseIdSet_FilterPriority .dropdown-menu li
            {
                display: block;
                float: none;

            }
            .FilterSearch li:hover{
                background: #ececec;
                cursor: pointer;

            }
            .FilterSearch li i {
                padding-right: 10px;    
            }
            .searchbarset{
                padding-left: 30px;

            }
            #PhaseIdSet_Filter .btn-group {
                left: 41px;
                margin-top: 45px;
                position: absolute;
                z-index: 999;
            }


            .filterlayer {
                left: 88px;
                margin-top: 4px;
                position: absolute;
                z-index: 999;
            }

            .lightSearch{

                background: #eaeaea none repeat scroll 0 0;
                padding: 6px 17px;

            }

            .darkSearch{

                background: #e2dede none repeat scroll 0 0;
                padding: 6px 17px;
            }


            .filterlayer div {
                float: left;
            }
        </style>
    </head>
    <body class="theme-dark menu-top menu-static colorful-enabled" ng-controller="MainCtrl">
      <?php echo $__env->make('layout.admin_layout_include.top_nav_bar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--        <nav class="left-menu" left-menu>
            <div class="logo-container">
                <a href="/admin/dashboard" class="logo">
                    <img src="<?php echo e(asset('vendors/common/img/ppm_logo.png')); ?>" alt="PPM HUB" />
                    <img class="logo-inverse" src="<?php echo e(asset('vendors/common/img/ppm_logo.png')); ?>" alt="PPM HUB" />
                </a>
            </div>
            <div class="left-menu-inner scroll-pane">
                <ul class="left-menu-list left-menu-list-root list-unstyled">
                       <li>
                         <a class="left-menu-link" href="<?php echo e(url('admin/portfolio')); ?>">
                             <i class="left-menu-link-icon icmn-books util-spin-delayed-pseudo"></i>
                             Portfolio
                         </a>
                     </li>
                     <li>
                         <a class="left-menu-link" href="<?php echo e(url('admin/buckets')); ?>">
                             <i class="left-menu-link-icon icmn-books util-spin-delayed-pseudo"></i>
                             Buckets
                         </a>
                     </li>
                   <li class="left-menu-list-separator "> </li>
                    li class="left-menu-list">
                        <a class="left-menu-link" href="<?php echo e(url('admin/bucketfp')); ?>">
                            <i class="left-menu-link-icon icmn-home2 util-spin-delayed-pseudo"></i>
                            Bucket Financial Planning
                        </a>
                    </li
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Portfolio Management
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/portfolio')); ?>">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/buckets')); ?>">
                                    Buckets
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/portfolioStructure')); ?>" >
                                    Portfolio Structure
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/bucketfp')); ?>">
                                    Portfolio Financial Planning
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/portfolioresourceplanning')); ?>">
                                    Portfolio Resource Planning
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="left-menu-list-separator"> </li>
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Project Management
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/project')); ?>">
                                    Project
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectphase')); ?>">
                                    Phase
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projecttask')); ?>">
                                    Task/Subtask
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectchecklist')); ?>">
                                    Checklist
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectissues')); ?>">
                                    Issue List
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectmilestone')); ?>">
                                    Milestone
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectcostplan')); ?>">
                                    Project Cost Plan
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectStructure')); ?>" >
                                    Project Structure
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectresourceplanning')); ?>">
                                    Project Resource Planning
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"></i>
                            Budget Management
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/originalbudget')); ?>">
                                    Budget Overview
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/original')); ?>">
                                    Project Original Budget
                                    Maintain Original Budget
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/supplement')); ?>">
                                    Budget Supplement
                                    Supplement Budget
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/returns')); ?>">
                                    Budget Return
                                    Return Budget
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/currentbudget')); ?>">
                                    Current Budget
                                    Current Budget
                                </a>
                            </li>
                        </ul>
                    </li>	
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Time Management
                        </a>
                        <ul class="left-menu-list list-unstyled">

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/employees')); ?>"> 
                                    Employee Personnel Records
                                </a> 
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/timesheetapprovals')); ?>">
                                    Time Approval settings
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/timesheetprofiles')); ?>"> 	
                                    Time Sheet Profiles
                                </a> 
                            </li>					
                            <li> 
                                <a class="left-menu-link" href="<?php echo e(url('admin/timesheetview')); ?>"> 
                                    Time Sheet Management 
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Risk Management
                        </a>
                        <ul class="left-menu-list list-unstyled">

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/riskregister')); ?>">
                                    Risk Register
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/quantitative_risk')); ?>">
                                    Quantitative Risk
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/qualitative_risk')); ?>">
                                    Qualitative Risk
                                </a>
                            </li>
                        </ul>
                    </li>

                    New Procurement menu
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Procurement
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/vendor')); ?>">
                                    Vendor Master
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/material_master')); ?>">
                                    Material Master
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/service_master')); ?>">
                                    Service Master
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/purchase_requisition')); ?>">
                                    Purchase Requisition
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/purchase_order')); ?>">
                                    Purchase Order
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/contract')); ?>">
                                    Create Contract 
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/goods_receipt')); ?>">
                                    Goods Receipt                                </a>
                            </li>


                        </ul>
                    </li>
                    New Procurement menu

                    New Sales Order menu
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"> </i>
                            Sales Order
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/customer_master')); ?>">
                                    Customer Master
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/customer_inquiry')); ?>">
                                    Customer Inquiry
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/quotation')); ?>">
                                    Quotation
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/sales_order')); ?>">
                                    Sales Order
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            <i class="left-menu-link-icon icmn-files-empty2 util-spin-delayed-pseudo"></i>
                            Report Management
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/costbudget')); ?>">
                                    Cost Budget Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/checklistreport')); ?>">
                                    Check List Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/milestonereport')); ?>">
                                    Milestone Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/riskanalysis')); ?>">
                                    Project Risk analysis Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectdefinitiondetail')); ?>">
                                    Project Definition Detail Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/phasedetail')); ?>">
                                    Phase Detail Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/salesreport')); ?>">
                                    Project Sales Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/timesheet')); ?>">
                                    Project Timesheet Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/taskdetail')); ?>">
                                    Project Task Detail Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projectportfolio')); ?>">
                                    Projects In Portfolio Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/purchaserequisition')); ?>">                            
                                    Purchase Requisitions For Project Report
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/purchaseorder')); ?>">                            
                                    Purchase Order For Project Report
                                </a>
                            </li>

                        </ul>
                    </li>
                    New Sales Order menu

                    <li class="left-menu-list-submenu">
                        <a class="left-menu-link" href="javascript: void(0);">
                            <i class="left-menu-link-icon icmn-cart5"> </i>
                            Settings
                        </a>
                        <ul class="left-menu-list list-unstyled">
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/portfoliotypes')); ?>">
                                    Portfolio Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/projecttype')); ?>">
                                    Project Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/phasetype')); ?>">
                                    Phase Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/currencies')); ?>">
                                    Currency
                                </a>
                            </li>
                             <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/inquirynumber_range')); ?>">
                                    Inquiry Number Range
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/inquiry_type')); ?>">
                                    Inquiry Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/salesregion')); ?>">
                                    Sales Region
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/GlAccount')); ?>">
                                    Gl Account
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/GlAccountTax')); ?>">
                                    Gl Account Tax
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/GlAccountFreight')); ?>">
                                    Gl Account Freight
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/GlAccountDownPayment')); ?>">
                                    Gl Account Down Payment
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/capacityunits')); ?>">
                                    Capacity Units
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/periodtype')); ?>">
                                    Period Types
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/planningunit')); ?>">
                                    Planning Unit
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/planningtype')); ?>">
                                    Planning Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/costingtype')); ?>">
                                    Costing Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/collectiontype')); ?>">
                                    Collection Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/viewtype')); ?>">
                                    View Type
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/personresponsible')); ?>">
                                    Person Responsible
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/departmenttype')); ?>">
                                    Department
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/costcentretype')); ?>">
                                    Cost Centre
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/location')); ?>">
                                    Project Location
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/factorycalendar')); ?>">
                                    Factory Calendar
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/activityrates')); ?>">
                                    Activity Rates 
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/costcentres')); ?>">
                                    Cost Centres 
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/activitytypes')); ?>">
                                    Activity Types 
                                </a>
                            </li>	
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addBank')); ?>">
                                    Bank name
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addCategory')); ?>">
                                    Material Category
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addGroup')); ?>">
                                    Material Group
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addUnitOfMeasure')); ?>">
                                    Unit Of Measure
                                </a>
                            </li>
                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addOrderingUnit')); ?>">
                                    Ordering Unit
                                </a>
                            </li>



                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addMilestone')); ?>">
                                    Milestone type
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/addMatrix')); ?>">
                                    Qualitative Risk Matrix
                                </a>
                            </li>

                            <li>
                                <a class="left-menu-link" href="<?php echo e(url('admin/QuantitativeRiskScore')); ?>">
                                    Quantitative Risk Score
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="left-menu-list-separator"> </li>
                    <li class="menu-top-hidden no-colorful-menu">
                        <div class="left-menu-item">
                            Last Week Sales
                        </div>
                    </li>
                    <li class="menu-top-hidden no-colorful-menu">
                        <div class="example-left-menu-chart chartist-animated chartist-theme-dark"></div>
                        <script>
                                    $(function () {
                                        // CSS STYLING & ANIMATIONS
                                        var cssAnimationData = {
                                            labels: ["S", "M", "T", "W", "T", "F", "S"],
                                            series: [
                                                [11, 14, 24, 16, 20, 16, 24]
                                            ]
                                        },
                                        cssAnimationOptions = {
                                            fullWidth: !0,
                                            chartPadding: {
                                                right: 2,
                                                left: 30
                                            },
                                            axisY: {
                                                position: 'end'
                                            }
                                        },
                                        cssAnimationResponsiveOptions = [
                                            [{
                                                    axisX: {
                                                        labelInterpolationFnc: function (value, index) {
                                                            return index % 2 !== 0 ? !1 : value
                                                        }
                                                    }
                                                }]
                                        ];

                                        new Chartist.Line(".example-left-menu-chart", cssAnimationData, cssAnimationOptions, cssAnimationResponsiveOptions);

                                    });
                        </script>
                    </li>
                    <li class="menu-top-hidden no-colorful-menu">
                        <div class="left-menu-item">
                            Solar System
                        </div>
                    </li>
                    <li class="menu-top-hidden">
                        <div class="left-menu-item">
                            <span class="donut donut-success"></span> Jupiter
                        </div>
                    </li>
                    <li class="menu-top-hidden">
                        <div class="left-menu-item">
                            <span class="donut donut-primary"></span> Earth
                        </div>
                    </li>
                    <li class="menu-top-hidden">
                        <div class="left-menu-item">
                            <span class="donut donut-danger"></span> Mercury
                        </div>
                    </li>
                </ul>
            </div>
        </nav>-->
        <style>
            .head-brd{
                border: 0px;
            }
            .por-struc{
                padding: 15px 100px 30px;
            }
            .choose-port {
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 25px;
            }
            .submit-btn {
                text-align: center;
            }
            .btn12{
                padding: 7px 30px;
            }
            .por-struc .form-group {
                text-align: center;
            }
        </style>


        <nav class="top-menu">
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
                                <img src="<?php echo e(asset('vendors/common/img/temp/avatars/1.jpg')); ?>" alt="Alternative text to the image">
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
                            <a class="dropdown-item" href="<?php echo e(url('admin/logout')); ?>"><i class="dropdown-icon icmn-exit"></i> Logout</a>
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
                                    <span class="caret"></span>
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
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="" role="menu">
                                    <div class="dropdown-header">Active</div>
                                    <a class="dropdown-item" href="<?php echo e(url('admin/project_dashboard')); ?>">Project Management</a>
									<a class="dropdown-item" href="<?php echo e(url('admin/portfolio_dashboard')); ?>">Portfolio Management</a>
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

                            <!-- Top Menu Chart Script -->
                            <script>
                                        $(function () {

                                            var topMenuChart = $("#topMenuChart").peity("bar", {
                                                fill: ['#01a8fe'],
                                                height: 22,
                                                width: 44
                                            });

                                            setInterval(function () {
                                                var random = Math.round(Math.random() * 10);
                                                var values = topMenuChart.text().split(",");
                                                values.shift();
                                                values.push(random);
                                                topMenuChart.text(values.join(",")).change()
                                            }, 1000);

                                        });
                            </script>
                            <!-- Top Menu Chart Script -->
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
                        <!--a href="https://themeforest.net/item/clean-ui-premium-bootstrap-4-admin-template-angular-starter-kit/16678285?s_rank=4&ref=mediatec_software" target="_blank" class="btn btn-success-outline btn-rounded">
                            Buy Now 25$
                        </a-->
                    </div>
                </div>
            </div>
        </nav>

        <section class="page-content">
            <div class="page-content-inner">

                <?php $__env->startSection('body'); ?>
                <?php echo $__env->yieldSection(); ?>
            </div>


            <!-- Page Scripts -->
            <script>
						$('.report_info').delay(5000).fadeOut('slow');
                        $(function () {
                            $('#example3').DataTable({
                                scrollX: true,
                                lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
                                responsive: true,
                                autoWidth: false
                            });
                        });

                        var datatables = $('table.dataTablesSpecial').DataTable();

                        $(function () {

                            ///////////////////////////////////////////////////////////
                            // COUNTERS
                            $('.counter-init').countTo({
                                speed: 1500
                            });

                            ///////////////////////////////////////////////////////////
                            // ADJUSTABLE TEXTAREA
                            autosize($('#textarea'));

                            ///////////////////////////////////////////////////////////
                            // CUSTOM SCROLL
                            if (!cleanUI.hasTouch) {
                                $('.custom-scroll').each(function () {
                                    $(this).jScrollPane({
                                        autoReinitialise: true,
                                        autoReinitialiseDelay: 100
                                    });
                                    var api = $(this).data('jsp'),
                                            throttleTimeout;
                                    $(window).bind('resize', function () {
                                        if (!throttleTimeout) {
                                            throttleTimeout = setTimeout(function () {
                                                api.reinitialise();
                                                throttleTimeout = null;
                                            }, 50);
                                        }
                                    });
                                });
                            }

                            ///////////////////////////////////////////////////////////
                            // CALENDAR
                            $('.example-calendar-block').fullCalendar({
                                //aspectRatio: 2,
                                height: 450,
                                header: {
                                    left: 'prev, next',
                                    center: 'title',
                                    right: 'month, agendaWeek, agendaDay'
                                },
                                buttonIcons: {
                                    prev: 'none fa fa-arrow-left',
                                    next: 'none fa fa-arrow-right',
                                    prevYear: 'none fa fa-arrow-left',
                                    nextYear: 'none fa fa-arrow-right'
                                },
                                editable: true,
                                eventLimit: true, // allow "more" link when too many events
                                viewRender: function (view, element) {
                                    if (!cleanUI.hasTouch) {
                                        $('.fc-scroller').jScrollPane({
                                            autoReinitialise: true,
                                            autoReinitialiseDelay: 100
                                        });
                                    }
                                },
                                defaultDate: '2016-05-12',
                                events: [
                                    {
                                        title: 'All Day Event',
                                        start: '2016-05-01',
                                        className: 'fc-event-success'
                                    },
                                    {
                                        id: 999,
                                        title: 'Repeating Event',
                                        start: '2016-05-09T16:00:00',
                                        className: 'fc-event-default'
                                    },
                                    {
                                        id: 999,
                                        title: 'Repeating Event',
                                        start: '2016-05-16T16:00:00',
                                        className: 'fc-event-success'
                                    },
                                    {
                                        title: 'Conference',
                                        start: '2016-05-11',
                                        end: '2016-05-14',
                                        className: 'fc-event-danger'
                                    }
                                ],
                                eventClick: function (calEvent, jsEvent, view) {
                                    if (!$(this).hasClass('event-clicked')) {
                                        $('.fc-event').removeClass('event-clicked');
                                        $(this).addClass('event-clicked');
                                    }
                                }
                            });

                            ///////////////////////////////////////////////////////////
                            // CAROUSEL WIDGET
                            $('.carousel-widget').carousel({
                                interval: 4000
                            });

                            $('.carousel-widget-2').carousel({
                                interval: 6000
                            });

                            ///////////////////////////////////////////////////////////
                            // DATATABLES
                            $('#example1').DataTable({
                                responsive: true,
                                "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
                            });

                            ///////////////////////////////////////////////////////////
                            // CHART 1
                            new Chartist.Line(".chart-line", {
                                labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                                series: [
                                    [12, 9, 7, 8, 5],
                                    [2, 1, 3.5, 7, 3],
                                    [1, 3, 4, 5, 6]
                                ]
                            }, {
                                fullWidth: !0,
                                chartPadding: {
                                    right: 40
                                },
                                plugins: [
                                    Chartist.plugins.tooltip()
                                ]
                            });

                            ///////////////////////////////////////////////////////////
                            // CHART 2
                            var overlappingData = {
                                labels: ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                series: [
                                    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
                                    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
                                ]
                            },
                            overlappingOptions = {
                                seriesBarDistance: 10,
                                plugins: [
                                    Chartist.plugins.tooltip()
                                ]
                            },
                            overlappingResponsiveOptions = [
                                ["", {
                                        seriesBarDistance: 5,
                                        axisX: {
                                            labelInterpolationFnc: function (value) {
                                                return value[0]
                                            }
                                        }
                                    }]
                            ];

                            new Chartist.Bar(".chart-overlapping-bar", overlappingData, overlappingOptions, overlappingResponsiveOptions);


                        });
            </script>
            <!-- End Page Scripts -->

        </section>

        <script>
                    $(function () {

                        $('.select2').select2();
                        $('.select2-tags').select2({
                            tags: true,
                            tokenSeparators: [',', ' ']
                        });

                        $('.selectpicker').selectpicker();

                    })

                    $('.datepicker-only-init').datetimepicker({
                        widgetPositioning: {
                            horizontal: 'left'
                        },
                        icons: {
                            time: "fa fa-clock-o",
                            date: "fa fa-calendar",
                            up: "fa fa-arrow-up",
                            down: "fa fa-arrow-down"
                        },
                        format: 'YYYY-MM-DD'
                    });
        </script>





        <script>
                    $(function () {


                        $('#descriptionIssues').keypress(function (e) {
                            var tval = $('#descriptionIssues').val(),
                                    tlength = tval.length,
                                    set = 300,
                                    remain = parseInt(set - tlength);
                            $('.counterText').html('' + remain + ' Characters');
                            $('.redset').css('background', 'green');
                            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                                // return false;
                                $('.redset').css('background', 'red');
                                $('.redset').html('Maximum 300 Characters');
                            }
                        })



                        $("#ProjectListGet").change(function () {
                            var idPadre = $("#ProjectListGet option:selected").val();
                            var token = '<?php echo e(csrf_token()); ?>';
                            if (idPadre !== '') {
                                $.ajax({
                                    method: "POST",
                                    url: "<?php echo e(url('admin/getProjectname')); ?>",
                                    data: {id: idPadre, '_token': token}
                                }).done(function (response) {
                                    var obj = jQuery.parseJSON(response);
                                    var data = obj.phaseList;
                                    $('#PhaseIdSet,#TaskIdSet,#AssigneeTasks').html('<option value="" selected> Please select </option>');
                                    $('#project_nameDesc,#phase_name,#setTaskName').html('');
                                    $.each(data, function (index, value) {
                                        $('#PhaseIdSet').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                                    });
                                    $('#project_nameDesc').html(obj.desc[0]);
                                    $('#ProjectListGet,#PhaseIdSet,#TaskIdSet,#AssigneeTasks').selectpicker('refresh');
                                });
                            }
                        });


                        $("#PhaseIdSet").change(function () {
                            var idPadre = $("#PhaseIdSet option:selected").val();
                            var token = '<?php echo e(csrf_token()); ?>';
                            if (idPadre !== '') {
                                $.ajax({
                                    method: "POST",
                                    url: "<?php echo e(url('admin/getProjectPhase')); ?>",
                                    data: {id: idPadre, '_token': token}
                                }).done(function (response) {
                                    var obj = jQuery.parseJSON(response);
                                    var data = obj.phaseList;
                                    $('#TaskIdSet,#AssigneeTasks').html('<option value="" selected>Please select</option>');
                                    $('#phase_name,#setTaskName').html('');
                                    $.each(data, function (index, value) {
                                        $('#TaskIdSet').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                                    });
                                    $('#phase_name').html(obj.desc[0]);
                                    $('#PhaseIdSet,#TaskIdSet,#AssigneeTasks').selectpicker('refresh');
                                });
                            }
                        });

                        $("#TaskIdSet").change(function () {
                            var idPadre = $("#TaskIdSet option:selected").val();
                            var token = '<?php echo e(csrf_token()); ?>';
                            if (idPadre !== '') {
                                $.ajax({
                                    method: "POST",
                                    url: "<?php echo e(url('admin/getProjectTask')); ?>",
                                    data: {id: idPadre, '_token': token}
                                }).done(function (response) {
                                    var obj = jQuery.parseJSON(response);
                                    var data = obj.phaseList;
                                    $('#AssigneeTasks').html('<option value="" selected>Please select</option>');
                                    $('#setTaskName').html('');
                                    //alert(obj.desc[0]);
                                    $.each(data, function (index, value) {
                                        $('#AssigneeTasks').append('<option value="' + value[0] + '">' + value[1] + '</option>');
                                    });
                                    $('#setTaskName').html(obj.desc[0]);
                                    $('#TaskIdSet,#AssigneeTasks').selectpicker('refresh');

                                });
                            }
                        });



                        $('.tabgroup > div').hide();
                        $('.tabgroup > div:first-of-type').show();
                        $('.tabs a').click(function (e) {
                            e.preventDefault();
                            var $this = $(this),
                                    tabgroup = '#' + $this.parents('.tabs').data('tabgroup'),
                                    others = $this.closest('li').siblings().children('a'),
                                    target = $this.attr('href');
                            others.removeClass('active');
                            $this.addClass('active');
                            $(tabgroup).children('div').hide();
                            $(target).show();

                        })




                        /* setTimeout(function(){
                         
                         $('#dsd').html('fdfdfdfdf');
                         
                         alert("Hello");
                         }, 3000);*/


                        $('.selectpicker').selectpicker('refresh');
                        $('#tabs').tab();

                        var fileAttachmentsCounter = 0;
                        var AttachmentButton = function (context) {
                            var ui = $.summernote.ui;

                            // create button
                            var button = ui.button({
                                contents: '<i style="font-size: 14px" class="note fa fa-paperclip"/>',
                                tooltip: 'Add attachment',
                                click: function () {
                                    // invoke insertText method with 'hello' on editor module.
                                    fileAttachmentsCounter++;
                                    $('.note-editing-area').append('<input type="file" style="display: none;" name="fileToUpload[]" id="fileToUpload' + fileAttachmentsCounter + '"/>');
                                    $('#fileToUpload' + fileAttachmentsCounter).trigger('click');
                                    $('#fileToUpload' + fileAttachmentsCounter).change(function (ev) {
                                        $('.note-editing-area').append('<div id="attachment-' + fileAttachmentsCounter + '"><span  style="font-size: 16px"><i class="note fa fa-paperclip"/>&nbsp;&nbsp;&nbsp;&nbsp;<u>' + $(this).val().split("\\")[$(this).val().split.length] + '</u><i/>&nbsp;&nbsp<i class="note fa fa-times" onclick="{$(`#fileToUpload' + fileAttachmentsCounter + '`).remove();$(`#attachment-' + fileAttachmentsCounter + '`).remove();}"/></span></div>')

                                    });
                                }
                            });

                            return button.render();   // return button as jquery object 
                        }

                        $('.texteditorSet').summernote({
                            height: 150,
                            toolbar: [
                                ['style', ['style']],
                                ['font', ['bold', 'italic', 'underline', 'clear']],
                                ['fontname', ['fontname']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview']],
                                ['help', ['help']],
                                ['mybutton', ['attachment']]],
                            buttons: {
                                attachment: AttachmentButton
                            }
                        }
                        );



                        $(".setLikeUnlike button").click(function () {

                            var islikevalue = $(this).attr('data-like');
                            var getissueId = $(this).attr('data-issue');

                            if (islikevalue == 1) {

                                $(this).addClass('btn-success');
                                $('.setLikeUnlike button').removeClass('btn-danger');

                            }

                            if (islikevalue == 2) {

                                $(this).addClass('btn-danger');
                                $('.setLikeUnlike button').removeClass('btn-success');

                            }


                            var token = '<?php echo e(csrf_token()); ?>';
                            $.ajax({
                                method: "POST",
                                url: "<?php echo e(url('admin/addLikeIssus')); ?>",
                                data: {id: getissueId, '_token': token, 'islikevalue': islikevalue}
                            }).done(function (response) {
                                var obj = jQuery.parseJSON(response);

                                $('.likes').html(obj.Like);
                                $('.dislikes').html(obj.unlike);

                            });

                        });



                        $("#OpenPhaseIdSet_Filter").click(function () {
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="lightSearch authorSe">@author</div>');
                            $('#PhaseIdSet_Filter').toggle();

                            $('#authorSelectFilter').trigger('click');


                        });


                        $("#assigneeSE").click(function () {
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="lightSearch assigneSe">@assignee</div>');
                            $('#PhaseIdSet_FilterAssignee').toggle();

                        });


                        $("#ProjectIdSe").click(function () {
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="lightSearch projecIDse">@assignee</div>');
                            $('#PhaseIdSet_FilterprojectId').toggle();

                        });


                        $("#prioritySe").click(function () {
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="lightSearch prioriSe">@assignee</div>');
                            $('#PhaseIdSet_FilterPriority').toggle();

                        });








                        $('#authorSelectFilter').change(function () {
                            var gettype = $('#authorSelectFilter option:selected').text();
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="darkSearch authorSe">' + gettype + ' <div class="removeToken" data-remove="author" role="button"><i class="fa fa-close"></i></div></div>');
                            $('#PhaseIdSet_Filter').toggle();
                            $('#OpenPhaseIdSet_Filter').hide();
                        });


                        $('#FilterAssignee').change(function () {
                            var gettype = $('#FilterAssignee option:selected').text();
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="darkSearch assigneSe">' + gettype + ' <div class="removeToken" data-remove="assinee" role="button"><i class="fa fa-close"></i></div></div>');
                            $('#PhaseIdSet_FilterAssignee').toggle();
                            $('#assigneeSE').hide();
                        });


                        $('#FilterProjectId').change(function () {
                            var gettype = $('#FilterProjectId option:selected').text();
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="darkSearch projecIDse">' + gettype + ' <div class="removeToken" data-remove="projecIDse" role="button"><i class="fa fa-close"></i></div></div>');
                            $('#PhaseIdSet_FilterprojectId').toggle();
                            $('#ProjectIdSe').hide();
                        });


                        $('#FilterPriority').change(function () {
                            var gettype = $('#FilterPriority option:selected').text();
                            $('.searchbarset').attr('placeholder', '');
                            $('.filterlayer').append('<div class="darkSearch prioriSe">' + gettype + ' <div class="removeToken" data-remove="prioriSe" role="button"><i class="fa fa-close"></i></div></div>');
                            $('#PhaseIdSet_FilterPriority').toggle();
                            $('#prioritySe').hide();
                        });






                        $(document).on('click', ".removeToken", function () {
                            // $(".removeToken").on("click",function(e) {   

                            var getname = $(this).attr('data-remove');
                            // alert(getname);
                            if (getname == 'author') {

                                $('#OpenPhaseIdSet_Filter').show();
                                $('#authorSelectFilter').selectpicker('refresh');
                                $('.authorSe').remove();

                                if ($('.filterlayer')[0]) {
                                    $('.searchbarset').attr('placeholder', 'Search..');
                                }

                            }

                            if (getname == 'assinee') {
                                $('#assigneeSE').show();
                                $('#FilterAssignee').selectpicker('refresh');
                                $('.assigneSe').remove();
                                if ($('.filterlayer')[0]) {
                                    $('.searchbarset').attr('placeholder', 'Search..');
                                }
                            }



                            if (getname == 'projecIDse') {
                                $('#ProjectIdSe').show();
                                $('#FilterProjectId').selectpicker('refresh');
                                $('.projecIDse').remove();
                                if ($('.filterlayer')[0]) {
                                    $('.searchbarset').attr('placeholder', 'Search..');
                                }
                            }


                            if (getname == 'prioriSe') {
                                $('#prioritySe').show();
                                $('#FilterPriority').selectpicker('refresh');
                                $('.prioriSe').remove();
                                if ($('.filterlayer')[0]) {
                                    $('.searchbarset').attr('placeholder', 'Search..');
                                }
                            }



                        });





                        $("#searchpress").click(function () {
                            $("#targetSearch").submit();

                        });





                    });

                    $(document).ready(function () {
                        $("body").on('focusout', function (evt) {
                            if (evt.target.type == 'number')
                            {
                                if (evt.target.value < 0) {
                                    evt.target.value *= -1;
                                }
                            }
                        });
                    });


        </script>

        <!-- End Page Scripts -->

        <div class="cwt__footer visible-footer">
            <!--div class="cwt__footer__top">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="cwt__footer__title cwt__footer__title--light">
                            Check Out Preselected Demos
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index.html#/dashboards/alpha" class="cwt__footer__link">Vertical Menu (Default)</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_menu_shadow_superclean.html#/ecommerce/products-catalog" class="cwt__footer__link">Ecommerce Version</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_horizontal_boxed_container.html#/dashboards/alpha" class="cwt__footer__link">Horizontal Menu + Boxed Container</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_iconbar.html#/dashboards/alpha" class="cwt__footer__link">Iconbar Vertical Menu</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_inverse.html#/dashboards/alpha" class="cwt__footer__link">Inverse Color Scheme</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_menu_shadow_superclean.html#/dashboards/alpha" class="cwt__footer__link">Super Clean Mode + Menu Shadow</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_horizontal.html#/dashboards/alpha" class="cwt__footer__link">Horizontal Menu</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_horizontal_compact.html#/dashboards/alpha" class="cwt__footer__link">Compact Horizontal Menu</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_boxed.html#/dashboards/alpha" class="cwt__footer__link">Vertical Menu + Boxed</a></li>
                                    <li><a target="_blank" href="http://cleanuitemplate.com/version_angular/index_horizontal_boxed.html#/dashboards/alpha" class="cwt__footer__link">Horizontal Menu + Boxed</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cwt__footer__title">
                            Clean UI Admin Template
                        </div>
                        <div class="cwt__footer__description">
                            <p>Clean UI – a modern professional admin template, based on Bootstrap 4
                                framework. Clean UI is a powerful and super flexible tool, which suits best for any
                                kind of web application: Web Applications; CRM; CMS; Admin Panels; Dashboards; etc.
                                Clean UI is fully responsive, which means that it looks perfect on mobiles and
                                tablets</p>

                            <p>Clean UI is fully based on SASS pre-processor, includes 50+ commented SASS files.
                                Each file corresponds to a single component, layout, page, plugin or extension –
                                so you can easily find necessary piece of code and edit it for your needs.
                                The package includes both normal and minified CSS files, compiled from SASS</p>
                        </div>
                    </div>
                </div>
            </div-->
            <div class="cwt__footer__bottom">
                <div class="row">
                    <div class="col-md-4">
                        <img class="cwt__footer__company-logo" src="<?php echo e(asset('vendors/common/img/ppm_logo.png')); ?>" target="_blank" title="PPM HUB">

                        <a>

                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="cwt__footer__company">

                            <span>
                                © 2017 <a href="ppmhub.com.au" class="cwt__footer__link" target="_blank">PPM HUB</a>
                                <br>
                                All rights reserved
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mask" style="display:none;">
                <img src='<?php echo e(asset('images/loader.gif')); ?>' alt="loader"/>
            </div>
        </div>
    </div>
    <!--<div class="main-backdrop"></div>-->

</body>
</html>