<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Scheduling;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SchedulingController extends Controller
{
    /**
     * Display a listing of the schedulings.
     */
    public function index()
    {
        // $schedulings = Scheduling::with(['patient', 'doctor', 'receptionist'])->get();
        // return view('schedulings.index', compact('schedulings'));
    }

    /**
     * Show the form for creating a new scheduling.
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = User::where('type', 'doctor')->get();

        return view('scheduling.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created scheduling in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => ['string'],
            'scheduled_at' => ['required', 'date', 'unique:schedulings'],
        ]);

        Scheduling::create([
            'description' => $request->description,
            'scheduled_at' => $request->scheduled_at,
            'patient_id' => $request->patient_id,
            'doctor_id' => Doctor::where('user_id', $request->doctor_id)->first()->id,
            'receptionist_id' => Auth::user()->profile->id,
        ]);

        return redirect('/dashboard')->with('success', 'Scheduling created successfully!');
    }

    /**
     * Display the specified scheduling.
     */
    public function show(Scheduling $scheduling)
    {
        
    }

    /**
     * Show the form for editing the specified scheduling.
     */
    public function edit(Scheduling $scheduling)
    {
    
    }

    /**
     * Update the specified scheduling in storage.
     */
    public function update(Request $request, Scheduling $scheduling): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string'],
            'scheduled_at' => ['required', 'date', 'unique:schedulings,scheduled_at,' . $scheduling->id],
            'status' => ['required', 'in:Pending,In Progress,Cancelled,Completed'],
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'receptionist_id' => ['required', 'exists:receptionists,id'],
        ]);

        $scheduling->update([
            'description' => $request->filled('description') ? $request->description : $scheduling->description,
            'scheduled_at' => $request->filled('scheduled_at') ? $request->scheduled_at : $scheduling->scheduled_at,
            'status' => $$request->filled('status') ? $request->status : $scheduling->status,
            'patient_id' => $request->filled('patient_id') ? $request->patient_id : $scheduling->patient_id,
            'doctor_id' => $request->filled('doctor_id') ? $request->doctor_id : $scheduling->doctor_id,
            'receptionist_id' => $request->filled('receptionist_id') ? $request->receptionist_id : $scheduling->receptionist_id,
        ]);

        return redirect()->back()->with('success', 'Scheduling updated successfully!');
    }

    /**
     * Remove the specified scheduling from storage.
     */
    public function destroy(Scheduling $scheduling): RedirectResponse
    {
        $scheduling->delete();
        return redirect()->back()->with('success', 'Scheduling deleted successfully!');
    }
}