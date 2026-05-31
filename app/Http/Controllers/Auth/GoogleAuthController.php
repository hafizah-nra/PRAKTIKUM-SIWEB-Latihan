<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log in or create an account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Gagal login menggunakan Google. Silakan coba lagi.']);
        }

        // Cari berdasarkan google_id
        $user = User::where('google_id', $googleUser->getId())->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        // Cari berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Perbarui google_id
            $user->update([
                'google_id' => $googleUser->getId(),
            ]);
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        // Buat user baru jika tidak ditemukan
        $newUser = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password' => Hash::make(Str::random(24)),
            'role' => 'user', // default role
        ]);

        Auth::login($newUser);
        return redirect()->route('dashboard');
    }
}
