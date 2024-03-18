<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importações
use Illuminate\Http\RedirectResponse;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Medico;
use App\Models\Atendente;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        $medicos = Medico::all();
        $atendentes = Atendente::all();

        return view('users.index', [
            'users' => $users,
            'medicos' => $medicos,
            'atendentes' => $atendentes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_register()
    {
        //
        return view('users.register');
    }
    public function create_login()
    {
        //
        return view('users.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        switch ($request->type) {
            case 'medico':
                $medico = new Medico;
                $medico->name = $request->name;
                $medico->save();
            break;

            case 'atendente':
                $atendente = new Atendente;
                $atendente->name = $request->name;
                $atendente->save();
            break;

            default:
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::login($user);
            break;
        }

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' =>  $request->password,])) {
            $request->session()->regenerate();
            
            // return redirect('/dashboard');
            return redirect('/users');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
