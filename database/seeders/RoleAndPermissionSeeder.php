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
        
        Permission::create(['name' => 'user boshqarish']);
        Permission::create(['name' => 'active']);
        Permission::create(['name' => 'passive']);
        
        //    Rollar yaratish va ularga ruxsatlarni biriktirish
        $adminRole = Role::create(['name' => 'admin']);
        $userrole = Role::create(['name' => 'user']);
        $userrole->givePermissionTo(['active']);
        $adminRole->givePermissionTo(['user boshqarish']);
  
    }
}
