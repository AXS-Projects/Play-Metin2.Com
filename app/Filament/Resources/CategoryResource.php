<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Section;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Shop Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Section::make('Category Details')->schema([
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->placeholder('Enter category name'),
                
                TextInput::make('slug')
                    ->disabled() // Slug-ul se generează automat
                    ->unique(),

                TextInput::make('icon')
                    ->placeholder('Ex: ⚔️ 🛡️ 💍 ⚡'),
            ])
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('slug')->sortable(),
            TextColumn::make('icon')->label('Icon')->sortable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
