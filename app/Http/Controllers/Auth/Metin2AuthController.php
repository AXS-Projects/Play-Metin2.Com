<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\Metin2User;
use App\Models\AuditLog;

class Metin2AuthController extends Controller
{
    /**
     * Procesul de login.
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string',
            ]);

            $throttleKey = Str::lower($request->login).'|'.$request->ip();
            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                return back()->with('error', __('messages.auth_throttle', ['seconds' => $seconds]));
            }

            // Caută utilizatorul în baza de date
            $user = Metin2User::where('login', $request->login)->first();

            if (!$user) {
                return back()->with('error', __('messages.auth_username_invalid'));
            }

            if (str_starts_with($user->password, '*')) {
                $validPassword = \App\Support\MySQLPassword::check($request->password, $user->password);
            } else {
                $validPassword = Hash::check($request->password, $user->password);
            }

            if (!$validPassword) {
                RateLimiter::hit($throttleKey);
                return back()->with('error', __('messages.auth_password_invalid'));
            }

            // ✅ Logare utilizator
            RateLimiter::clear($throttleKey);

            Auth::guard('metin2')->login($user, $request->boolean('remember'));

            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'login',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->back()->with('success', __('messages.auth_success'));

        } catch (\Exception $e) {
            \Log::error("Login error: " . $e->getMessage());

            return back()->with('error', 'A apărut o eroare. Verifică logurile.');
        }
    }

    /**
     * Procesul de logout.
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('metin2')->user();
        Auth::guard('metin2')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($user) {
            AuditLog::create([
                'user_id' => $user->id,
                'action' => 'logout',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return redirect()->route('index')->with('success', __('messages.auth_logout'));
    }
}
