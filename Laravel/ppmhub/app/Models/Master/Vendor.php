<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Vendor extends Model
{

    protected $table = 'master_vendors';
    protected $primaryKey = 'vendor_id';

    protected $fillable = [
        'vendor_id',
        'company_id',
        'vendor_no',
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
        return preg_replace('/\s+/', ' ',$this->vendor_no.' '.$this->name);
    }

    function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    
}