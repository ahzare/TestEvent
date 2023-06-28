<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Admin::query()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
        ]);

        $superAdminRole = Role::findOrCreate(Admin::SUPER_ADMIN_ROLE);

        $permissions = Permission::query()->pluck('name', 'name')->all();
        $superAdminRole->givePermissionTo($permissions);
        $superAdmin->assignRole('Super Admin');
    }
}
