<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeIDRecord extends Model
{
    use HasFactory;

    // protected $primaryKey = "uuid";
    // protected $keyType = "string";
    // public $incrementing = false;
    // protected $table = 'employee_id_records';

    //protected $fillable = ['name','slug'];
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
