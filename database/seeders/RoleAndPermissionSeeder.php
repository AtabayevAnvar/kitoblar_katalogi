<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ruxsatlar yaratish
        Permission::create(['name' => 'tasdiqlovchi']);
        Permission::create(['name' => 'user boshqarish']);
        

        // Rollar yaratish va ularga ruxsatlarni biriktirish
        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo(['user boshqarish']);


        $user = User::where('email', 'admin@example.com')->first();
        $user->assignRole('admin'); // Admin rolini biriktirish


        
    }
}
