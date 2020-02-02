<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Roleauth extends Model
{
    protected $table = 'roleauth';
    
    public static function check($action_slug) {
        $user = Auth::user();
        $roleauth = Roleauth::where('action_slug', $action_slug)->where('role_id', $user->role_id)->first();
       
        if (isset($roleauth) && $roleauth->permission == true) {
            return;
        } else {
            return;
            //abort(403, 'You are not unauthorized to access this page.');
        }
    }
}
