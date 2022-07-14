<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    // protected $primaryKey = "uuid";
    // protected $keyType = "string";
    // public $incrementing = false;

    //protected $fillable = ['name','slug'];
    protected $guarded = [];

    public function contract()
    {
        return $this->hasMany(Contract::class,'employee_uuid');
    }
}
