<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'compliance', 'address', 'created_by', 'updated_by', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function registerUserFromApi($data)
    {
        return User::create($data);
    }
    
    public function checkEmailExist($email) 
    {  
        $user = User::whereIn('status', ['1', '2'])->where('email', $email)->get();

        if ($user->count() > 0) 
        {
            return true;
        } else 
        {
            return false;
        }  
    }
}
