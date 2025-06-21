<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuditLogResource\Pages;
use App\Models\AuditLog;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables\Columns\TextColumn;

class AuditLogResource extends Resource
{
    protected static ?string $model = AuditLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationGroup = 'Logs';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('username')->label('User')->sortable(),
                TextColumn::make('action')->sortable()->searchable(),
                TextColumn::make('ip_address')->label('IP'),
                TextColumn::make('browser')->toggleable(),
                TextColumn::make('platform')->toggleable(),
                TextColumn::make('location')->toggleable(),
                TextColumn::make('session_id')->toggleable(),
                TextColumn::make('details')->limit(50)->wrap()->toggleable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->actions([])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAuditLogs::route('/'),
        ];
    }

    public static function canViewAny(): bool
    {
        return true;
    }
}
