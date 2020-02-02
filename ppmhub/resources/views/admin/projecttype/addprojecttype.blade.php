@extends('layout.adminlayout')
@section('title','Setting | Project Type')
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
                if (isset($projecttype) && $projecttype->id) {
                    echo url('admin/portfoliotypes/' . $projecttype->id);
                } else {
                    echo url('admin/projecttype');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($projecttype) && $projecttype->id)
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
                                    <a href="{{url('admin/projecttype')}}">Project Type</a>
                                </li>
                                <li>
                                    <span>
                                        @if(isset($projecttype) && $projecttype->id)
                                        Edit
                                        @else
                                        Create
                                        @endif 
                                        Project Type
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($projecttype) && $projecttype->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Project Type
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                     <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Name* :</label>
                                    
                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Name" id="name" name="name" value="<?php
                if (isset($projecttype)) {
                    echo $projecttype->name;
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
                                                    <a class="active-bttn btn btn-primary active">
                                                        <input type="radio" name="status" value="1" <?php
                if (isset($projecttype) && $projecttype->status == 'active') {
                    echo "checked";
                }
                ?>>
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-danger">
                                                        <input type="radio" name="status" value="0" <?php
                                                        if (isset($projecttype) && $projecttype->status == 'inactive') {
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

<?php
if (isset($projecttype->created_at) && (!empty($projecttype->created_at))) {
    ?>   <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
<?php } else { ?>
                                        <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
<?php } ?>


                                    <!--<div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                                    <div class="card-footer card-footer-box">
                                        <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                        <a href="{{url('admin/projecttype')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                    </div>                        
                                    <!--<button type="submit" class="btn btn-success">Submit</button>
                                  </div>-->
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
            </section>
            @endsection