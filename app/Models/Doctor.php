<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'cm',
        'birth_date',
        'address',
        'status',
        'education',
        'hiring_date',
        'opening_time',
        'closing_time',
        'user_id',
    ];
}
