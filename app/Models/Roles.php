<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Roles extends Model
{
    use HasFactory, HasUuid;

    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = ['name','slug'];

    public function permissions(){
        return $this->belongsTomany(Permissions::class,'roles_permissions','role_uuid','permission_uuid');
    }

    public function hasPermissions($key){
        return $this->permissions()->get()->contains($key);
    }


    public function hasPermission($permission){
        return $this->permissions()->where('name',$permission)->exists();
    }

    public function users(){
        return $this->belongsTomany(User::class,'users_roles');
    }

}
