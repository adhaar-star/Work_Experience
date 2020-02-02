@extends('layout.adminlayout')
@section('title','Project Management | Project Structure')
@section('body')
{!! Html::style('/css/Treant.css') !!}
{!! Html::style('/css/custom-colored.css') !!}
{!! Html::script('/js/raphael.js') !!}
{!! Html::script('/js/Treant.js') !!}
{!! Html::script('/js/project_chart.js') !!}
@if(Session::has('flash_message'))
<div class="alert alert-success">
  <span class="glyphicon glyphicon-ok"></span>
  <em> {!! session('flash_message') !!}</em>
</div>
@endif

<style>
  .tree-struc {
    text-align: center;
  }
  .tree-struc .choose-port1 {
    float: none;
    margin-bottom: 25px;
    margin-right: 0;
    text-align: center;
    font-size:22px;
    margin-top:20px;
  }
  .tree-struc select {
    border-radius: 0;
    float: none;
    height: 46px;
    margin: 0 auto 20px;
    width: 40%;
  }
  .tree li a {
    background-color: #7a2100;
    border: 3px solid #fff;
    border-radius: 0;
    font-family: "Lato", sans;
    padding: 11px 20px;
    text-transform: uppercase;
  }

  .tree li a:hover, .tree li a:hover + ul li a {
    background: #ea6532 none repeat scroll 0 0;
    border: 3px solid #fff;
    color: #fff;
  }
</style>
<section id="client-information" class="client-information">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="tree-struc">
          
            <select class="form-control projectStructure" onchange="renderProjectStructure(this);"  name="projectId" id="projectId">
              <option selected="selected" value="">Choose your project</option>
              @foreach($project as $proj)
              <option value="{{$proj->id }}"  {{($proj->id == $projectId) ? 'selected': ''}}>{{$proj->project_name }}</option>
              @endforeach
            </select>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="tree-chart"></div>

@if($projectId != 0 || $projectId != null)
<script>
   
   $(document).ready(function(){
        $('#projectId').trigger('change');
    }); 
      
</script>
@endif
@endsection
