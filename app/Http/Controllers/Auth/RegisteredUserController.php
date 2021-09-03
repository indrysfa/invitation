<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'slug' => 'required|string|max:12|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::all();
        if ($user->isEmpty()) {
            $pick_role = 1;
        } else {
            $pick_role = 2;
        }

        $user = User::create([
            'slug' => Str::slug(strtolower($request->slug)),
            'name' => ucwords($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $pick_role,
        ]);

        event(new Registered($user));

        // Auth::login($user);
        Auth::routes(['verify' => true]);
        return redirect('verify-email');

        // return redirect(RouteServiceProvider::HOME);
    }
}
