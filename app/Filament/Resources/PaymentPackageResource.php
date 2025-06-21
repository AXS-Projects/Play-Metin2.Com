<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentPackageResource\Pages;
use App\Models\PaymentPackage;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentPackageResource extends Resource
{
    protected static ?string $model = PaymentPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Shop Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Package Details')->schema([
                TextInput::make('name')->required(),
                TextInput::make('coins')->numeric()->required(),
                TextInput::make('price')->numeric()->required(),
                TextInput::make('currency')->default('EUR')->maxLength(3),
                TextInput::make('stripe_price_id')->label('Stripe Price ID'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('coins')->sortable(),
            TextColumn::make('price')->sortable(),
            TextColumn::make('currency'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentPackages::route('/'),
            'create' => Pages\CreatePaymentPackage::route('/create'),
            'edit' => Pages\EditPaymentPackage::route('/{record}/edit'),
        ];
    }
}
