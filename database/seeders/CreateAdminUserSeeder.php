<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'updated_at' => now(),
        ]);

        $role = Role::create(['name' => 'Admins']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        // User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'updated_at' => now(),
        ]);

        $role = Role::create(['name' => 'Users']);
        $permissions = Permission::pluck('id','id')->range(1,2);
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
