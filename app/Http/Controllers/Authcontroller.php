<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('login');
    }


    public function proses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $users = [
            ['username' => 'admin',    'password' => '1234',   'nama' => 'Administrator', 'role' => 'admin'],
            ['username' => 'hafizhah', 'password' => '123456', 'nama' => 'hafizhah',       'role' => 'pembeli'],
        ];

        $username = $request->username;
        $password = $request->password;

        $found = collect($users)->first(
            fn($u) => $u['username'] === $username && $u['password'] === $password
        );

        if (!$found) {
            return back()
                ->withErrors(['login' => 'Username atau password salah.'])
                ->withInput();
        }

        session()->regenerate();
        session([
            'user'     => $found['username'],
            'nama'     => $found['nama'],
            'role'     => $found['role'],
            'login_at' => now()->timestamp,
        ]);

        if ($request->has('remember')) {
            cookie()->queue('username', $found['username'], 60 * 24 * 30);
        } else {
            cookie()->queue(cookie()->forget('username'));
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}