<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anamneses extends Model
{
    //
    use HasFactory;

    protected $table = 'Anamneses';

    protected $fillable = [
        'schedulings_id',
        'chief_complaint',
        'medical_history',
        'family_history',
        'lifestyle_habits',
        'symptoms',
    ];

    public function scheduling()
    {
        return $this->belongsTo(scheduling::class, 'schedulings_id');
    }
}
