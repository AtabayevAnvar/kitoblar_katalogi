<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin1234'),
        ]);

        

        $role = Role::firstOrCreate(['name' => 'user boshqarish']); // Agar 'user boshqarish' roli mavjud bo'lmasa, uni yaratadi
        $admin->assignRole($role);

        $this->call([RoleAndPermissionSeeder::class]);
    }
}
