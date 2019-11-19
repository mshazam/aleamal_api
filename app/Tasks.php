<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    <?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * User
 * 
 * @version 1.0.0
 * @since 1.0.0
 * @author Uday Kumar
 *
 */
class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     Service ID
o   Title
o   Detail
o   Type (Online/Physical)
o   Location
o   Due Date
o   Budget
     */
    protected $fillable = [
        'service_id', 'title', 'details','type','address'
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
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        return $this->attributes['name'] = ucfirst($value);
    }
    
    /**
     * Set the password
     * 
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }
}
//end of class tasks
//end of file tasks.php
}
