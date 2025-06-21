<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    // Afișează formularul pentru schimbarea parolei
    public function showChangePasswordForm()
    {
        return view('auth.change-password', [
            'title' => ' - Change Password',
        ]);
    }

    public function updatePassword(Request $request)
    {
        // 🔹 1. Validare puternică a parolelor
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d!$%@#£€*?&]{8,}$/'],
        ]);
    
        // 🔹 2. Obținem utilizatorul din sesiune
        $sessionUser = session('metin2_user');
    
        if (!$sessionUser) {
            return redirect()->route('index')->withErrors(['current_password' => __('messages.error_not_authenticated')]);
        }
    
        // 🔹 3. Verificăm dacă utilizatorul există în baza de date
        $user = \DB::connection('account')->table('account')->where('id', $sessionUser->id)->first();
    
        if (!$user) {
            return back()->withErrors(['current_password' => __('messages.error_user_not_found')]);
        }
    
        // 🔹 4. Verificăm parola actuală folosind SHA1(SHA1(password)) și adăugăm "*"
        $hashedInputPassword = \App\Support\MySQLPassword::hash($request->current_password);
    
        if ($hashedInputPassword !== strtoupper($user->password)) {
            throw ValidationException::withMessages([
                'current_password' => __('messages.error_current_password'),
            ]);
        }
    
        // 🔹 5. Aplicăm același hashing SHA1(SHA1(new_password)) și adăugăm "*"
        $newHashedPassword = \App\Support\MySQLPassword::hash($request->new_password);
    
        // 🔹 6. Schimbăm parola în baza de date
        \DB::connection('account')->table('account')
            ->where('id', $user->id)
            ->update([
                'password' => $newHashedPassword,
            ]);
    
        // 🔹 7. Logăm schimbarea pentru securitate
        \Log::info("Password successfully changed for user ID: {$user->id}");
    
        return back()->with('success', __('messages.password_updated'));
    }
      
}
