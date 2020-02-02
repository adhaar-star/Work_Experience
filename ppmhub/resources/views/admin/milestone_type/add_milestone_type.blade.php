@extends('layout.adminlayout')

<?php if (isset($materialcategory) && $materialcategory->id) { ?>
    @section('title','Settings | Edit Milestone Type ')
<?php } else { ?>
    @section('title','Settings | Create Milestone Type')
<?php } ?>

@section('body')

<!-- Material Category -->
{!! Html::script('/js/jquery.validate.min.js') !!}


<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Settings</a>
                        </li>
                        <li>
                            <a href="{{url('admin/addCategory')}}">Add Material Category</a>
                        </li>
                        <li>
                            <span>
                                @if(isset($milestone) && $milestone->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Milestone Type  </span>
                        </li>
                    </ul>
                    @include('include.admin_sidebar')
                </div>



                @if(!isset($milestone->id))
                {!! Form::open(array('url' => 'admin/addMilestone','method'=>'post','id' => 'Milestoneform')) !!} 
                @else
                {!! Form::open(array('route'=>array('milestoneType.update',$milestone->id),'method' => 'put','id' => 'Milestoneform')) !!}
                @endif
                {{ csrf_field() }}


                <div class="margin-bottom-50">


                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($milestone) && $milestone->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Milestone Type
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block bg-lightcyan">
                            <div class="row">


                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Milestone Type* :</label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('milestonetype',isset($milestone->milestonetype) ? $milestone->milestonetype : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter name'])!!}
                                                @if($errors->has('milestonetype')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('milestonetype') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>

                               <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>
                                        <div class="col-sm-3">
                                            <div class="btn-group" data-toggle="buttons">

                                                @if(!isset($milestone->status))

                                                <a class="active-bttn btn btn-default active">

                                                    {!! Form::radio('status','active','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-default">

                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @else
                                                @if($milestone->status == 'active')
                                                <a class="active-bttn btn btn-primary active">

                                                    {!! Form::radio('status','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                                <a class="inactive-btn btn btn-danger active">

                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @endif
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
                            @if(!isset($milestone->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/addMilestone')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        <!--<button type="submit" class="btn btn-success">Submit</button>
                      </div>
                    </div>-->
                        {!!Form::close()!!}
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
