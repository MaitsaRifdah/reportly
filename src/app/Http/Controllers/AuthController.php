<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'no_hp'    => 'required|string|max:20',
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'warga';

        $user = User::create($data);
        Auth::login($user);

        return redirect()->route('warga.dashboard');
    }

    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $cred = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($cred)) {
            $request->session()->regenerate();
            return match (auth()->user()->role) {
                'admin'   => redirect()->route('admin.dashboard'),
                'petugas' => redirect()->route('petugas.dashboard'),
                default   => redirect()->route('warga.dashboard'),
            };
        }
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}