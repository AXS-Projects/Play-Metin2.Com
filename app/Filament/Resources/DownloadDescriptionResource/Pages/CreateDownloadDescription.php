<?php

namespace App\Filament\Resources\DownloadDescriptionResource\Pages;

use App\Filament\Resources\DownloadDescriptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Awcodes\FilamentTiptapEditor\TiptapEditor;

class CreateDownloadDescription extends CreateRecord
{
    protected static string $resource = DownloadDescriptionResource::class;
}
