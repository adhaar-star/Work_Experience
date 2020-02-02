<?php
namespace App\Models\timeSheetWorks;

use App\Employee_records;
use Illuminate\Database\Eloquent\Model;
use Auth;

class StWork extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'st_works';
    protected $primaryKey = 'st_work_id';
    protected $fillable = [
        'company_id',
        'employee_id',
        'approver_id',
        'on_behalf_approver_id',
        'st_work_date',
        'st_work_status'
    ];


    public function employee()
    {
        return $this->belongsTO(Employee_records::class, 'employee_id');
    }

    public function StWorkTimes()
    {
        return $this->hasMany(StWorkTime::class, 'st_work_id');
    }
    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function scopeSearchBy($query, $request)
    {

        if ($request->get('end_date')) {
            $query->whereDate('created_at', '<=', $request->get('end_date'));
        }
        if ($request->get('start_date')) {
            $query->whereDate('created_at', '>=', $request->get('start_date'));
        }
        return $query;
    }


}