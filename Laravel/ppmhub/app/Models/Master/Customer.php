<?php
namespace App\Models\Master;

use App\country;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Customer extends Model
{

    protected $table = 'master_customers';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'company_id',
        'customer_no',
        'name',
        'email',
        'website_address',
        'fax',
        'office_phone',
        'street',
        'city',
        'postal_code',
        'country',
        'state',
        'status'
    ];

    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function getFullInfoAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->customer_no.' '.$this->name);
    }


    public function countryInfo()
    {
        return $this->belongsTO(country::class, 'country', 'id');
    }

}