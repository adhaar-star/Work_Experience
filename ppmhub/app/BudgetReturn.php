<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Project;
use Illuminate\Support\Facades\Auth;

class BudgetReturn extends Model
{

    protected $table = 'budget_return';
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

    public static function storeBudgetReturn($post)
    {
        
    }
    
    public static function returnBudget()
    {
        $rBudget = Project::query()
                ->select(DB::raw('budget_return.project_id'), DB::raw('sum(overall) as budget_return_overall'))
                ->join('budget_return', 'budget_return.project_id', '=', 'project.id')
                ->where('project.company_id', '=', Auth::user()->company_id)
                ->groupBy(DB::raw('budget_return.project_id'))
                ->get();
        return $rBudget;
    }

}
