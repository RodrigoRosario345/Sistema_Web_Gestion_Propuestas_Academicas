<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::with('user')->get();
        return view('estudiantes', [
            'estudiantes' => $estudiantes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estudiantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $asesor = Auth::user()->id;
        // Crear el usuario
        $user = User::create([
            'name' => $input['nombre'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ])->assignRole('Estudiante');

        // Crear el estudiante y asociarlo con el usuario
        $estudiante = Estudiante::create([
            'user_id' => $user->id,
            'nombre' => $input['nombre'],
            'celular' => $input['celular'],
            'curso' => $input['curso'],
            'asesor_id' => $asesor
        ]);

        $messages = [
            'password.min' => 'La contraseña debe tener al menos 8 carácteres.'
        ];

        $request->validate([
            'password' => 'required|min:8',
        ], $messages);

        
        return redirect()->route('estudiantes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        
        $estudiante->load('user');
        return view('estudiantes.show', [
            'estudiante' => $estudiante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        $estudiante->load('user');
        return view('estudiantes.edit', [
            'estudiante' => $estudiante
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $input = $request->all();

        // Actualizar el usuario
        $estudiante->user->update([
            'name' => $input['nombre'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ]);

        // Actualizar el estudiante
        $estudiante->update($input);

        return redirect()->route('estudiantes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->user->delete(); // Eliminar el usuario relacionado
        $estudiante->delete();

        return redirect()->route('estudiantes.index');
    }

    public function import(Request $request)
    {
        $asesor = Auth::user()->id;
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        $path = $request->file('file')->store('temp');
        $path = storage_path('app/' . $path);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();

        $cursoCell = $worksheet->getCell('D7')->getValue();
        preg_match('/\d+/', $cursoCell, $matches);
        $curso = $matches[0] ?? null;

        for ($row = 10; $row <= $highestRow; ++$row) {
            $nombreCompleto = $worksheet->getCell('B' . $row)->getValue();
            preg_match('/\((.*?)\)/', $nombreCompleto, $matches);
            $celular = $matches[1] ?? null;
            $nombreSinCelular = trim(str_replace("($celular)", '', $nombreCompleto));
            $nombreSinCelular = mb_convert_encoding($nombreSinCelular, 'UTF-8', 'UTF-8');
            $nombres = explode(' ', $nombreSinCelular);
            $username = $nombres[0] . $nombres[count($nombres) - 1];

            try {
                $user = User::create([
                    'name' => $nombreSinCelular,
                    'username' => $username,
                    'password' => Hash::make($celular),
                ])->assignRole('Estudiante');

                Estudiante::create([
                    'user_id' => $user->id,
                    'nombre' => $nombreSinCelular,
                    'username' => $username,
                    'password' => Hash::make($celular),
                    'celular' => $celular,
                    'curso' => $curso,
                    'asesor_id' => $asesor
                ]);
            } catch (\Exception $e) {
                Log::error("Error al insertar estudiante: " . $e->getMessage());
                continue;
            }
        }

        unlink($path);
        return redirect()->route('estudiantes.index');
    }
}
