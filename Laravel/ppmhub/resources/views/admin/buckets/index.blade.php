@extends('layout.adminlayout')
@section('title','Portfolio | Buckets')
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
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Plaining</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                        </li>
                        <li>
                            <span>Bucket Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Buckets</h4>
                <div class="dashboard-buttons">
                    <a href="{{url('admin/buckets/create')}}" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Bucket
                    </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Portfolio ID</th>
                                    <th>Bucket ID</th>
                                    <th>Bucket Name</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Currency</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Portfolio ID</th>
                                    <th>Bucket ID</th>
                                    <th>Bucket Name</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Currency</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>                       
                                @foreach($buckets as $buck)
                                <?php //echo "<pre>";print_r($buck);die;?>
                                @if($buck->children->count() >= 0)
                                <tr>
                                    <td>
                                        <?php
                                        if ($buck->parent_bucket == '') {
                                            echo "N/A";
                                        } else {
                                            echo $buck->name;
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $buck['portfolio']['port_id'] }}</td>
                                    <td>{{$buck->bucket_id }}</td>
                                    <td>{{ $buck->name }}</td>
                                    <td>
                                        @if($buck->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">

                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                        @endif
                                    </td>
                                    <td>
                                        <?php
                                        $createdate = strtotime($buck->created_at);
                                        $created_at = date('d/M/Y', $createdate);
                                        ?>
                                        {{$created_at }}
                                    </td>
                                    <td>{{$buck['currencyname']['short_code'] }}</td>
                                    <td class="action-btn">

                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_{{$buck->id }}"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        <a href="{{url('admin/buckets/'.$buck->id.'/edit')}}" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>

                                        {!! Form::open(array('route' => array('buckets.delete',$buck->id), 'method' => 'DELETE','id'=>'delform'.$buck->id)) !!}
                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this buckets');
                                                    if (res) {
                                            document.getElementById('delform{{$buck->id}}').submit()
                                                        }" class="btn btn-danger btn-xs margin-0"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                        {!! Form::close() !!}

                                        <div class="modal fade table-view-popup" id="table-view-popup_{{$buck->id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/buckets')}}">Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/buckets/create')}}">Display Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{ $buck->name }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $buck->name }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $buck->bucket_id }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck['portfolio']['name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$buck['portfolio']['port_id']}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        @if($buck->description !='') {{ $buck->description }} @else  No Description Found   @endif 

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">@if($buck['costcentre_name']['name']!='') {{ $buck['costcentre_name']['name'] }} @else  Not Updated   @endif </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        @if($buck['department_name']['name']!='') {{ $buck['department_name']['name'] }} @else  Not Updated   @endif
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php
                                                                        $createdate = strtotime($buck->created_at);
                                                                        $created_at = date('d/M/Y', $createdate);
                                                                        ?>
                                                                        {{$created_at}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php
                                                                        $updatedate = strtotime($buck->updated_at);
                                                                        $updated_at = date('d/M/Y', $updatedate);
                                                                        ?>
                                                                        {{$updated_at}}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $buck['creator']['name'] }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ (isset($buck['updator'])) ? $buck['updator']['name'] : "" }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        @if($buck->status=='active')
                                                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">
                                                                        @else
                                                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">
                                                                        @endif 
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="{{url('admin/buckets/'.$buck->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                        <!--{{url('admin/portfolioStructure/'.$portId)}}-->
                                                        @if($bucketId != 0 || $bucketId != null)
                                                            <span class="edit-btn"><a onclick="redirectToBack({{$buck->id}},{{$portId}})"  id=backButton class="btn btn-primary">Back</a></span>
                                                        @else
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->

                                    </td>
                                </tr>
                                @foreach($buck->children as $submenu)
                                <tr>   

                                    <td>
                                        <?php
                                        if ($submenu->parent_bucket == '') {
                                            echo "N/A";
                                        } else {
                                            echo $buck->name;
                                        }
                                        ?>
                                    </td>
                                    <td>{{ $submenu['portfolio']['port_id'] }}</td>
                                    <td>{{$submenu->bucket_id }}</td>   
                                    <td>&nbsp; |_ {{ $submenu->name }}</td>
                                    <td>
                                        @if($submenu->status=='active')
                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">

                                        @else
                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                        @endif
                                    </td>

                                    <td>
                                        <?php
                                        $createDate = strtotime($submenu->created_at);
                                        $created_at = date('d/M/Y', $createDate);
                                        ?>
                                        {{$created_at }}
                                    </td>

                                    <td>{{$submenu['currencyname']['short_code'] }}</td>
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#bucket-view-popup"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="{{url('admin/buckets/'.$submenu->id.'/edit')}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        <form action="{{url('admin/buckets/'.$submenu->id)}}" method="post" id="delform">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Bucket');
                                                                if (res) {
                                                        document.getElementById('delform').submit()
                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        </form>

                                        <div class="modal fade table-view-popup" id="bucket-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/buckets')}}">Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('admin/buckets/create')}}">Display Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <span>{{ $submenu->name }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $submenu->name }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $submenu->bucket_id }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$submenu['portfolio']['name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $submenu['portfolio']['port_id'] }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$submenu->description}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$submenu['costcentre_name']['name'] }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{$submenu['department_name']['name']}}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php
                                                                        $createdate = strtotime($submenu->created_at);
                                                                        $created_at = date('d/M/Y', $createdate);
                                                                        ?>
                                                                        {{$created_at}}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ $submenu['creator']['name'] }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">{{ (isset($buck['updator'])) ? $buck['updator']['name'] : "" }}</p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        @if($submenu->status=='active')
                                                                        <img src="{{asset('vendors/common/img/green.png')}}" alt="">

                                                                        @else
                                                                        <img src="{{asset('vendors/common/img/red.png')}}" alt="">

                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="{{url('admin/buckets/'.$submenu->id.'/edit')}}" class="btn btn-primary">Edit</a></span>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->

                                    </td>
                                </tr>
                                @endforeach


                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 @if($bucketId != 0 || $bucketId != null)
<script>
    $('#table-view-popup_{{$bucketId}}').modal('show');
    function redirectToBack(bucketId,portfolioId){
        $('#table-view-popup_{{$bucketId}}').modal('hide');
        window.location.href = '/admin/portfolioStructure/'+bucketId+'/'+portfolioId
    }
</script>
 @endif
<!-- End  -->


@endsection