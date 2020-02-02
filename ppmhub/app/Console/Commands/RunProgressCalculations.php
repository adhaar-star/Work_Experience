<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Project;
use App\Projecttask;
use App\progress_calculation_physical;
use App\progress_calculation_cost_proportional;
use App\Helpers\ProjectHelpers;

class RunProgressCalculations extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RunProgressCalculations:runprogresscalculation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to run the project progress calculations under project progress module.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $projects = Project::all();
        foreach ($projects as $project) {
            $this->progress_calculation($project->id, 0);
            $this->progress_calculation($project->id, 1);
        }
    }

    public function progress_calculation($pid, $method)
    {
        $project_id = $pid;
        $data = Project::where('id', $project_id)
                ->first();

        $start_date = date('Y-m-d', strtotime($data->start_date));
        $end_date = ($data->end_date != null ) ? date('Y-m-d', strtotime($data->end_date)) : '';
        $actual_progress = 0;


        /**
         * get actual cost for project 
         * pass incremental id as arrgument
         * */
        $actual_cost = ProjectHelpers::get_actual_cost_project($project_id);


        /** progress calculation manual 
         *  formula => sum((weight% * completion%)/100 ) 
         */
        $tasks = Projecttask::where('project_id', $data->project_Id)
                ->where('company_id', $data->company_id)
                ->get()
                ->toArray();

        if ($method == 0) {

            $phy_progress = 0;
            $count = 0;
            foreach ($tasks as $key => $task) {
                $phy_progress += ((($task['weighting_factor']) * ($task['completion'])) / 100);
                $count++;
            }

            if ($count > 0) {
                $phy_progress = $phy_progress / $count;
            }
            $actual_progress = round($phy_progress, 2);
        }
        /* progress calculation cost proportional
         * formula => sum(( Task actual cost / task planned cost ) *100 )  */
        if ($method == 1) {
            $cost_prop_progress = 0;
            $count = 0;
            if ($planned_cost != 0) {
                $cost_prop_progress = ($actual_cost / $planned_cost) * 100;
            }
            foreach ($tasks as $key => $task) {
                $count++;
            }
            if ($count > 0) {
                $cost_prop_progress = $cost_prop_progress / $count;
            }
            $actual_progress = round($cost_prop_progress, 2);
        }

        /**
         * Get project planned cost from cost planing modules
         */
        $projectid = $data->project_Id;


        $planned_cost = ProjectHelpers::get_project_planned_cost($projectid);

        /* End of Planned cost */



        /*
         * get_planned_progress
         */
        $planned_progress = ProjectHelpers::get_planned_progress($start_date, $end_date, ($data->company_id != null) ? $data->company_id : 0);
        $planned_progress = $planned_progress['progress'];



        /*
         * BCWS (PV): Planned Progress % * Total Planned costs
         */
        $BCWS = ($planned_progress / 100) * $planned_cost;


        /*
         * BCWP (EV): Actual progress %* Total planned costs
         */
        $BCWP = ($actual_progress / 100) * $planned_cost;


        /*
         * ACWP: Actual progress %* Total actual costs
         */

        $ACWP = ($actual_progress / 100) * $actual_cost;

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => $data->company_id,
        ];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                
            }
        }
    }

}
