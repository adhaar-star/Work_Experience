<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>
        <link href="/favicon/favicon.ico" rel="shortcut icon">

        <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/common/css/source/themes/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/jscrollpane/style/jquery.jscrollpane.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/ladda/dist/ladda-themeless.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/editable-grid/editable_custom.css')}}" media="screen">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/common/css/source/main.css')}}">
        {!! Html::style('css/layout_admin_custom.css') !!}
    @yield('PageCss')
    </head>
    <body class="theme-dark menu-top menu-static colorful-enabled" ng-controller="MainCtrl">
    @include('layout.admin_layout_include.top_nav_bar')
    @include('layout.admin_layout_include.top_user_bar')
    <section class="page-content">
        <div class="page-content-inner">
            @yield('body')
        </div>
    </section>
    @include('layout.admin_layout_include.footer')


    <!-- HTML5 shim and Respond.js for < IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('vendors/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendors/tether/dist/js/tether.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/jquery-mousewheel/jquery.mousewheel.min.js')}}"></script>
    <script src="{{asset('vendors/jscrollpane/script/jquery.jscrollpane.min.js')}}"></script>
    <script src="{{asset('vendors/ladda/dist/ladda.min.js')}}"></script>
    <script src="{{asset('vendors/jquery-typeahead/dist/jquery.typeahead.min.js')}}"></script>
    <script src="{{asset('vendors/autosize/dist/autosize.min.js')}}"></script>
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('vendors/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('vendors/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('vendors/d3/d3.min.js')}}"></script>
    <script src="{{asset('vendors/c3/c3.min.js')}}"></script>
    <script src="{{asset('vendors/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('vendors/peity/jquery.peity.min.js')}}"></script>
    <!-- v1.0.1 -->
    <script src="{{asset('vendors/chartist-plugin-tooltip/dist/chartist-plugin-tooltip.min.js')}}"></script>

    <!-- Clean UI Scripts -->
    <script src="{{asset('vendors/common/js/common.js')}}"></script>
    <script src="{{asset('vendors/common/js/demo.temp.js')}}"></script>
    {!! Html::script('js/layout_admin_custom.js') !!}

    @yield('PageJquery')
 </body>
</html>