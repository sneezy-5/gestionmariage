<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permissions extends Model
{
    use HasFactory, HasUuid;

    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = ['name','slug'];

    public function roles(){
        return $this->belongsTomany(Role::class,'roles_permissions');
    }

    public function users(){
        return $this->belongsTomany(User::class,'users_permissions');
    }
}
