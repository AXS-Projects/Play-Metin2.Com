<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function beforeSave(): void
    {
        // Hash password only if it's set
        if (!empty($this->data['password'])) {
            $this->record->password = Hash::make($this->data['password']);
        }

        // Update role
        if (isset($this->data['role'])) {
            $this->record->syncRoles([$this->data['role']]);
        }
    }
}
