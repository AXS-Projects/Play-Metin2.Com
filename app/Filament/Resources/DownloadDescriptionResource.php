<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadDescriptionResource\Pages;
use App\Filament\Resources\DownloadDescriptionResource\RelationManagers;
use App\Models\DownloadDescription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use FilamentTiptapEditor\TiptapEditor;


class DownloadDescriptionResource extends Resource
{
    protected static ?string $model = DownloadDescription::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Downloads';

	public static function form(Form $form): Form
	{
		return $form
			->schema([
				Forms\Components\Select::make('language')
					->label('Language')
					->options([
						'en' => __('English'),
						'ro' => __('Română'),
						'fr' => __('Français'),
						'de' => __('Deutsch'),
					])
					->default('en')
					->required()
					->columnSpanFull(),

				TiptapEditor::make('description')
					->label(__('Download Page Description'))
					->profile('default')
					->columnSpanFull()
					->required(),
			]);
	}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('language')->label('Language')->sortable(),
                Tables\Columns\TextColumn::make('description')->html()->limit(500),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalWidth('7xl'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->limit(1)); // Permite doar o singură descriere
    }

    // 🔹 Nu permite adăugarea unei noi descrieri dacă există deja una
	public static function canCreate(): bool
	{
		// Verifică dacă există descriere pentru TOATE limbile (dacă ai doar 4 limbi și sunt toate adăugate, nu mai poți adăuga)
		return DownloadDescription::count() < count(['en', 'ro', 'fr', 'de']);
	}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDownloadDescriptions::route('/'), 
            'edit' => Pages\EditDownloadDescription::route('/{record}/edit'),
        ];
    }
}