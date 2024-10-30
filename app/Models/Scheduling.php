<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Scheduling extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'schedulings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'scheduled_at',
        'status',
        'patient_id',
        'doctor_id',
        'receptionist_id',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * Relationships: A scheduling belongs to a patient.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * A scheduling belongs to a doctor.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * A scheduling belongs to a receptionist.
     */
    public function receptionist()
    {
        return $this->belongsTo(Receptionist::class);
    }
}