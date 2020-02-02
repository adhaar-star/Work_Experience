@extends('layout.adminlayout')
@section('title','Error 403')

@section('body')
<center>
    <span class="icmn-warning" style="font-size: 100px; color: #827ca1; margin-top: 50px; display: inline-block;"></span>
    <h1 style="font-size: 36px; color: #827ca1; margin-top: 50px;">{{ $exception->getMessage() }}</h1>
</center>
@endsection