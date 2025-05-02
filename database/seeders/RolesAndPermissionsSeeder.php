<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Admin\SystemPermissions;
use App\Enums\Admin\SystemRoles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SystemPermissions::values() as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        foreach (SystemRoles::values() as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web'
            ]);
        }

        foreach (SystemRoles::cases() as $roleEnum) {
            $role = Role::where('name', $roleEnum->value)->first();

            match ($roleEnum) {

                SystemRoles::SUPER_ADMIN => null,

                SystemRoles::ADMIN => $role->syncPermissions([
                    SystemPermissions::VIEW_USERS->value,
                    SystemPermissions::CREATE_USERS->value,
                    SystemPermissions::EDIT_USERS->value,
                ]),

                SystemRoles::USER => $role->syncPermissions([
                    SystemPermissions::VIEW_USERS->value,
                ]),
            };
        }
    }
}
