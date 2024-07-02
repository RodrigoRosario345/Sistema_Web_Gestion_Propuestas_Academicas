<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Docente;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::with('user')->get();
        return view('docente.index', [
            'docentes' => $docentes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('docente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Crear el usuario
        $user = User::create([
            'name' => $input['nombre'],
            'username' => $input['username'],
            'password' => Hash::make($input['password']),
        ])->assignRole($request->input('roles'));

        // Crear el docente y asociarlo con el usuario
        $docente = Docente::create([
            'user_id' => $user->id,
            'celular' => $input['celular'],
            'direccion' => $input['direccion'],
            'ci' => $input['ci'],
            'especialidad' => $input['especialidad'],
        ]);

        return redirect()->route('docentes.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        $docente->load('user');
        return view('docente.show', [
            'docente' => $docente
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        $docente->load('user');
        //role del docente


        return view('docente.edit', [
            'docente' => $docente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Docente $docente)
    {
        if(empty($request->get('password'))){
            $request['password'] = $docente->user->password;
        }

        if ($request->has('roles')) {
            $rolesIds = Role::whereIn('name', $request->input('roles'))->pluck('id');
            $docente->user->roles()->sync($rolesIds);
        } else {
            $docente->user->roles()->detach(); 
        }
    
        $docente->update($request->all());
    
        return redirect()->route('docentes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        $docente->user->delete(); // Eliminar el usuario relacionado
        $docente->delete();

        return redirect()->route('docentes.index');
    }
    
}
