<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Laravel default uses 'email' for authentication, so we need to find user by username
        $user = User::where('username', $credentials['username'])->first();
        $usPass = hash('sha256', $credentials['password']);
        if ($user) {
            if ($user->password == $usPass) {
                $isPass = true;
            } else {
                $isPass = false;
            }
        }

        if (!$user || !$isPass) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->withInput();
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => hash('sha256', $request->password),
            'remember_token' => Str::random(5)
        ]);
        // Produk::create([
        //     'kode_produk' => hash('sha256', $request->password),
        //     'nama_produk' => Str::random(5),
        //     'harga' => '3000',
        //     'stok' => 30,
        //     'supplier_id' => 30
        // ]);

        // After registration, redirect to login page instead of auto login
        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
