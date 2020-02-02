@extends('layout.adminlayout')
@section('title','Project | Project Revenue Plan')
@section('body')

@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if(Session::has('flash_error'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_error') !!}</em>
</div>
@endif
<style>
    .err {
        background-color: #da4f49;
        color: #ffffff;
    } 
    .ok {
        background-color: #00d6b2;
        color: #ffffff;
    } 

    #grid_cost {
        overflow: none;
        overflow-x: scroll;
        display: block;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
</style>
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
                            <a href="{{url('admin/projectrevenueplan/'.$id)}}">Project Revenue Dashboard </a>
                        </li>
                    </ul>
                </div>

                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">{{$module == "product-sales" ? "Products Revenue Planning": "Revenue Service Offering"}}</h4> 
                    </div>
                    <div class="card-block">
                        <div class="ppm-tabpane"> 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs panel-tabs" role="tablist" >
                                <li class="nav-item" style="display:none;">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs1"  role="tab" aria-expanded="true">Project Cost Plan</a>
                                </li>         
                                <li class="nav-item" style="display:none;">
                                    <a class="" data-toggle="tab" href="#tabs2" role="tab" aria-expanded="false"></a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs1" role="tabpanel"  aria-expanded="true">


                          @if($module == 'service-offering')
                                    <div class ="row col-md-12 pull-right">
                                        <div class="form-group row col-md-6">
                                            <label class="col-sm-2 control-label">From Date:</label>
                                            <div class="col-sm-4 col-sm-2">
                                                <input class="form-control datepicker-only-init border-radius-0 padding-input width-110" placeholder="Please enter From Date" name="from_date" type="text" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row col-md-6">
                                            <label class="col-sm-2 control-label">To Date:</label>
                                            <div class="col-sm-4 col-sm-2">
                                                <input class="form-control datepicker-only-init border-radius-0 padding-input width-110" placeholder="Please enter To Date" name="to_date" type="text" value="" onchange="getDateCols()" onblur="getDateCols()">
                                            </div>
                                        </div>
                                    </div>
                          @endif   

                                    <div class="row margin-bottom-20">
                                        <div id="message" class="col-lg-11 col-md-11 col-xs-10"></div>
                                        <div class="margin-bottom-15 pull-right">
                                            <button type='button' class="btn btn-warning" onclick="add_row('{{$module}}', '{{$id}}')" >Add</button>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xs-12" id="grid_cost"></div>
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
<script>
//global vars
                    var result = @php echo json_encode($result); @endphp;
                    var tasks = @php echo json_encode($tasks); @endphp;
                    //var currency = @php echo json_encode($currency); @endphp;
                    //overide default currency option to USD
                    var currency = @php echo json_encode($currency); @endphp;
                    var material = @php echo json_encode($material); @endphp;
                    var purchase_order = @php echo json_encode($purchase_order); @endphp;
                    var purchase_item = @php echo json_encode($purchase_item); @endphp;
                    var purchase_item_data = @php echo json_encode($purchase_item_data); @endphp;
                    @isset($activity)
                    var activities = @php echo json_encode($activity); @endphp;
                    @endisset
                    @isset($roles)
                    var roles = @php echo json_encode($roles); @endphp;
                    @endisset
                    @isset($vendors)
                    var vendors = @php echo json_encode($vendors); @endphp;
                    @endisset
                    @isset($resource)
                    var resources = @php echo json_encode($resource); @endphp;
                    @endisset
                    @isset($employe_id)
                    var personnel_no = @php echo json_encode($employe_id); @endphp;
                    @endisset


</script>



@if($module == 'product-sales')
<script src="{{asset('js/project_productSalesCost.js')}}"></script>
@endif
@if($module == 'service-offering')
<script src="{{asset('js/project_serviceOfferingCost.js')}}"></script>
@endif

<script>
                    $.ajaxSetup({async: false});
                    token = '{{ csrf_token() }}';
                    //add row in a module
                            function add_row(module, id)
                            {
                              switch (module)
                              {
                                case 'product-sales':
                                      materialCostPlan.insert((materialCostPlan.getRowCount() - 1), 'add' + materialCostPlan.getRowCount(), {'project_number': id}, {}, false)
                                      break;
                                case 'service-offering':
                                      internalCostPlan.insert((internalCostPlan.getRowCount() - 1), 'add' + internalCostPlan.getRowCount(), {'project_number': id}, {}, false)
                                      break;
                              }
                            }




                    function delete_revenue(name, id)
                    {
                    $.ajax({
                    url: "{{url('/admin/projectrevenueplan/')}}/" + name + "/delete/" + id,
                            method: "POST",
                            data: {'_token': token},
                            dataType: "JSON "
                    }).done(function (msg) {
                    _$("message").innerHTML = "<p class='err'>" + msg.status + "</p>"
                            setTimeout(function(){
                            window.location.href = window.location.href;
                            }, 500);
                    });
                    }


                    function add_revenue(name, obj)
                    {

                    $.ajax({
                    url: "{{url('/admin/projectrevenueplan/')}}/" + name + "/store",
                            method: "POST",
                            data: {'_token': token, data: obj},
                            dataType: "JSON "
                    }).done(function (msg)
                    {
                    if ('status' in msg)
                    {
                    if (msg.status != 'ok')
                    {   _$("message").innerHTML = '';
                            console.log(msg.error);
                            for (obj in msg.error)
                    {
                    _$("message").innerHTML += "<p class='err'>" + msg.error[obj] + "</p>";
                    }

                    }
                    else
                    {
                    _$("message").innerHTML = "<p class='ok'> New Record added successfully !!</p>";
                            setTimeout(function(){

                            window.location.href = window.location.href;
                            }, 500);
                    }
                    }
                    else {
                    window.location.href = window.location.href;
                    }

                    });
                            ///end of  function    
                    }

                    function update_revenue(name, obj, id)
                    {

                    $.ajax({
                    url: "{{url('/admin/projectrevenueplan/')}}/" + name + "/edit/" + id,
                            method: "POST",
                            data: {'_token': token, data: obj},
                            dataType: "JSON "
                    })
                            .done(function (msg) {
                            if ('status' in msg)
                            {
                            if (msg.status != 'ok')
                            {
                            $("message").innerHTML = "<p class='err'>" + msg.error + "</p>";
                            } else
                            {
                            _$("message").innerHTML = "<p class='ok'> Record Updated successfully !!</p>";
                            }
                            } else {

                            window.location.href = window.location.href;
                            }

                            });
                            ///end of  function    
                    }




//page validations
                    (function(){
                    $("textarea[maxlength]").on("propertychange input", function () {
                    if (this.value.length > this.maxlength) {
                    this.value = this.value.substring(0, this.maxlength);
                    }
                    }
                    );
                    })();

</script>


@endsection