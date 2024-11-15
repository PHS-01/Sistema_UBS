<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Admin;
use App\Models\Receptionist;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
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

        event(new Registered($user));

        Auth::login($user);

        switch ($request->type) {

            case 'admin':
                # code...
                Admin::create([
                    'user_id' => $user->id
                ]);

                return redirect('/admin');
                break;

            case 'receptionist':
                # code...
                Receptionist::create([
                    'user_id' => $user->id
                ]);

                return redirect('/dashboard');
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

                return redirect('/dashboard');

                break;
                        
            default:
                # code...
                break;
        }
    }
}
