<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\PermissionSeeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
                User::firstOrCreate([

            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
        RoleSeeder::class,
        PermissionSeeder::class,
        // you can add other seeders here
    ]);
    }
}
