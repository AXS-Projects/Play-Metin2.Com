<?php

namespace App\Filament\Resources\DownloadDescriptionResource\Pages;

use App\Filament\Resources\DownloadDescriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Awcodes\FilamentTiptapEditor\TiptapEditor;

class ListDownloadDescriptions extends ListRecords
{
    protected static string $resource = DownloadDescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
