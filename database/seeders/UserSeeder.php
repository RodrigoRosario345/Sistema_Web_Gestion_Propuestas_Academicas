<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Docente;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Rodrigo Rosario',
            'username' => 'Rodrigo123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        Docente::create([
            'user_id' => 1,
            'celular' => '77777777',
            'direccion' => 'Av. America',
            'ci' => '1234567',
            'especialidad' => 'Ingenieria de computacion',
        ]);

        User::create([
            'name' => 'Juan Perez',
            'username' => 'Juan123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Asesor');

        Docente::create([
            'user_id' => 2,
            'celular' => '83743777',
            'direccion' => 'Av. America',
            'ci' => '1234568',
            'especialidad' => 'Ingenieria de computacion',
        ]);

        User::create([
            'name' => 'Maria Perez',
            'username' => 'Maria123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Asesor');

        Docente::create([
            'user_id' => 3,
            'celular' => '83743778',
            'direccion' => 'Av. Miraflores',
            'ci' => '1234569',
            'especialidad' => 'Ingenieria de Sistemas',
        ]);

        User::create([
            'name' => 'Ing. Angel Hilmar Baspineiro Valverde',
            'username' => 'Angel123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 4,
            'celular' => '83743779',
            'direccion' => 'Av. Heroínas',
            'ci' => '1234570',
            'especialidad' => 'Ingenieria de Diseño',
        ]);

        User::create([
            'name' => 'Ing. Belianskaya Viktoria Viktorovna',
            'username' => 'Belianskaya123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 5,
            'celular' => '83743780',
            'direccion' => 'Av. Hernando Siles',
            'ci' => '1234571',
            'especialidad' => 'Ingenieria de Telecomunicaciones',
        ]);

        User::create([
            'name' => 'Ing. Carlos David Montellano Barriga',
            'username' => 'Carlos123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 6,
            'celular' => '83743781',
            'direccion' => 'Av. America',
            'ci' => '1234572',
            'especialidad' => 'Ingenieria de Sistemas',
        ]);

        User::create([
            'name' => 'Ing. Oswaldo Gerardo Velasquez Aroni',
            'username' => 'Oswaldo123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 7,
            'celular' => '83743782',
            'direccion' => 'Av. Juan Pablo II',
            'ci' => '1234573',
            'especialidad' => 'Ingenieria de Sistemas',
        ]);

        User::create([
            'name' => 'Ing. Pedro Camargo Vargas',
            'username' => 'Pedro123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 8,
            'celular' => '83743783',
            'direccion' => 'Av. America',
            'ci' => '1234574',
            'especialidad' => 'Ingenieria de Sistemas',
        ]);

        User::create([
            'name' => 'Ing. Raul Antonio Paredes Paredes',
            'username' => 'Raul123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Tutor');

        Docente::create([
            'user_id' => 9,
            'celular' => '83743784',
            'direccion' => 'Av. America',
            'ci' => '1234575',
            'especialidad' => 'Ingenieria de Sistemas',
        ]);

        User::create([
            'name' => 'Ricardo Flores',
            'username' => 'Ricardo123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 10,
            'celular' => '77777777',
            'curso' => '10', 
            'asesor_id' => 2,
        ]);

        User::create([
            'name' => 'Rosa Maria Flores',
            'username' => 'Rosa123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 11,
            'celular' => '77777778',
            'curso' => '10',
            'asesor_id' => 2,
        ]);

        User::create([
            'name' => 'Sandra Perez',
            'username' => 'Sandra123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 12,
            'celular' => '77777779',
            'curso' => '10',
            'asesor_id' => 2,
        ]);

        User::create([
            'name' => 'Rodrigo Rosario Cruz',
            'username' => 'cruz123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 13,
            'celular' => '7472347',
            'curso' => '10',
            'asesor_id' => 2,
        ]);

        User::create([
            'name' => 'Andre Basilio Rodrigo Walter',
            'username' => 'andre123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 14,
            'celular' => '7472347',
            'curso' => '10',
            'asesor_id' => 2,
        ]);

        User::create([
            'name' => 'Campos Romero Adriana Jasiel',
            'username' => 'campos123',
            'password' => bcrypt('12345678'),
        ])->assignRole('Estudiante');

        Estudiante::create([
            'user_id' => 15,
            'celular' => '7472347',
            'curso' => '10',
            'asesor_id' => 2,
        ]);
    }
}
