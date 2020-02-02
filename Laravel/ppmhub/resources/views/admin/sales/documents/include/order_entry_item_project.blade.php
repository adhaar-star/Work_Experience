{!! Form::open(['url' =>route('sales-order-save-items', $order->sales_document_id),   'class' => 'form-horizontal  GlobalFormValidation SO_ManageItems']) !!}
@if(!empty($updateItem))
    {!! Form::hidden('sales_document_item_id', $updateItem->sales_document_item_id) !!}
@endif
<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    <?php $classSoProjectOnChange = ( $order->sales_order_type  == 'timesheet') ? 'SoProjectOnChange' : '';?>
                    {!!Form::select('project_id', !empty($projects) ? $projects : [], (!empty($updateItem)) ? $updateItem->project_id : null, [
                           'class'=>'form-control  border-radius-0 no-resize  select2 '. $classSoProjectOnChange,
                           'placeholder' => 'Select Project',
                           'data-url' => route('get-project-task-phase'),
                           'data-fv-notempty' => true,
                           'data-fv-blank' => true,
                           'data-rule-required' => true,
                           'data-fv-notempty-message' => 'Project is required',
                        ] )!!}
                </div>
            </div>
        </div>

        @if( $order->sales_order_type  == 'timesheet')
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Task<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::select('task_id',  $updateTasks, (!empty($updateItem)) ? $updateItem->task_id : null, [ 'class'=>'form-control  border-radius-0 no-resize projectTaskOnChangeProject', 'placeholder' => 'Select Project Task',
                        'data-fv-notempty' => true,
                        'data-fv-blank' => true,
                        'data-rule-required' => true,
                        'data-fv-notempty-message' => 'Project Task is required',
                     ] )!!}
                </div>
            </div>
        </div>
        @endif

    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Cost Centre<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::select('cost_center_id',  $costs_type, (!empty($updateItem)) ? $updateItem->cost_center_id : null,
                    [ 'class'=>'form-control  border-radius-0 no-resize', 'placeholder' => 'Select Cost Centre',
                        'data-fv-notempty' => true,
                        'data-fv-blank' => true,
                        'data-rule-required' => true,
                        'data-fv-notempty-message' => 'Cost Centre is required',
                     ] )!!}
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
       <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Total Price<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon input-group mb-2 mb-sm-0">
                    {!!Form::number('gross_price', (!empty($updateItem)) ? $updateItem->unit_price : null, ['class'=>'form-control  border-radius-0 no-resize SO_item SO_UnitPrice SO_TotalPriceServiceOnChangeMaterial ',
                        'placeholder'=>'Total Price',
                        'min' => 1,
                        'step' =>'0.50',
                        'data-fv-notempty' => true,
                        'data-fv-blank' => true,
                        'data-rule-required' => true,
                        'data-fv-notempty-message' => 'Cost per unit is required',

                     ] )!!}
                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                </div>
            </div>
       </div>
       <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sales Tax<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon  input-group mb-2 mb-sm-0">
                    {!!Form::number('tax', (!empty($updateItem)) ? $updateItem->tax : null, ['class'=>'form-control  border-radius-0 no-resize SO_item SO_Tax', 'max' =>99,  'min' => 1, 'step' =>'0.50',  'placeholder'=>'Enter Tax Percentage',

                        'data-fv-notempty' => true,
                        'data-fv-blank' => true,
                        'data-rule-required' => true,
                        'data-fv-notempty-message' => 'Sales Tax is required',

                     ] )!!}
                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Discount:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon  input-group mb-2 mb-sm-0">
                    {!!Form::number('discount', (!empty($updateItem)) ? $updateItem->discount : null, ['class'=>'form-control  border-radius-0 no-resize SO_item SO_Discount', 'max' =>99,  'min' => 0, 'step' =>'0.50',  'placeholder'=>'Enter Discount Percentage'] )!!}
                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Profit Margin:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon  input-group mb-2 mb-sm-0">
                    {!!Form::number('profit_margin', (!empty($updateItem)) ? $updateItem->profit_margin : null, ['class'=>'form-control  border-radius-0 no-resize SO_item SO_ProfitMargin', 'max' =>99,  'min' => 0, 'step' =>'0.50',  'placeholder'=>'Enter Profit Margin Percentage' ] )!!}
                    <div class="input-group-addon"><i class="fa fa-percent"></i></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Material NO:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::number('material_no', (!empty($updateItem)) ? $updateItem->material_no : null, ['class'=>'form-control  border-radius-0 no-resize','placeholder'=>'Customer Material NO' ] )!!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Short Description:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::text('description', (!empty($updateItem)) ? $updateItem->description : null, [ 'class'=>'form-control border-radius-0','placeholder'=>'Enter Material Description']  )!!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-10 col-lg-offset-1">
                <table class="table table-striped">
                    <tr>
                        <td>Gross Amount</td>
                        <td  class="SO_AmountStyle"><span  class="SO_GrossAmount">{{   (!empty($updateItem)) ? $updateItem->gross_price : 0 }}</span>$</td>
                    </tr>
                    <tr>
                        <td>Profit Margin Amount</td>
                        <td  class="SO_AmountStyle"><span  class="SO_ProfitMarginAmount">{{   (!empty($updateItem)) ? $updateItem->profit_margin_amount : 0 }}</span>$</td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td  class="SO_AmountStyle"><span  class="SO_TaxAmount">{{   (!empty($updateItem)) ? $updateItem->tax_amount : 0 }}</span>$</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td  class="SO_AmountStyle"><span  class="SO_DiscountAmount">{{   (!empty($updateItem)) ? $updateItem->discount_amount : 0 }}</span>$</td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td  class="SO_AmountStyle"><span  class="SO_TotalAmount">{{   (!empty($updateItem)) ? $updateItem->total_price : 0 }}</span>$</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
         <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Company Name<span>*</span>:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::text('company_name',  (!empty($updateItem)) ? $updateItem->company_name : null, [ 'class'=>'form-control  border-radius-0 no-resize', 'placeholder' => 'Enter Company Name',
                        'data-fv-notempty' => true,
                        'data-fv-blank' => true,
                        'data-rule-required' => true,
                        'data-fv-notempty-message' => 'Company Name is required',
                     ] )!!}
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Contact Phone No:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::text('company_contact_phone',   (!empty($updateItem)) ? $updateItem->company_contact_phone : null, [ 'class'=>'form-control  border-radius-0 no-resize', 'placeholder' => 'Enter Contact Phone No.'] )!!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Person Name:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::text('company_contact_person',   (!empty($updateItem)) ? $updateItem->company_contact_person : null,[ 'class'=>'form-control  border-radius-0 no-resize', 'placeholder' => 'Enter Contact Person Name'] )!!}
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Delivery Date:</label>
            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                <div class="form-input-icon">
                    {!!Form::text('delivery_date',   (!empty($updateItem)) ? $updateItem->delivery_date : null,[ 'class'=>'form-control  border-radius-0 no-resize datepicker-only-init', 'placeholder' => 'Enter Delivery Date'] )!!}
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        @include('layout.admin_layout_include.alert_process')
    </div>
    <div class="col-sm-12">
        @if((!empty($updateItem)))
            {!! Form::submit('Update Item',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
        @else
            {!! Form::submit('Add New Item',array('class'=>'btn btn-primary card-btn','id'=>'btn_save')) !!}
        @endif
        <a href="{{ route('sales-order-items', $order->sales_document_id ) }}" class="btn btn-danger">Cancel</a>
    </div>
</div>
{!! Form::close() !!}