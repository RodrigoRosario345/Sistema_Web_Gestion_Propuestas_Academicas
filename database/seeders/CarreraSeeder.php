<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrera;

class CarreraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carrera::create([
            'nombre' => 'Ing. en Ciencias de la Computación', 
            'nombre_completo' => 'Ingeniería en Ciencias de la Computación', 
            'sigla' => 'CIC',
            'logo' => 'logo_cic.jpg',
            'color' => 'yellow-tag'
        ]);

        Carrera::create([
            'nombre' => 'Ing. en Sistemas', 
            'nombre_completo' => 'Ingeniería en Sistemas', 
            'sigla' => 'SIS',
            'logo' => 'logo_sis.jpg',
            'color' => 'blue-tag'
        ]);

        Carrera::create([
            'nombre' => 'Ing. en T.I. y Seguridad', 
            'nombre_completo' => 'Ingeniería en Tecnologías de la Información y Seguridad', 
            'sigla' => 'TIC',
            'logo' => 'logo_tic.jpg',
            'color' => 'green-tag'
        ]);

        Carrera::create([
            'nombre' => 'Ing. en Telecomunicaciones', 
            'nombre_completo' => 'Ingeniería en Telecomunicaciones', 
            'sigla' => 'TEL',
            'logo' => 'logo_tel.jpg',
            'color' => 'lilac-tag'
        ]);

        Carrera::create([
            'nombre' => 'Ing. en Diseño y Animación', 
            'nombre_completo' => 'Ingeniería en Diseño y Animación', 
            'sigla' => 'DAD',
            'logo' => 'logo_dad.jpg',
            'color' => 'red-tag'
        ]);

    }
}
