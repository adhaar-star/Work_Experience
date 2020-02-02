@extends('layout.adminlayout')
@section('title','Project | Project')
<link href=
"{{URL::to('/')}}/vendor/swatkins/laravel-gantt/src/assets/css/gantt.css" rel="stylesheet" type="text/css">\
@section('body')
{!! $gantt !!}
@endsection
