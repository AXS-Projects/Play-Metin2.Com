<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\Models\Metin2User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password', [
            'title' => __('messages.forgot_password_title'),
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = Metin2User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => __('messages.password_reset_link_invalid')]);
        }

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetLink = route('password.reset.form', ['token' => $token, 'email' => $user->email]);
        $cancelLink = route('password.reset.cancel', ['token' => $token, 'email' => $user->email]);

        Mail::to($user->email)->send(new PasswordResetMail($user->login, $resetLink, $cancelLink));

        return back()->with('status', __('messages.password_reset_link_sent'));
    }

    public function showResetForm(string $token)
    {
        return view('auth.reset-password', [
            'title' => __('messages.reset_password_title'),
            'token' => $token,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => __('messages.password_reset_link_invalid')]);
        }

        $hashedPassword = \App\Support\MySQLPassword::hash($request->password);
        DB::connection('account')->table('account')->where('email', $request->email)->update(['password' => $hashedPassword]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('index')->with('success', __('messages.password_reset_success'));
    }

    public function cancel(Request $request, string $token)
    {
        $email = $request->query('email');
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($record && Hash::check($token, $record->token)) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
        }

        return redirect('/')->with('status', __('messages.cancel_reset'));
    }
}
