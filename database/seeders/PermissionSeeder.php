<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view students',
            'edit students',
            'delete students',
            'view results',
            'edit results',
            'allocate subjects',
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        $teacher = Role::where('name', 'teacher')->first();
        $accountant = Role::where('name', 'accountant')->first();
        $admin = Role::where('name', 'admin')->first();

        $teacher->givePermissionTo(['view students', 'view results']);
        $accountant->givePermissionTo(['view results']);
        $admin->givePermissionTo(Permission::all());
    }
}
