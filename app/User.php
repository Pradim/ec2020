<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRules($act = 'add'){
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:admin,seller,user',
            'address' => 'nullable|string',
            'image' =>'sometimes|image|max:5120',
            'phone' => 'nullable|string',
            'data.*' => 'nullable',
        ];
        if($act != 'add'){
            $rules['password'] = 'nullable|string|min:6|confirmed';
            $rules['email'] = 'nullable|email';
        }
        return $rules;
    }

    public function getRegRules($act = 'add'){
        $rules = [
            'reg_name' => 'required|string|max:50',
            'reg_email' => 'required|email|unique:users,email',
            'reg_password' => 'required|string|min:8|same:password_confirmation',
        ];
        if($act != 'add'){
            $rules['reg_password'] = 'nullable|string|min:8|same:password_confirmation';
            $rules['reg_email'] = 'nullable|email';
        }
        return $rules;
    }

    public function user_info(){
        return $this->hasOne('App\Models\UserInfo', 'user_id', 'id');
    }

    public function getUserByType($role){
        return $this->where('role', $role)
        ->where('id', '!=', request()->user()->id)
        ->with('user_info')->paginate();
    }

}
