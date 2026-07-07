<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 🔄 CHANGED: Removed the 'email' validation block completely
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class], 
            'password' => [
                'required', 
                'confirmed', 
                'min:4' // minimum requirement to 4 characters
            ],
        ]);

        // 🔄 CHANGED: Removed 'email' mapping from database insertion
        $user = User::create([
            'username' => $request->username, 
            'password' => Hash::make($request->password),
        ]);

        return redirect(route('login'))->with('status', 'Registration successful! Please log in.');
    }
}