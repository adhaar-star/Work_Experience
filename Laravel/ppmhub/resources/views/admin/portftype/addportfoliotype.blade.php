@extends('layout.adminlayout')

<?php if (isset($portfoliotype) && $portfoliotype->id) { ?>
    @section('title','Settings | Edit Portfolio Type')
<?php } else { ?>
    @section('title','Settings | Create Portfolio Type')
<?php } ?>

@section('body')

<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif


                <form id="Portfoliotypeform" method="post" action="<?php
                if (isset($portfoliotype) && $portfoliotype->id) {
                    echo url('admin/portfoliotypes/' . $portfoliotype->id);
                } else {
                    echo url('admin/portfoliotypes');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($portfoliotype) && $portfoliotype->id)
                    {{ method_field('PUT') }}
                    @endif 

                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/portfoliotypes')}}">Portfolio Type</a>
                                </li>
                                <li>
                                    <span>
                                        @if(isset($portfoliotype) && $portfoliotype->id)
                                        Edit
                                        @else
                                        Create
                                        @endif 
                                        Portfolio Type </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($portfoliotype) && $portfoliotype->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Portfolio Type
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">


                                    <?php
                                    if (isset($portfoliotype->created_at) && (!empty($portfoliotype->created_at))) {
                                        ?>   <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } else { ?>
                                        <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } ?>


                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Name* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Name" id="name" name="name" value="<?php
                                                    if (isset($portfoliotype)) {
                                                        echo $portfoliotype->name;
                                                    }
                                                    ?>"  required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>	
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Status* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="btn-group" data-toggle="buttons">
                                                    @if(!isset($portfoliotype->status))
                                                    <a class="active-bttn btn btn-primary active ">
                                                        <input type="radio" id="status" name="status" value="active" checked="">
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-danger ">
                                                        <input type="radio" id="status" name="status" value="inactive" >
                                                        Inactive
                                                    </a>
                                                    @else
                                                    <a class="active-bttn btn btn-danger <?php
                                                    if (isset($portfoliotype) && $portfoliotype->status == 'active') {
                                                        echo "active";
                                                    }
                                                    ?>">
                                                        <input type="radio" id="status" name="status" value="active" <?php
                                                        if (isset($portfoliotype) && $portfoliotype->status == 'active') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-default <?php
                                                    if (isset($portfoliotype) && $portfoliotype->status == 'inactive') {
                                                        echo "active";
                                                    }
                                                    ?>">
                                                        <input type="radio" id="status" name="status" value="inactive" <?php
                                                        if (isset($portfoliotype) && $portfoliotype->status == 'inactive') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Inactive
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                            <div class="card-footer card-footer-box">
                                <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                <a href="{{url('admin/portfoliotypes')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>                      
                            <!--<button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>-->

                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div> 
    @endsection
