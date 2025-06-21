<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Mail\AccountActivationMail;
use Illuminate\Support\Str;
use Anhskohbo\NoCaptcha\NoCaptcha;
use App\Models\Setting;
use App\Models\AuditLog;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register', [
            'title' => 'Register', // Titlul pentru pagina de înregistrare
            'refferEnabled' => Setting::isEnabled('reffer_enabled', false),
        ]);
    }

    public function register(Request $request)
    {
        // Lista domeniilor permise (fixe)
        $allowedDomains = ['icloud.com', 'gmail.com'];

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:30|unique:account.account,login',
            'real_name' => 'required|string|max:255',
            'age' => 'required|integer|min:13',
            'reffer' => Setting::isEnabled('reffer_enabled', false) ? 'nullable|string|max:255' : 'sometimes|nullable',
            'email' => [
                'required',
                'email',
                'max:255',
                'confirmed',
                function ($attribute, $value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);

                    // Verificăm dacă domeniul este icloud.com sau gmail.com
                    if (in_array($domain, $allowedDomains)) {
                        return;
                    }

                    // Verificăm dacă domeniul începe cu "yahoo."
                    if (preg_match('/^yahoo\./', $domain)) {
                        return;
                    }

                    // Dacă domeniul nu este permis, returnăm eroare
                    $fail(__('messages.email_not_allowed'));
                }
            ],
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'accepted',
			'g-recaptcha-response' => 'required|captcha'

        ]);

        if ($validator->fails()) {
            return redirect()->route('register.form')
                             ->withErrors($validator)
                             ->withInput()
                             ->with('error', __('messages.register_error'));
        }

        // Verificăm dacă activarea prin email este necesară
        $requireEmailVerification = config('auth.require_email_verification');

        // Dacă activarea prin email este necesară, generăm un token
        $activation_token = $requireEmailVerification ? Str::random(64) : null;

        try {
            // Setăm statusul contului
            $accountStatus = $requireEmailVerification ? 'PENDING' : 'OK';

            // Inserare cont folosind hashing compatibil Metin2
            $hashedPassword = \App\Support\MySQLPassword::hash($request->password);

            $accountId = DB::connection('account')->table('account')->insertGetId([
                'login' => $request->username,
                'password' => $hashedPassword,
                'email' => $request->email,
                'status' => $accountStatus,
                'created_at' => now(),
                'updated_at' => now(),
                'create_time' => now(),
                'activation_token' => $activation_token,
                'reffer' => Setting::isEnabled('reffer_enabled', false) ? $request->reffer : null,
            ]);

            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());
            $position = Location::get($request->ip());
            $location = $position ? ($position->city . ', ' . $position->countryName) : null;
            AuditLog::create([
                'user_id' => $accountId,
                'username' => $request->username,
                'action' => 'register',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'location' => $location,
            ]);

            // Dacă activarea prin email este necesară, trimitem email-ul
            if ($requireEmailVerification) {
                $activation_link = route('account.activate', [
                    'lang' => app()->getLocale(),
                    'token' => $activation_token,
                ]);

                Mail::to($request->email)->send(new AccountActivationMail($request->username, $activation_link));

                return redirect()->route('register.form')->with('success', __('messages.register_success_email'));
            }

            // Dacă nu este necesară activarea prin email, contul este deja activ
            return redirect()->route('register.form')->with('success', __('messages.register_success_no_email'));

        } catch (\Exception $e) {
            return redirect()->route('register.form')->with('error', __('messages.register_error'));
        }
    }
}
