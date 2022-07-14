<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, HasUuid;

    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;

    //protected $fillable = ['name','slug'];
    protected $guarded = [];

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class);
    // }
}
