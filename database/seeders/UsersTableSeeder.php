<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Admin\SystemRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Cas',
            'last_name' => 'Rovers',
            'email' => 'cas@wux.nl',
            'is_active' => true
        ])->assignRole(SystemRoles::SUPER_ADMIN->value);

        // User::factory(10)->create();
    }
}
