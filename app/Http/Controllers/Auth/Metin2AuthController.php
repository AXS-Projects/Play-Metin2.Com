<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Metin2User;

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

            // Caută utilizatorul în baza de date
            $user = Metin2User::where('login', $request->login)->first();

            if (!$user) {
                return back()->with('error', __('messages.auth_username_invalid'));
            }

            // Verifică parola folosind MySQL PASSWORD()
            $passwordCheck = DB::connection('account')
                ->selectOne("SELECT PASSWORD(?) as hashed", [$request->password]);

            if (!$passwordCheck || $passwordCheck->hashed !== $user->password) {
                return back()->with('error', __('messages.auth_password_invalid'));
            }

            // ✅ Logare utilizator
            Auth::guard('metin2')->login($user);

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
        Auth::guard('metin2')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', __('messages.auth_logout'));
    }
}
