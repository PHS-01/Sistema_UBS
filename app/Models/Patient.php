<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'sus_number',
        'name',
        'birth_date',
        'phone',
        'address',
        'gender',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'birth_date' => 'date',
    ];
}