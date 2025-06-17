<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

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
            AuditLog::create([
                'user_id' => Auth::id(),
                'action' => 'account_update',
                'details' => 'Account '.$account->id.' updated: '.implode('; ', $changes),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }
    }
}
