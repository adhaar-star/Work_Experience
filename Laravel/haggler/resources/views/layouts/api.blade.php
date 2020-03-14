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
    <link rel="stylesheet" href="{{ URL::to('assets/schematic/schematic.css') }}">
 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    #schematic-page {
      padding: 80px 15px;
    }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="javascript:;" id="brand-name">{{$header_title}}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    

      <div id="schematic-page">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="{{ URL::to('assets/js/jquery.min.js') }}"></script>
     <script src="{{ URL::to('assets/schematic/schematic.js') }}"></script>
     <script src="{{ URL::to('assets/schematic/v1/menu.js')}}"></script>
     <script src="{{ URL::to('assets/schematic/v1') }}/{{Route::input('page')}}.js"></script>

     <script>

      // create page config
  var schematic = new SchematicPlugin({
        title: "Haggler",
        url: "{{URL::to('help/api/v1')}}",
        api: "{{URL::to('api/v1')}}",
        subTitle: "Web Service Documentation"
    });
    schematic.menu(menu);
    schematic.init(page);

     </script>

  </body>
</html>
