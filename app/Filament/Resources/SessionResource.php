<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SessionResource\Pages;
use App\Models\Session;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SessionResource extends Resource
{
    protected static ?string $model = Session::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Session ID')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => substr($state, 0, 10) . '...') // Scurtează ID-ul
                    ->tooltip(fn ($state) => $state), // Afișează ID-ul complet la hover

                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->default(fn ($record) => $record->user_id ? $record->user->name : 'Guest'),

                TextColumn::make('ip_address')->label('IP Address'),

                TextColumn::make('user_agent')
                    ->label('Browser')
                    ->formatStateUsing(fn ($state) => match (true) {
                        str_contains($state, 'Chrome') && !str_contains($state, 'Edg') => 'Google Chrome',
                        str_contains($state, 'Firefox') => 'Mozilla Firefox',
                        str_contains($state, 'Safari') && !str_contains($state, 'Chrome') => 'Safari',
                        str_contains($state, 'Edg') => 'Microsoft Edge',
                        str_contains($state, 'Opera') || str_contains($state, 'OPR') => 'Opera',
                        str_contains($state, 'MSIE') || str_contains($state, 'Trident') => 'Internet Explorer',
                        default => 'Unknown',
                    })
                    ->tooltip(fn ($state) => $state) // Tooltip pentru a vedea user-agent complet
                    ->sortable(),

                TextColumn::make('last_activity')
                    ->label('Last Active')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => Carbon::createFromTimestamp($state)->diffForHumans()),
            ])
            ->defaultSort('last_activity', 'desc') // ✅ Cele mai recente sesiuni apar primele
            ->actions([
                DeleteAction::make()
                    ->label('Delete Session')
                    ->icon('heroicon-o-trash')
                    ->action(fn ($record) => DB::table('sessions')->where('id', $record->id)->delete())
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Delete Selected Sessions')
                    ->action(fn ($records) => DB::table('sessions')->whereIn('id', $records->pluck('id'))->delete())
                    ->requiresConfirmation(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSessions::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true;
    }
}
