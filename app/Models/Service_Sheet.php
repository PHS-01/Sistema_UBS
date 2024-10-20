<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service_Sheet extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'number',         
        'timeout',
        'name',                                  
        'sus_card',
        'email',
        'phone_number'
    ];
}
