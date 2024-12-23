<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Usuario editado com sucesso!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(User $user, Request $request): RedirectResponse
    {
        if (Auth::user()->type != 'admin') {
            # code...
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);
    
            $user->profile->delete();
    
            Auth::logout();
    
            $user->delete();
    
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return Redirect::to('/')->with('success', 'Usuario deletado com sucesso!');
        } else {
            # code...
            $user->profile->delete();
            $user->delete();
    
            return Redirect::to('/admin')->with('success', 'Usuario deletado com sucesso!');
        }
        
    }
}
