<?php

namespace App\Filament\Resources\TicketResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;

class MessagesRelationManager extends RelationManager
{
    protected static string $relationship = 'messages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make('content')
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author')->searchable(),
                TextColumn::make('content')->limit(50)->html(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author'] = auth()->user()->name;

        return $data;
    }

    public function afterCreate(): void
    {
        $this->getOwnerRecord()->update(['status' => 'open']);
    }
}
