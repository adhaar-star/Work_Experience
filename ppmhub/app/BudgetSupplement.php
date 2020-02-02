<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BudgetSupplement extends Model {

    protected $table = 'budget_supplement';
    protected $fillable = [
        'project_id',
        'period_from',
        'period_to',
        'overall',
        'year1',
        'year2',
        'year3',
        'year4',
        'year5',        
        'current_budget',
        'changed_by',
        'status',
        'created_by',
        'company_id'
    ];

    public static function validateBudgetSupplement($post) {
        $validationmessages = [
            'project_id.required' => "Please select project",
            'period_from.required' => "Please select period from",
            'period_to.required' => "Please select period to",
            'overall.required' => "Please enter overall budget",
            'overall.numeric' => "Please enter only number",                       
        ];

        $validator = Validator::make($post, [
                    'project_id' => "required",
                    'period_from' => "required",
                    'period_to' => "required",
                    'overall' => "required|numeric",                                        
                        ], $validationmessages);
        return $validator;
    }
    
    public static function supplementBudget() {
        $sBudget = Project::query()
            ->select(DB::raw('budget_supplement.project_id'), DB::raw('sum(overall) as budget_supplement_overall'))
            ->join('budget_supplement', 'budget_supplement.project_id', '=', 'project.id')
            ->where('project.company_id', '=', Auth::user()->company_id)
            ->groupBy(DB::raw('budget_supplement.project_id'))
            ->get();
        return $sBudget;
    }

}
