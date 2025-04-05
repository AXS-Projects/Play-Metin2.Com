<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function beforeSave(): void
    {
        // Hash password
        if (!empty($this->data['password'])) {
            $this->record->password = Hash::make($this->data['password']);
        }

        // Set role
        if (isset($this->data['role'])) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}
