<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            if ($user->role === 'merchant') {
                if ($user->status === 'pending') {
                    Auth::logout();
                    return back()->with('error', 'Akun pengepul Anda masih menunggu validasi admin.');
                }
                return redirect()->route('merchant.dashboard')->with('success', 'Login berhasil!');
            }
            return redirect()->route('customer.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:customer,merchant'
        ]);

        $status = $request->role === 'merchant' ? 'pending' : 'approved';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $status,
            'point_balance' => 0
        ]);

        if ($request->role === 'customer') {
            Auth::login($user);
            return redirect()->route('customer.dashboard')->with('success', 'Registrasi berhasil!');
        }

        return redirect()->route('login')->with('success', 'Registrasi pengepul berhasil, mohon tunggu validasi admin.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}
