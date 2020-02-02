@extends('layout.adminlayout')

<?php if (isset($portfolio) && $portfolio->id) { ?>
  @section('title','Edit Portfolio')
<?php } else { ?>
  @section('title','Create Portfolio')
<?php } ?>

@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/portfolio.js') !!}

<!-- Portfolio -->
<section id="create_form" class="panel">
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
                        </ul>
                    </div> 
                </div>
                <?php if (isset($portfolio) && $portfolio->id) {
                  ?>
                  {!! Form::model($portfolio, array('class' => '', 'id' => 'Portfoliotypeform', 'method' => 'PATCH', 'route' => array('portfolio.update', $portfolio->id))) !!}
                <?php } else { ?>
                  {!! Form::open(array('route' => 'portfolio.create', 'id' => 'Portfoliotypeform', 'class' => '')) !!} 
                <?php }
                ?>
                {{ csrf_field() }}
                @if(isset($portfolio) && $portfolio->id)
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
                                <a href="{{url('admin/portfolio')}}">Portfolio</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($portfolio) && $portfolio->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Portfolio
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($portfolio) && $portfolio->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Portfolio
                                <div class="col-md-6 pull-right">
                                    <label class="pull-right"><span class="text-danger">*</span>Mandatory fields</label>
                                </div>
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row" style="margin: 0;">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio Name<span class="text-danger">*<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">Name assigned by the user to the Portfolio. Portfolio acts as a central platform to carry out a project from strategic planning stage to the realisation phase.</span></span></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control border-radius-0 inputRequired" placeholder="Portfolio Name" id="name" name="name" value="<?php
                                                if (isset($portfolio)) {
                                                  echo $portfolio->name;
                                                }
                                                ?>">
                                                @if($errors->has('name')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio ID<span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The portfolio ID is an unique number internally generated by the system. The number range can be controlled via settings.</span></span></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <?php if (isset($portfolio)) { ?>
                                                  <input type="text" class="form-control border-radius-0 defaultgreen" placeholder="Portfolio ID" id="port_id" name="port_id" value="<?php
                                                  if (isset($portfolio)) {
                                                    echo $portfolio->port_id;
                                                  }
                                                  ?>" readonly >
                                                       <?php } else { ?>
                                                  <input type="text" class="form-control border-radius-0 defaultgreen" readonly="true" placeholder="Portfolio ID" id="port_id" name="port_id" value="<?php echo $rand = mt_rand(100000, 999999); ?>"  maxlength="6">                  
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Portfolio Type<span class="text-danger">*<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The portfolio type is used to differentiate different types of portfolios within an organization for controlling and reporting purpose.</span></span></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                              {!! Form::select('type',$ptype, old('type', $portfolio->type), array('class'=>'select2 selectRequired','id'=>'portfolio_type')) !!}
                                            <?php } else { ?>
                                              {!! Form::select('type',$ptype, old('type'), array('class'=>'select2 selectRequired','id'=>'portfolio_type')) !!}	
                                            <?php } ?>
                                            @if($errors->has('type')) 
                                            <div class="text-danger">
                                                {{ $errors->first('type') }}
                                            </div> 
                                            @endif
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                              {!! Form::select('currency', $currency, old('currency',$portfolio->currency), array('class'=>'select2 defaultgreen','placeholder'=>'Please select currency')) !!}
                                            <?php } else { ?>
                                              {!! Form::select('currency', $currency, old('currency'), array('class'=>'select2 defaultgreen','placeholder'=>'Please select currency')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <?php
                            if (isset($portfolio)) {
                              ?>

                              <div class="row" style="margin: 0;">

                                  <div class="col-sm-6">
                                      <div class="form-group row">
                                          <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Financial Planning Period<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">Here you select the financial planning period basis (Monthly, quarterly, half yearly or annual).</span></span></label>
                                          <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                              <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('planning_unit', $planning_unit, old('planning_unit',$portfolio->planning_unit), array('class'=>'select2 defaultgreen')) !!}
                                              <?php } else { ?>
                                                {!! Form::select('planning_unit', $planning_unit, old('planning_unit'), array('class'=>'select2 defaultgreen')) !!}	
                                              <?php } ?>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                      <div class="form-group row">
                                          <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Capacity Unit<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">You can choose any other capacity unit for distribution purpose.</span></span></label>
                                          <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                              <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('capacity_unit', $capacity_unit, old('capacity_unit',$portfolio->capacity_unit), array('class'=>'select2 defaultgreen')) !!}
                                              <?php } else { ?>
                                                {!! Form::select('capacity_unit', $capacity_unit, old('capacity_unit'), array('class'=>'select2 defaultgreen')) !!}	
                                              <?php } ?>
                                          </div>
                                      </div>
                                  </div>

                              </div>

                              <?php
                            }
                            ?>

                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Description<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">A free text field to write about the portfolio</span></span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <textarea id="description" name="description"  class="form-control border-radius-0 defaultgreen"><?php
                                                    if (isset($portfolio)) {
                                                      echo $portfolio->description;
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($portfolio->status))
                                                <a class="active-bttn btn btn-default active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($portfolio->status == 'active')
                                                <a class="active-bttn btn btn-default active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                                @else
                                                <a class="active-bttn btn btn-default"> {!! Form::radio('status','active')!!}Active</a>
                                                <a class="inactive-btn btn btn-default active">
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
                        <div class="card-footer card-footer-box text-right">
                            <button type="submit" class="btn btn-primary card-btn">
                                @if(isset($portfolio) && $portfolio->id)
                                Save Changes
                                @else
                                Submit
                                @endif 

                            </button>
                            <a href="{{url('admin/portfolio')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                    <!-- End Vertical Form -->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->
<!-- Page Scripts -->
@endsection
