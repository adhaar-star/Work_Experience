@extends('layout.adminlayout')

<?php if (isset($orderingunit) && $orderingunit->id) { ?>
    @section('title','Settings | Edit Ordering Unit')
<?php } else { ?>
    @section('title','Settings | Create Ordering Unit')
<?php } ?>

@section('body')

<!-- Material Group -->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/mcategory_validation.js') !!}

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
                            <a href="{{url('admin/addOrderingUnit')}}">Add Ordering Unit</a>
                        </li>
                        <li>
                            <span>
                                @if(isset($orderingunit) && $orderingunit->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Ordering Unit  </span>
                        </li>
                    </ul>
                    @include('include.admin_sidebar')
                </div>


                @if(!isset($orderingunit->id))
                {!! Form::open(array('url' => 'admin/addOrderingUnit','method'=>'post','id' => 'Orderingform')) !!} 
                @else
                {!! Form::open(array('route'=>array('orderUnit.update',$orderingunit->id),'method' => 'put','id' => 'Orderingform')) !!}
                @endif
                {{ csrf_field() }}


                <div class="margin-bottom-50">

                    <div class="card">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($orderingunit) && $orderingunit->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Ordering Unit
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block bg-lightcyan">
                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right"> Ordering Unit* :</label>
                                        <div class="col-xs-12 col-sm-2">
                                            <div class="form-input-icon">
                                                {!!Form::text('orderingunit',isset($orderingunit->orderingunit) ? $orderingunit->orderingunit : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter name'])!!}
                                                @if($errors->has('orderingunit')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('orderingunit') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status</label>
                                        <div class="col-sm-9">
                                            <div class="btn-group" data-toggle="buttons">

                                                @if(!isset($orderingunit->status))

                                                <a class="active-bttn btn btn-primary active">

                                                    {!! Form::radio('status','active','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-danger">

                                                    {!! Form::radio('status','inactive') !!}Inactive

                                                </a>
                                                @else
                                                @if($orderingunit->status == 'active')
                                                <a class="active-bttn btn btn-primary active">

                                                    {!! Form::radio('status','active')!!}Active

                                                </a>
                                                <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-btn bttn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
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
                            @if(!isset($orderingunit->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <!--<button type="submit" class="btn btn-primary width-150">Submit</button>-->
                            <a href="{{url('admin/addOrderingUnit')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
