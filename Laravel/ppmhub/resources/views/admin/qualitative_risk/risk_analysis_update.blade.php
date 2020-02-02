@extends('layout.adminlayout')
@section('title','Project | Project Risk Analysis')
@section('body')

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Form Wizards <small>Sessions</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="item_a"></a></li>
                    <li class="breadcrumb-item"><a href="#" class="item_b"></a></li>
                    <li class="breadcrumb-item"><a href="#" class="item_c"></a></li>
                </ol>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!-- Smart Wizard -->
            <div id="wizard" class="form_wizard wizard_horizontal">
                <ul class="wizard_steps">
                    <li>
                        <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                Step 1<br />
                                <small>Step 1 description</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                Step 2<br />
                                <small>Step 2 description</small>
                            </span>
                        </a>
                    </li>
                </ul>
                <div id="step-1">
                    <form class="form-horizontal form-label-left" id="qual_form_update" 
                          action="" method="post">	
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search-project">Search Project<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" value="{{$project['project_Id']}}" id="searchProject" required="required" class="form-control col-md-7 col-xs-12" searchId = "">
                            </div>
                        </div>
                        <input type="hidden" value="{{$project['Id']}}" name="project_id" id="searchProjectUpdate_input">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="risk-id">Risk Id <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="qual_risk_id" id="qualRiskId" required="required" class="risk_input form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="Category">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id="qualCategory" name="qual_category"  class="form-control col-md-7 col-xs-12">
                                    <option value="none">Select Category</option>
                                    <option value="1">Supplier risk</option>
                                    <option value="2">Technology risk</option>
                                    <option value="3">Infrastructure risk</option>
                                    <option value="4">Govt. Policy risk</option>
                                    <option value="5">Resource risk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Risk Desc">Risk Desc <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="qualRiskDesc" name="qual_risk_desc" required="required" class="textarea_risk form-control col-md-7 col-xs-12"></textarea> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualitative-impact">Qualitative Impact <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id="qualImpact" name="qual_impact" required="required" class="form-control col-md-7 col-xs-12">
                                    <option value="none" selected>Select Impact</option>
                                    <option value="0">Rare</option>
                                    <option value="1">Unlikely</option>
                                    <option value="2">Moderate</option>
                                    <option value="3">Likely</option>
                                    <option value="4">Very Likely</option>
                                </select>

                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="Category">Qualitative Probability <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id="qualProbSelect" name="qual_probability" required="required" class="form-control col-md-7 col-xs-12">
                                    <option value="none" selected>Select Probability</option>
                                    <option value="1">Trivial</option>
                                    <option value="2">Minor</option>
                                    <option value="3">Moderate</option>
                                    <option value="4">Major</option>
                                    <option value="5">Extreme</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="created-on">Created On<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="qual_created_on" id="qualCreatedOn" required="required"  class="created_on input_calender form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="created-by">Created By <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="qual_created_by" id="qualCreatedBy" required="required" class="created_on form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="changed-on">Changed On<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="qual_changed_on" id="qualChangedOn" required="required" class="changed_on input_calender form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="changed-by">Changed By <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="qual_changed_by" id="qualChangedBy" required="required" class="changed_by form-control col-md-7 col-xs-12">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id="qualStatus" name="qual_status" required="required" class="form-control col-md-7 col-xs-12">
                                    <option value="0" selected="selected">Active</option>
                                    <option value="1">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id='hiddenInput' name='risk_type' value='qual1'>
                        <div class="col-md-2 pull-right">
                            <button type="submit" class="btn btn-primary quan_form_submit ">Submit</button>
                        </div>
                    </form>

                </div>
                <div id="step-2">
                    <form class="form-horizontal form-label-left" id="quan_form_update">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search-project">Search Project<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" id="searchProject_quan" required="required" class="form-control col-md-7 col-xs-12" value="{{$project['project_Id']}}" searchId = "">
                            </div>
                        </div>	
                        <input type="hidden" value="{{$project['Id']}}" name="project_id" id="searchProject_quan_input">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="risk-id">Risk Id <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_risk_id" id="quanRiskId" required="required" class="risk_input form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="Category">Category <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select name="quan_category" id="quanCategory"  class="form-control col-md-7 col-xs-12">
                                    <option value="none">Select Category</option>
                                    <option value="1">Supplier risk</option>
                                    <option value="2">Technology risk</option>
                                    <option value="3">Infrastructure risk</option>
                                    <option value="4">Govt. Policy risk</option>
                                    <option value="5">Resource risk</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Risk Desc">Risk Desc <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea id="quanRiskDesc" name="quan_risk_desc" required="required" class="textarea_risk form-control col-md-7 col-xs-12"></textarea> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total-loss">Total Loss <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_total_loss" id="quanTotalLoss" required="required" class="form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="Category">Currency <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_currency" id="quanCurrency" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Quan-probability">Quan Probability <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_probability" id="quanProb" required="required" class="form-control col-md-7 col-xs-12" min="1" max="100">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="Category">Risk Score <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id="quanRiskScore" name="quan_risk_score" required="required" class="form-control col-md-7 col-xs-12">
                                    <option value="none" selected>Select Risk Score</option>
                                    <option value="1">Insignificant</option>
                                    <option value="2">Minor</option>
                                    <option value="3">Moderate</option>
                                    <option value="4">Serious</option>
                                    <option value="5">Very serious</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expected-loss">Expected Loss<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_expected_loss" id="quanExpLoss" required="required" class="form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="enter-by">Entered By <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_entered_by" id="quanEnteredBy" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="created-on">Created On<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_created_on" id="quanCreatedOn" required="required" class="created_on input_calender form-control col-md-7 col-xs-12">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="created-by">Created By <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_created_by" id="quanCreatedBy" required="required" class="form-control col-md-7 col-xs-12 created_by">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="changed-on">Changed On<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_changed_on" id="quanChangedOn" required="required" class="form-control input_calender col-md-7 col-xs-12 changed_on">
                            </div>

                            <label class="control-label col-sm-2 col-xs-12" for="changed-by">Changed By <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <input type="text" name="quan_changed_by" id="quanChangedBy" required="required" class="form-control col-md-7 col-xs-12 changed_by">
                            </div>
                        </div>
                        <input type="hidden" id='hiddenInput' name='risk_type' value='quan1'>
                        <div class="col-md-2 pull-right">
                            <button type="submit" class="btn btn-primary quan_form_submit ">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- End SmartWizard Content -->
        </div>
    </div>
</div>

@endsection

