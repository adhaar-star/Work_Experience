<?php
namespace App\Models\timeSheetWorks;

use App\Project;
use App\TasksSubtask;
use Illuminate\Database\Eloquent\Model;

class StWorkTime extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'st_work_time';
    protected $primaryKey = 'st_work_time_id';

    protected $fillable = [
        'st_work_id',
        'company_id',
        
        'project_id',
        'task_id',

        'total_time',
        'total_minutes',
    ];

    public function StWork()
    {
        return $this->belongsTo(StWork::class, 'st_work_id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function task(){
        return $this->belongsTo(TasksSubtask::class, 'task_id');
    }
}