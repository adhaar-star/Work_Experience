<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\RoleAuthHelper;

class Manual_capacity extends Model {

    protected $table = 'manual_capacity';
    protected $fillable = [
        'portfolio',
        'bucket',
        'category',
        'group',
        'view',
        'planning_unit',
        'hours_day',
        'start_date',
        'end_date',
        'status',
        'company_id'
    ];
    public $timestamps = true;

    public function portfolioId()
    {
        return $this->hasOne('App\Portfolio', 'id', 'portfolio');
    }
    
    public function buckets()
    {
        return $this->hasOne('App\Buckets', 'id', 'bucket');
    }

    public static function validateManualCapacity($post) {
        $validationmessages = [
            'portfolio.required' => 'Please select portfolio',
            'bucket.required' => 'Please select bucket',
            'hours_day.required' => 'Please enter hours/day',
            'hours_day.numeric' => 'Please enter in digits',
            'start_date.required' => 'Please select start date',
            'end_date.required' => 'Please select end date',
            'planning_unit.required' => 'Please select planning unit',
        ];

        $validator = Validator::make($post, [
                    'portfolio' => 'required',
                    'bucket' => 'required',
                    'hours_day' => 'required|numeric',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'planning_unit' => 'required',
                        ], $validationmessages);
        return $validator;
    }
    
    public static function manualDashboadDatatable(){
        $manualCapacity = Manual_capacity::where('company_id', Auth::user()->company_id)->get();
        
        return DataTables::of($manualCapacity)
                ->editColumn('id', function ($data) {
                    return isset($data->portfolioId->port_id) ? $data->portfolioId->port_id : '';
                })
                ->editColumn('portfolio', function ($data) {
                    return isset($data->portfolioId->name) ? $data->portfolioId->name : '-';
                })
                ->editColumn('bucket', function ($data) {
                    return isset($data->buckets->bucket_id) ? $data->buckets->bucket_id : '-';
                })
                ->editColumn('view', function ($data) {
                    if($data->view == 'Demand')
                        return '<label class="label label-success">'.$data->view.'</label>';
                    else if($data->view == 'Assigned')
                        return '<label class="label label-info">'.$data->view.'</label>';
                    else if($data->view == 'Actual')
                        return '<label class="label label-secondary">'.$data->view.'</label>';
                    else if($data->view == 'Forecast')
                        return '<label class="label label-warning">'.$data->view.'</label>';
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d-m-Y');
                })
                ->addColumn('action', function ($data) {
                    $actionButton = (RoleAuthHelper::hasAccess('manualCapacity.dashboard') != true) ? ' <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-eye" aria-hidden="true"></i>' : '<a title="View" href="javascript:void(0)" data-id=' . $data->id . ' class="viewManualCapacity btn btn-info btn-xs  margin-right-1"><i class="fa fa-eye "></i> </a>';
                    $actionButton .= (RoleAuthHelper::hasAccess('manualCapacity.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-pencil"></i>' : '<a  href="' . route('manualCapacity.update', [$data->id . '/edit']) . '"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i></a>';
                    $actionButton .= (RoleAuthHelper::hasAccess('manualCapacity.delete') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash"></i>' : '<a title="Delete" href="javascript:void(0)"  data-id=' . $data->id . ' data-url-delete="'.route('manualCapacity.delete', [$data->id]).'" class="deleteManualCapacity btn btn-danger btn-xs margin-right-1"><i class="fa fa-trash"></i></a>';
                    
                    return $actionButton;
                })
                ->rawColumns(['group', 'category', 'view', 'action'])
                ->make(true);
    }

}
