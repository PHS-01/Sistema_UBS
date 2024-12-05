<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\Patient;
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
        $patients = Patient::all();

        return view('users.admin.index', compact('receptionists', 'doctors', 'patients'));

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

        return redirect('/admin')->with('success', $request->type.'criado com sucesso!');
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
        // Validação básica
        $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Atualiza apenas os campos fornecidos para o usuário
        $user->update([
            'name' => $request->filled('name') ? $request->name : $user->name,
            'email' => $request->filled('email') ? $request->email : $user->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Verifica e atualiza dados específicos por tipo de usuário
        switch ($user->type) {
            case 'admin':
                // Exemplo: atualiza somente se houver mudanças
                
                break;

            case 'receptionist':
                
                break;

            case 'doctor':
                    $user->profile->update([
                        'cm' => $request->filled('cm') ? $request->cm : $user->profile->cm,
                        'birth_date' => $request->filled('birth_date') ? $request->birth_date : $user->profile->birth_date,
                        'address' => $request->filled('address') ? $request->address : $user->profile->address,
                        'status' => $request->filled('status') ? $request->status : $user->profile->status,
                        'education' => $request->filled('education') ? $request->education : $user->profile->education,
                        'hiring_date' => $request->filled('hiring_date') ? $request->hiring_date : $user->profile->hiring_date,
                        'opening_time' => $request->filled('opening_time') ? $request->opening_time : $user->profile->opening_time,
                        'closing_time' => $request->filled('closing_time') ? $request->closing_time : $user->profile->closing_time,
                    ]);
                break;
        }

        return redirect('/admin/edit/'.$user->id)->with('success', $user->type.'atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
