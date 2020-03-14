<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    const ADMIN_USER_ID = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'role'];


    public function toArray()
    {
        $array = parent::toArray();

        foreach ($array as $k => $v) {
            if (empty($v)) {
                $array[$k] = "";
            } else {
                $array[$k] = $v;
            }
        }
        
        return $array;
    }

    public static function vendorRules( $type = 'create', $id = null )
    {
        $rules =  [
          'username'        => 'required|unique:users,username',
          'email' => 'required|email|unique:users,email',
          'password' => 'required',
          'role'  => 'in:vendor,admin,customer',
          'status' => 'in:active,inactive,blocked',
         
        ];

        if ($type == 'update') {
            $rules['username'] = 'required|unique:users,username,'.$id;
            $rules['email'] = 'required|email|unique:users,email,'.$id; 
            unset($rules['password']);
        }

        return $rules;
    }


    public function setPasswordAttribute($value) {

        $this->attributes['password'] = \Hash::make($value);

    }

    public static function statusList() {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'blocked' => 'blocked'
        ];
    }

    public function store() {
        return $this->hasOne('\App\Models\Store', 'vendorId', 'id');
    }

    public function delete() {

        if (in_array($this->id, [1,2])) {
            return false;
        }

        return parent::delete();
    }

    public function address(){

      return $this->hasMany('\App\Models\Address','userId','id');
    }

    public function reward(){
      return $this->hasOne('\App\Models\RewardPoint','user_id','id');
    }

}
