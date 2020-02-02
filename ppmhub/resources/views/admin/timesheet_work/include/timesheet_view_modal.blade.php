<div class="modal fade" id="copyWeekModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="margin-bottom-10">
                    Select a Week
                </div>

            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['url' =>route('timesheet-work-copy-week'),   'class' => 'form-horizontal form-label-left']) !!}
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                <?php $weekNumbers=[];?>
                                @foreach ($week_dates as $week_date_number => $week_date)
                                    <?php $weekNumbers[$week_date_number] ="Week {$week_date_number}";?>
                                @endforeach
                                {!! Form::select("week_to_id", $weekNumbers, null, ['class' => 'form-control border-radius-0 datepicker-only-init', 'required' => 'required', 'placeholder'=>'Select Week']) !!}
                                {!! Form::hidden("week_from_id", null , ['class'=>'weekFormId']) !!}
                                {!! Form::hidden("employee_id", $employee_id ) !!}
                                {!! Form::hidden("current_date", $current_date ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                {!! Form::select("week_status", ['pending'=>'Pending', 'draft'=>'Draft'], null, ['class' => 'form-control border-radius-0 datepicker-only-init', 'required' => 'required', 'placeholder'=>'Select Status']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                <button type="submit"  class="btn btn-primary card-btn"><i class="fa fa-copy"></i> Copy Week </button>
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="setWeekModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document" style="text-align:left;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="margin-bottom-10">
                    Select a Week
                </div>

            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['url' =>route('timesheet-work-copy-week'),   'class' => 'form-horizontal form-label-left']) !!}
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                <?php $weekNumbers=[];?>
                                @foreach ($week_dates as $week_date_number => $week_date)
                                    <?php $weekNumbers[$week_date_number] ="Week {$week_date_number}";?>
                                @endforeach
                                {!! Form::select("week_from_id", $weekNumbers, null, ['class' => 'form-control border-radius-0 datepicker-only-init', 'required' => 'required', 'placeholder'=>'Copy from']) !!}
                                {!! Form::hidden("week_to_id", null , ['class'=>'setWeekId']) !!}
                                {!! Form::hidden("employee_id", $employee_id ) !!}
                                {!! Form::hidden("current_date", $current_date ) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                {!! Form::select("week_status", ['pending'=>'Pending', 'draft'=>'Draft'], null, ['class' => 'form-control border-radius-0 datepicker-only-init', 'required' => 'required', 'placeholder'=>'Select Status']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <div class="form-group form-margin-btm">
                            <div class="form-input-icon">
                                <button type="submit"  class="btn btn-primary card-btn">Copy Week</button>
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>