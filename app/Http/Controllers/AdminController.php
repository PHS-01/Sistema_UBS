<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::whereIn('type', ['receptionist', 'doctor'])->get();

        $receptionists = $users->where('type', 'receptionist');
        $doctors = $users->where('type', 'doctor');

        return view('users.admin.index', compact('receptionists', 'doctors'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        //
        return view('users.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        switch ($request->type) {

            case 'admin':
                # code...
                Admin::create([
                    'user_id' => $user->id
                ]);

                break;

            case 'receptionist':
                # code...
                Receptionist::create([
                    'user_id' => $user->id
                ]);

                break;

            case 'doctor':
                # code...
                Doctor::create([
                    'cm' => $request->cm,
                    'birth_date' => $request->birth_date,
                    'address' => $request->address,
                    'status' => $request->status,
                    'education' => $request->education,
                    'hiring_date' => $request->hiring_date,
                    'opening_time' => $request->opening_time,
                    'closing_time' => $request->closing_time,
                    'user_id' => $user->id
                ]);

                break;
                        
            default:
                # code...
                break;
        }

        return redirect('/admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
