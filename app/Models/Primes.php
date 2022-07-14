<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Primes extends Model
{
    use HasFactory, HasUuid;

    protected $primaryKey = "uuid";
    protected $keyType = "string";
    public $incrementing = false;

    protected $guarded = [];
}
