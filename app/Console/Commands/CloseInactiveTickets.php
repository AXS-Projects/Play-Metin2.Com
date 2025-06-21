<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ticket;

class CloseInactiveTickets extends Command
{
    protected $signature = 'tickets:close-inactive';

    protected $description = 'Close tickets with no activity for a week';

    public function handle(): int
    {
        $cutoff = now()->subWeek();

        $tickets = Ticket::where('status', 'open')
            ->whereDoesntHave('messages', function ($query) use ($cutoff) {
                $query->where('created_at', '>=', $cutoff);
            })
            ->get();

        foreach ($tickets as $ticket) {
            $ticket->update(['status' => 'closed']);
            $this->info("Closed ticket ID {$ticket->id}");
        }

        return self::SUCCESS;
    }
}
