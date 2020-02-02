@extends('layout.adminlayout')

<?php if (isset($bucketfp) && $bucketfp->id) { ?>
    @section('title','Edit Bucket Financial Plan')
<?php } else { ?>
    @section('title','Create Bucket Financial Plan')
<?php } ?>

@section('body')

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
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
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="buckets" method="post" action="<?php
                if (isset($bucketfp) && $bucketfp->id) {
                    echo url('admin/bucketfp/' . $bucketfp->id);
                } else {
                    echo url('admin/bucketfp');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($bucketfp) && $bucketfp->id)
                    {{ method_field('PUT') }}
                    @endif 

                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/bucketfp')}}">Portfolio Financial Planning</a>
                                </li>
                                <li>
                                    <span>
                                        @if(isset($bucketfp) && $bucketfp->id)
                                        Edit
                                        @else
                                        Create
                                        @endif  
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($bucketfp) && $bucketfp->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Bucket Financial Planning 
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label>Portfolio</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="form-input-icon"> 
                                                    <?php if (isset($bucketfp)) { ?>
                                                        {!! Form::select('portfolio_id',$portfolio, old('portfolio_id', $bucketfp->portfolio_id), array('class'=>'select2')) !!}
                                                    <?php } else { ?>
                                                        {!! Form::select('portfolio_id',$portfolio, old('portfolio_id'), array('class'=>'select2')) !!}	
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label>Buckets</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="form-input-icon">   
                                                    <?php if (isset($bucketfp)) { ?>
                                                        {!! Form::select('bucket_id', $buckets, old('bucket_id', $bucketfp->bucket_id), array('class'=>'select2')) !!}
                                                    <?php } else { ?>
                                                        {!! Form::select('bucket_id', $buckets, old('bucket_id'), array('class'=>'select2')) !!}	
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        .new-form-section {
                                            background: #e5e5e5 none repeat scroll 0 0;
                                            float: left;
                                            margin-bottom: 5%;
                                            margin-top: 3%;
                                            position: relative;
                                            width: 100%;
                                        }
                                        .new-form-group {
                                            border-right: 2px solid #fff;
                                            margin: 0;
                                            padding: 30px 15px;
                                        }
                                        .col {
                                            position:relative;
                                            width:14.283%;
                                            float:left;
                                        }
                                    </style>
                                    <div class="new-form-section">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Bucket</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Level</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Planning Type</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Costing Type</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Collection Type</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>View Type</label><br>
                                                        <select name="" id="" class="select2">
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                            <option value="">ewfde</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col no-pade">
                                                    <div class="form-group new-form-group">
                                                        <label>Amount</label><br>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>						


                                    <?php
                                    if (isset($bucketfp->created_by) && (!empty($bucketfp->created_by))) {
                                        ?>  <input type="hidden" id="edited_by" name="edited_by" value="<?php //echo Auth::user()->name;  ?>" required="required" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" id="edited_date" name="edited_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } else { ?>
                                        <input type="hidden" id="created_by" name="created_by" value="<?php //echo Auth::user()->name;   ?>" required="required" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" id="created_date" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">

                                    <?php } ?>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label for="l33">Total:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">	
                                                <div class="form-input-icon">
                                                    <input type="text" class="form-control border-radius-0" placeholder="Total" id="total_period" name="total_period" value="<?php
                                                    if (isset($bucketfp)) {
                                                        echo $bucketfp->total_period;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label for="l33">Distribute:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">	
                                                <div class="form-input-icon">
                                                    <input type="text" class="form-control border-radius-0" placeholder="Distribute" id="distribute" name="distribute" value="<?php
                                                    if (isset($bucketfp)) {
                                                        echo $bucketfp->distribute;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label for="l33">Start Date:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="form-input-icon">
                                                    <input type="text" class="form-control border-radius-0 datepicker-only-init" placeholder="Start Date" id="planning_start" name="planning_start" value="<?php
                                                    if (isset($bucketfp)) {
                                                        echo $bucketfp->planning_start;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label for="l33">End Date:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="form-input-icon">
                                                    <input type="text" class="form-control border-radius-0 datepicker-only-init" placeholder="End Date" id="planning_end" name="planning_end" value="<?php
                                                    if (isset($bucketfp)) {
                                                        echo $bucketfp->planning_end;
                                                    }
                                                    ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group form-margin-btm">
                                            <div class="col-xs-12 col-sm-3">
                                                <label for="l33">Planning Unit:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="form-input-icon">
                                                    <select name="planning_unit" id="planning_unit" class="select2">
                                                        <option value="">ewfde</option>
                                                        <option value="">ewfde</option>
                                                        <option value="">ewfde</option>
                                                        <option value="">ewfde</option>
                                                        <option value="">ewfde</option>
                                                    </select>
                                                    <!--input type="text" class="form-control" placeholder="Planning Unit" id="planning_unit" name="planning_unit" value="<?php // if(isset($bucketfp)){ echo $bucketfp->planning_unit; }    ?>"-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-3">
                                                <label>Status:</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <a class="active-bttn btn btn-primary active">
                                                        <input type="radio" id="status" name="status" value="active" <?php
                                                        if (isset($bucketfp) && $bucketfp->status == 'active') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-danger">
                                                        <input type="radio" id="status" name="status" value="inactive" <?php
                                                        if (isset($bucketfp) && $bucketfp->status == 'inactive') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Inactive
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer card-footer-box">
                                <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                <a href="{{url('admin/bucketfp')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>

                            <!-- End Vertical Form -->
                        </div>
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>
</section>
<!-- End Dashboard -->


@endsection
