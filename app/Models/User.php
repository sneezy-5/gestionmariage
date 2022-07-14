<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_admin',
        'name',
        'email',
        'password',
    ];

    public $role="";

    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){
        return $this->belongsTomany(Roles::class,'users_roles','user_uuid','role_uuid');
    }


    /*
    * user roles 
    */
    public function roleAll($id){
        
        $roles = User::find($id)->roles()->orderBy('name')->get();
        
        foreach($roles as $r){
            $this->role = $r->name;
        }
        return $roles;
    }
    

    // get user role by name if exists return true
    public function hasRoles($roles)
    {
        return $this->roles()->where('name', $roles)->exists();
    }


       // get user role by name if exists return true
       public function hasRole($role)
       {
           return $this->roles()->where('slug', $role)->first();
       }



    /*
    * get all permissions
    */
    public function permissions(){
        return $this->belongsTomany(Permissions::class,'users_permissions');
    }

      // get user permissions by name if exists return true
    public function hasPermissions($permision)
    {
        return $this->permissions()->where('name', $permision)->exists();
    } 

}
