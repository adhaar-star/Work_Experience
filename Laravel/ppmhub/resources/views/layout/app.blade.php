<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">      
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Online Project Planning Software | @yield('title')</title>
        <!-- Favicon | Icon Script -->
        <link rel="icon" type="image/png" href="{{asset('new_images/common/icon.png')}}" />
        <link rel="stylesheet" media="screen" href="{{asset('css/openSans.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('materialize/css/materialize.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
        <link href="{{asset('new_css/common.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('new_css/frontweb.css')}}" rel="stylesheet" type="text/css"/>

        <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('materialize/js/materialize.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="http://www.ppmhub.com.au/public/jarvis/widget"></script>
        @yield('braintree')
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        @include('include.navbar')


        @section('body')
        @show

      
        @include('include.footer')
   

    </body>
</html>
