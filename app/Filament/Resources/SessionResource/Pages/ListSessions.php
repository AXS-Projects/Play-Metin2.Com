<?php

namespace App\Filament\Resources\SessionResource\Pages;

use App\Filament\Resources\SessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListSessions extends ListRecords
{
    protected static string $resource = SessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Delete Expired Sessions')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->action(function () {
                    DB::table('sessions')->where('last_activity', '<', now()->subHours(2)->timestamp)->delete();
                }),
        ];
    }
}
