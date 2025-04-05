<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Metin2 Management';
    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('login')->label('Username')->sortable()->searchable(),
                TextColumn::make('email')->label('Email')->sortable()->searchable(),
                TextColumn::make('coins')->label('Coins')->sortable(),
				TextColumn::make('jcoins')->label('JCoins')->sortable(),
                TextColumn::make('status')->label('Status')->sortable(),
                TextColumn::make('register_ip')->label('Register IP')->sortable(),
                TextColumn::make('create_time')->label('Created at')->sortable(),
            ])
            ->defaultSort('create_time', 'desc') // ✅ Cele mai recente conturi primele
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('login')
                    ->label('Username')
                    ->disabled(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                Forms\Components\TextInput::make('coins')
                    ->label('Coins')
                    ->disabled(),
					
				Forms\Components\TextInput::make('jcoins')
                    ->label('JCoins')
                    ->disabled(),

				Forms\Components\TextInput::make('hwid')
                    ->label('Hardware ID')
                    ->disabled(),
					
				Forms\Components\TextInput::make('social_id')
                    ->label('Social ID')
                    ->disabled(),
			
                Forms\Components\Select::make('web_admin')
                    ->label('Admin Level')
                    ->disabled(),

                Forms\Components\TextInput::make('register_ip')
                    ->label('Register IP')
                    ->disabled(),

                Forms\Components\DateTimePicker::make('ban_until')
                    ->label('Ban Until'),
					
				Forms\Components\TextInput::make('ban_reason')
                    ->label('Reason For Ban'),
					
				Forms\Components\TextInput::make('create_time')
                    ->label('Account created at')
                    ->disabled(),

				Forms\Components\Select::make('status')
					->label('Status')
					->options([
						'OK' => 'OK',
						'inactive' => 'Inactive',
						'banned' => 'Banned',
						'permanent_banned' => 'Permanent Banned',
						'just_registered' => 'Just Registered',
					])
					->required(),

				Forms\Components\DateTimePicker::make('gold_expire')
                    ->label('Gold Expire'),
					
				Forms\Components\DateTimePicker::make('silver_expire')
                    ->label('Silver Expire'),
				
				Forms\Components\DateTimePicker::make('safebox_expire')
                    ->label('Safebox Expire'),

				Forms\Components\DateTimePicker::make('autoloot_expire')
                    ->label('Auto Loot Expire'),
				
				Forms\Components\DateTimePicker::make('fish_mind_expire')
                    ->label('Fish Mind Expire'),
					
				Forms\Components\DateTimePicker::make('marriage_fast_expire')
                    ->label('Marriage Fast Expire'),
					
				Forms\Components\DateTimePicker::make('money_drop_rate_expire')
                    ->label('Money Drop Rate Expire'),
					
				Forms\Components\DateTimePicker::make('last_play')
                    ->label('Last time Played')
					->disabled(),
					
				Forms\Components\TextInput::make('language')
                    ->label('Account Language')
                    ->disabled(),
					
				Forms\Components\TextInput::make('reffer')
                    ->label('Reffered by')
					->disabled(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['admin', 'moderator']);
    }
}
