<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el rol Super Admin si no existe
        $role = Role::firstOrCreate(['name' => 'super_admin']);

        // Asignar todos los permisos al rol super_admin
        $permissions = Permission::all(); // Obtén todos los permisos
        $role->syncPermissions($permissions);

        // Crear un usuario Super Admin
        $user = User::firstOrCreate([
            'email' => 'superadmin@arfe-lab.com',
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('password123'), // Cambia a tu contraseña
        ]);

        // Asignar el rol al usuario
        $user->assignRole($role);
    }
}
