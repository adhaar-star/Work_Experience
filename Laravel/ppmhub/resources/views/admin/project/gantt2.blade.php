@extends('layout.adminlayout')
@section('body')

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script src="{{URL::to('/')}}/public/dhtmlx/dhtmlx.js"></script>
    <link href="{{URL::to('/')}}/public/dhtmlx/dhtmlx.css" rel="stylesheet">



    <div id="gantt_here" style='width:100%; height:250px;'></div>
    
    <script type="text/javascript">
    gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
 
gantt.init("gantt_here");
 
gantt.load("{{URL::to('/')}}/admin/gantt_data");

    </script>
</body>
@endsection
