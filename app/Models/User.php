<?php

namespace App\Models;

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
        'name', 'email', 'password','age','country'
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

     /**
     * The Setter atrribute
     *
     * @var function
     */

    public function setPasswordAttribute($password)
        {$this->attributes['password'] = bcrypt($password);}

     /**
     * Relation
     *
     * @var function
     */
    public function hobby(){
        return $this->hasMany(Hobby::class);
    }

    /**
     * Relation
     *
     * @var validation
     */
    public static $createRules = [
       'name'       => 'required|string',
       'age'        => 'required|integer',
       'country'    => 'required|string',
       'email'      => 'required|email|unique:users,email',
       'nip'        => 'required|string|unique:users,nip',
       'password'   => 'required|string|confirmed|min:6',
     ];
}
