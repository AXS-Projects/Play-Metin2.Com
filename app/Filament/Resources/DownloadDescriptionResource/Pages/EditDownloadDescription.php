<?php

namespace App\Filament\Resources\DownloadDescriptionResource\Pages;

use App\Filament\Resources\DownloadDescriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Awcodes\FilamentTiptapEditor\TiptapEditor;

class EditDownloadDescription extends EditRecord
{
    protected static string $resource = DownloadDescriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
