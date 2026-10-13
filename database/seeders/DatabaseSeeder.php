<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Evento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Global',
            'email' => 'admin@eventhub.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $organizadorA = User::create([
            'name' => 'Organizador A',
            'email' => 'organizadorA@eventhub.com',
            'password' => bcrypt('password'),
            'role' => 'organizador',
        ]);

        User::create([
            'name' => 'Organizador B',
            'email' => 'organizadorB@eventhub.com',
            'password' => bcrypt('password'),
            'role' => 'organizador',
        ]);

        User::create([
            'name' => 'Asistente Juan',
            'email' => 'asistente@eventhub.com',
            'password' => bcrypt('password'),
            'role' => 'asistente',
        ]);

        Evento::create([
            'user_id' => $organizadorA->id,
            'titulo' => 'Conferencia de Inteligencia Artificial',
            'descripcion' => 'Evento sobre innovaciones en IA y Backend.',
            'cupo_maximo' => 100,
        ]);
    }
}