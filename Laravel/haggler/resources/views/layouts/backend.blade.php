<?php
use \App\Models\Helper;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{{$description}}">
    <meta name="author" content="{{$author}}">
    <link rel="icon" href="favicon.ico">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- Custom styles for this template -->
    <link href="{{ URL::to('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('assets/jquery-ui/jquery-ui.theme.min.css') }}" rel="stylesheet">

    

    @yield('header')  
  
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar blog-masthead navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand backend_logo" href="{{ Helper::adminUrl('/') }}"><!-- {{$header_title}} --><img src="http://haggler.in/assets/home/images/logo.png" alt=""></a>
        </div>
        @yield('navbar')
      </div>
    </nav>

    <div id="content">
    @yield('content')   
    </div>
 
    <footer class="footer">
      <div class="container-fluid">
        <div class="text-center"><p class="text-muted">&copy; <?php echo date('Y'); ?> All Rights Reserved.</p></div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/jquery-ui/jquery-ui.min.js') }}"></script>
  
    <script>
      $(function () {

        setTimeout(function () {
          $('.alert').remove();
        }, 30000);

        $('.delete').click(function (e) {

          e.preventDefault();

            var href = $(this).attr('href');

            if (confirm('Do you really wants to delete this product.')) {
              window.location = href;
            }

          return;

        });

            $( ".datepicker" ).datepicker({
              dateFormat: 'yy-mm-dd'
            });
            $( "#format" ).change(function() {
              $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
            });

            $('.save-btn').click(function () {
              var form = $(this).data('form');
              $(form).submit();
            });

      });
    </script>
    @yield('after_footer')
  
  </body>
</html>
