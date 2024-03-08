<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importações
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
        $medicos = User::find(Medico::all('user_id'));
        $atendentes = User::find(Atendente::all('user_id'));

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
        return view('users.create');
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
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->type == 'medico') {
            # code...
            $medico = new Medico;
            $medico->user_id = $user->id;
            $medico->save();
        }elseif($request->type == 'atendente'){
            # code...
            $atendente = new Atendente;
            $atendente->user_id = $user->id;
            $atendente->save();
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

    public function logout()
    {
        //
    }
}
