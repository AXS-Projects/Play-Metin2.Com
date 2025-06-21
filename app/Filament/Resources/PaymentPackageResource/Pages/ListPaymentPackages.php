<?php

namespace App\Filament\Resources\PaymentPackageResource\Pages;

use App\Filament\Resources\PaymentPackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentPackages extends ListRecords
{
    protected static string $resource = PaymentPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
