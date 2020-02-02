<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class project_gr_cost extends Model
{

    protected $table = 'project_gr_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_id',
        'phase',
        'task_id',
        'purchase_order_number',
        'item_number',
        'amount',
        'dr_cr_indicator',
        'currency',
        'material_documber_number',
        'posting_date',
        'posted_by',
        'created_at',
        'updated_at',
        'transaction_type',
        'vendor',
        'gl_account',
    ];

    public static function calculateDifference($forcast, $actual)
    {
        $difference = array();
        foreach ($forcast as $fkey => $fval) {
            foreach ($actual as $akey => $aval) {
                if ($akey == $fkey) {
                    $difference[$fkey] = ($aval - $fval);
                }
            }
        }
        return $difference;
    }

    public static function project_gr_actualcost_project($pid)
    {
        $p_gr_cost_dr = self::query()
                ->select(DB::raw('sum(IFNULL(amount,0)) as actual_cost'))
                ->groupBy(DB::raw('project_gr_cost.project_id'))
                ->where('dr_cr_indicator', 'DR')
                ->where('project_id', $pid)
                ->first();
        $p_gr_cost_cr = self::query()
                ->select(DB::raw('sum(IFNULL(amount,0)) as actual_cost'))
                ->groupBy(DB::raw('project_gr_cost.project_id'))
                ->where('dr_cr_indicator', 'CR')
                ->where('project_id', $pid)
                ->first();
        $p_gr_cost_dr_actual_cost = isset($p_gr_cost_dr->actual_cost) ? $p_gr_cost_dr->actual_cost : 0;
        $p_gr_cost_cr_actual_cost = isset($p_gr_cost_cr->actual_cost) ? $p_gr_cost_cr->actual_cost : 0;
        $p_gr_cost = $p_gr_cost_dr_actual_cost - $p_gr_cost_cr_actual_cost;
        return isset($p_gr_cost) ? $p_gr_cost : 0;
    }

    public static function project_gr_cost_task($tid)
    {
        $p_gr_cost_dr = self::query()
                ->select(DB::raw('sum(IFNULL(amount,0)) as actual_cost'))
                ->groupBy(DB::raw('task_id'))
                ->where('task_id', $tid)
                ->where('dr_cr_indicator', 'DR')
                ->first();
        $p_gr_cost_cr = self::query()
                ->select(DB::raw('sum(IFNULL(amount,0)) as actual_cost'))
                ->groupBy(DB::raw('task_id'))
                ->where('task_id', $tid)
                ->where('dr_cr_indicator', 'CR')
                ->first();
        $p_gr_cost_dr_actual_cost = isset($p_gr_cost_dr->actual_cost) ? $p_gr_cost_dr->actual_cost : 0;
        $p_gr_cost_cr_actual_cost = isset($p_gr_cost_cr->actual_cost) ? $p_gr_cost_cr->actual_cost : 0;
        $p_gr_cost = $p_gr_cost_dr_actual_cost - $p_gr_cost_cr_actual_cost;
        return isset($p_gr_cost) ? $p_gr_cost : 0;
    }

    public static function project_gr_cost_dr_cr($type, $id = NULL)
    {

        if ($type == 'DR') {
            $query = project_gr_cost::selectRaw('sum(IFNULL(amount,0)) as totalvalue_dr,project_id,DATE_FORMAT(posting_date, "%b_%Y") as postingDate')
                    ->groupBy('project_id', 'postingDate')
                    ->where('dr_cr_indicator', 'DR');
        }
        if ($type == 'CR') {
            $query = project_gr_cost::selectRaw('sum(IFNULL(amount,0)) as totalvalue_cr,project_id,DATE_FORMAT(posting_date, "%b_%Y") as postingDate')
                    ->groupBy('project_id', 'postingDate')
                    ->where('dr_cr_indicator', 'CR');
        }

        if (isset($id))
            $query->where('project_id', $id);
        
        $project_gr_cost = $query->get()->toArray();
        return $project_gr_cost;
    }

}
