<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class AccountObserver
{
    public function updated(Account $account): void
    {
        $changes = [];
        if ($account->isDirty('coins')) {
            $changes[] = 'coins: '.$account->getOriginal('coins').' -> '.$account->coins;
        }
        if ($account->isDirty('jcoins')) {
            $changes[] = 'jcoins: '.$account->getOriginal('jcoins').' -> '.$account->jcoins;
        }
        if ($account->isDirty('ban_until') || $account->isDirty('ban_reason') || $account->isDirty('status')) {
            $changes[] = 'ban fields updated';
        }

        if (! empty($changes)) {
            $request = request();
            $agent = new Agent();
            $agent->setUserAgent($request->userAgent());
            $position = Location::get($request->ip());
            $location = $position ? ($position->cityName . ', ' . $position->countryName) : null;
            AuditLog::create([
                'user_id' => Auth::id(),
                'username' => Auth::user()?->login,
                'action' => 'account_update',
                'details' => 'Account '.$account->id.' updated: '.implode('; ', $changes),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
                'browser' => $agent->browser(),
                'platform' => $agent->platform(),
                'location' => $location,
            ]);
        }
    }
}
