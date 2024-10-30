<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'sus_number' => ['required', 'integer', 'unique:patients'],
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],
            'gender' => ['required', 'in:Male,Female'],
            'notes' => ['nullable', 'string'],
        ]);

        Patient::create([
            'sus_number' => $request->sus_number,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'notes' => $request->notes,
        ]);

        if (Auth::user()->type != 'admin') {
            # code...
            return redirect('/dashboard')->with('success', 'Patient created successfully!');
        }else{
            return redirect('/admin')->with('success', 'Patient created successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}