<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Company extends Model
{
    use Billable;
    protected $table = 'company';

    protected $fillable = [
        'company_name', 'logo', 'address', 'country','state'
    ];
    
    //file upload
    public static function fileupload($image){        
        $img_name = $image->getClientOriginalName();
        $imagename = time().'_'.$img_name;            
        $image->move(env('COMPANY_LOGO_PATH', ''), $imagename);  
        return $imagename;
    }
}