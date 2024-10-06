<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Crear el rol de super_admin si no existe
        $role = Role::firstOrCreate(['name' => 'super_admin']);
        
        // Crear el usuario
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@arfe.com', // Cambia el email por el que prefieras
            'password' => bcrypt('password'),    // Cambia la contraseña
        ]);

        // Asignar el rol de super_admin al usuario
        $user->assignRole($role);
    }
}
