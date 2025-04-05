<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crearea permisiunilor
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage server']);
        Permission::create(['name' => 'view analytics']);

        // Crearea rolurilor
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $playerRole = Role::create(['name' => 'player']);

        // Atribuirea permisiunilor rolurilor
        $adminRole->givePermissionTo(['manage users', 'manage server', 'view analytics']);
        $moderatorRole->givePermissionTo(['manage server']);
        $playerRole->givePermissionTo(['view analytics']);

        // Crearea unui utilizator admin și atribuirea rolului
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@metin2.com',
        ]);
        $adminUser->assignRole('admin');

        // Crearea unui utilizator moderator
        $moderatorUser = User::factory()->create([
            'name' => 'Moderator User',
            'email' => 'moderator@metin2.com',
        ]);
        $moderatorUser->assignRole('moderator');

        // Crearea unui utilizator player
        $playerUser = User::factory()->create([
            'name' => 'Player User',
            'email' => 'player@metin2.com',
        ]);
        $playerUser->assignRole('player');
    }
}
