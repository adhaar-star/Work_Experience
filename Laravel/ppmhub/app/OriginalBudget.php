<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OriginalBudget extends Model {

    protected $table = 'budget_original';
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
        'original_budget',
        'changed_by',
        'status',
        'created_by',
        'company_id'
    ];

    public static function budgetOriginal($reportProject_from = NULL, $reportProject_to = NULL, $reportStart_date = NULL, $reportEnd_date = NULL) {
        $query = self::query()
                ->select('budget_original.*', 'project.project_Id as project_PID', 'project.project_name', 'project.project_desc', DB::raw('DATE_FORMAT(project.p_start_date, "%d-%m-%Y") as p_start_date '), DB::raw('DATE_FORMAT(project.p_end_date, "%d-%m-%Y") as p_end_date '), 'budget_original.overall as budget_org_overall')
                ->leftJoin('project', 'budget_original.project_id', '=', 'project.id')
                ->orderBy('budget_original.id', 'desc')
                ->where('project.company_id', '=', Auth::user()->company_id);

        if (isset($reportProject_from) && isset($reportProject_to)){
            $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);
        }
        if (isset($reportStart_date) && $reportStart_date != "-")
            $query->where('project.p_start_date', '>=', $reportStart_date);
        if (isset($reportEnd_date) && $reportEnd_date != "-")
            $query->where('project.p_end_date', '<=', $reportEnd_date);

        return $query->get();
    }
    
    public static function getProjectOverallBudget($pid){
        $query = self::query()
                ->select('budget_original.overall')
                ->where('project_id',$pid)
                ->first();
        
        if(count($query) > 0) $query->toArray();
        return isset($query['overall']) ? $query['overall'] : 0;
    }

}
