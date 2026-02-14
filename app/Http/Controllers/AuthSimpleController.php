<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthSimpleController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // default role/is_admin is handled by DB defaults
        ]);

        Auth::login($user); // auto login after register
        $request->session()->regenerate();

        //  If newly created user is admin (role or is_admin), go to admin dashboard
        if (($user->role ?? null) === 'admin' || (int)($user->is_admin ?? 0) === 1) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //  Failed login
        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        //  Successful login
        $request->session()->regenerate();

        $user = Auth::user();

        //  Admin redirect (supports either "role" OR "is_admin")
        if (($user->role ?? null) === 'admin' || (int)($user->is_admin ?? 0) === 1) {
            return redirect()->route('admin.dashboard');
        }

        //  Employee redirect
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
