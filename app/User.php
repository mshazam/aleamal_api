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
      
     */
    protected $fillable = [
        'first_name','last_name','phone','social_media_id','profile_image', 'email', 'password','conf_password',
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
//end of class User
//end of file User.php