@extends('layout.adminlayout')
@section('title','Project | Sales Revenue Plan')
@section('body')

@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Project Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/project')}}">Project</a>
                            <a class="dropdown-item" href="{{url('admin/projectphase')}}">Phase</a>
                            <a class="dropdown-item" href="{{url('admin/projecttask')}}">Task/Subtask</a>
                            <a class="dropdown-item" href="{{url('admin/projectchecklist')}}">Checklist</a>
                            <a class="dropdown-item" href="{{url('admin/projectmilestone')}}">Milestone</a>
                            <a class="dropdown-item" href="{{url('admin/projectcostplan')}}">Project Cost Plan</a>
                            <a class="dropdown-item" href="{{url('admin/projectresourceplan')}}">Project Resource Plan</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a>
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Sales Order</a>
                        </li>
                        <li>
                            <span>Project Revenue Planing</span>
                        </li>
                    </ul>
                </div>

                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Project Revenue Planing</h4>
                        <div id="message" class="col-lg-12  col-lg-offset-2 col-md-12 col-md-offset-2 col-xs-12"></div> 
                    </div>
                    <div class="card-block">
                        <div class="ppm-tabpane tab-view"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs panel-tabs" role="tablist" >
                                <li class="nav-item" style="display:none;">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs1"  role="tab" aria-expanded="true">Project Revenue Plan</a>
                                </li>         
                                <li class="nav-item" style="display:none;">
                                    <a class="" data-toggle="tab" href="#tabs2" role="tab" aria-expanded="false"></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs1" role="tabpanel" aria-expanded="true">
                                    <div class="row">
                                        <label class="col-sm-1 col-form-label"> Project ID:</label>    
                                        <div class="col-xs-12 col-md-3 dropdown-section">
                                            {!!Form::select('project_number',$projects,'',array('class'=>'form-control select2 border-radius-0','placeholder'=>'Please select Project','onchange'=>'select_project(this)'))!!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 margin-top-15 margin-bottom-20">
                                            <div id="project_cost" cellspacing="0"  width="100%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs2" role="tabpanel"  aria-expanded="true">
                                    <div class="row margin-bottom-20">
                                        <div class="col-lg-12 col-md-12 margin-bottom-15">
                                            <button type='button' class="btn btn-warning pull-right" onclick="add_row('material')" >Add</button>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" id="material_cost"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="{{asset('js/projectRevenue_gridRender.js')}}"></script>    



<script>
    $.ajaxSetup({async: false});

    @if($id!=null)
    (function(){
        
        $('select[name^=project_number]').val('{{$id}}');
        $('select[name^=project_number] :selected').val('{{$id}}');
        $('select[name^=project_number]').trigger('change'); 
    
    })();    
    @endif

//miscelanious cost table
     function select_project(evt)
    {
        var token = '{{ csrf_token() }}';
        $.ajax({
            url: "{{url('/admin/projectrevenueplan/project')}}/" + evt.value,
            method: "POST",
            data: {'_token': token},
            dataType: "JSON "
        }).done(function (msg)
        {
            /*------------Project cost Dashboard-------------*/
            projectCostPlan.load({metadata: project_meta, data: msg.project_cost});
            projectCostPlan.renderGrid("project_cost", "testgrid");
            projectCostPlan.setActions();

        });
    }


  

//page validations

    $("textarea[maxlength]").on("propertychange input", function () {
        if (this.value.length > this.maxlength) {
            this.value = this.value.substring(0, this.maxlength);
        }
    }
    );

</script>


@endsection