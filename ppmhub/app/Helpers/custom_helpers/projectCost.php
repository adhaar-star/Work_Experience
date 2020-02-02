<?php
//app/Helpers/Envato/User.php
namespace App\Helpers\custom_helpers;
 
use Illuminate\Support\Facades\DB;
use App\project_gr_cost;

class projectCost {
    /**
     * @param none
     * Calculates actual cost for all project
     * @return integer
     */
    public static function get_actual_cost() {
        // get project cost from project_gr_cost table 
        $project_gr_cost = project_gr_cost::project_gr_actualcost();
        
        //get employee cost for projects
        //$project_timesheet_cost = timesheet::actualcost();
        
        $actual_cost = $project_gr_cost;//+ $project_timesheet_cost;    
        return ($actual_cost);
    }
}
