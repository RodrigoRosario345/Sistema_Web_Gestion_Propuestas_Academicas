<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etiqueta;

class EtiquetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Etiqueta::create([
            'nombre' => 'Sistema de Ventas', 
            'tipo' => 'Temática'
        ]);
        Etiqueta::create([
            'nombre' => 'Sistema de Control', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Infraestructura de Servidores',
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Cortometraje 2D', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Información', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Proyectos', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Personal', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Almacén', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Ventas', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de Gestión de Inventario', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Deteccion de plantas con IA', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema en tiempo real de riego automatico', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Sistema de control de acceso', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Deteccion de facturas escritas a mano con IA-OCR', 
            'tipo' => 'Temática'
        ]);

        Etiqueta::create([
            'nombre' => 'Deteccion de placas vehiculares con visión artificial',
            'tipo' => 'Temática'
        ]);

        

    }
}
