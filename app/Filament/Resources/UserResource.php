<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Admin Management';
    protected static ?int $navigationSort = 1;

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				TextInput::make('name')
					->label('Name')
					->required()
					->maxLength(255),

				TextInput::make('email')
					->label('Email')
					->required()
					->email()
					->unique(ignoreRecord: true),

				TextInput::make('password')
					->label('Password')
					->password()
					->dehydrated(fn($state) => !empty($state)) // Salvează doar dacă e setată
					->required(fn($record) => !$record) // Obligatoriu doar la creare
					->hiddenOn('edit'),

				Select::make('role')
					->label('Role')
					->options(Role::pluck('name', 'name')) // Preia rolurile din DB
					->required()
					->default('user'),

				DateTimePicker::make('created_at')
					->label('Created At')
					->disabled(),
			]);
	}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('roles.name') // Afișează rolul corect
                    ->label('Role')
                    ->sortable(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
	
	public static function getNavigationBadge(): ?string
	{
		return static::getModel()::count();
	}
}
