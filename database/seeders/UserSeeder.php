<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder {
    /**
    * Run the database seeds.
    */

    public function run(): void {
        //
        // Usuario con rol de administrador
        User::create( [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make( 'password' ), // Cambia la contraseña según prefieras
            'role' => 'administrador',
            'credits' => 100,
            'credit_vto' => now()->addDays( 30 ),
        ] );

        // Usuario con rol de socio
        User::create( [
            'name' => 'socio',
            'email' => 'socio@example.com',
            'password' => Hash::make( 'password' ),
            'role' => 'socio',
            'credits' => 8,
            'credit_vto' => now()->addDays( 30 ),
        ] );

        // Usuario con rol de profesor
        User::create( [
            'name' => 'profesor',
            'email' => 'profesor@example.com',
            'password' => Hash::make( 'password' ),
            'role' => 'profesor',
            'credits' => 0,
            'credit_vto' => now()->addDays( 30 ),
        ] );

        // Usuario con rol de profesor
        User::create( [
            'name' => 'profesor1',
            'email' => 'profesor1@example.com',
            'password' => Hash::make( 'password' ),
            'role' => 'profesor',
            'credits' => 0,
            'credit_vto' => now()->addDays( 30 ),
        ] );

        // Crear 10 usuarios con el rol de socio
        User::factory()->count( 10 )->create( [
            'role' => 'socio',
        ] );
    }
}
