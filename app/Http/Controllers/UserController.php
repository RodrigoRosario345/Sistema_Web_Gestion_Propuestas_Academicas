<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return $usuarios;
    }

    public function show($id)
    {
        $roles = Role::all();
        $usuario = User::findOrFail($id);
        $usuarioRoles = $usuario->getRoleNames(); 
        return response()->json(['usuario' => $usuario, 'roles' => $roles, 'usuarioRoles' => $usuarioRoles]);
    }

    public function store(Request $request)
    {
        $usuario = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
    
        $usuario->assignRole($request->input('roles'));
        return redirect()->route('users');
    }
    

    public function update(Request $request, string $id)
    {
        $request->validate([
            'roles' => 'nullable|array|size:1', // Ahora 'roles' puede ser nulo
            'roles.*' => 'exists:roles,id', 
        ]);
        $usuario = User::findOrFail($id);
        if ($request->has('roles')) {
            $usuario->roles()->sync($request->roles);
        } else {
            $usuario->roles()->detach(); // Si no se proporcionan roles, se eliminan todos los roles del usuario
        }
        $password = $request->get('password');
        if(empty($password)){
            $request['password'] = $usuario->password;
        }
        $usuario->update($request->all());
        return redirect()->route('users');
    }

    public function destroy($id)
    {
        $etiqueta = User::findOrFail($id);
        $etiqueta->delete();
        return redirect()->route('users');
    }

    public function tutores()
    {
        $tutores = User::role('Tutor')->get();
        return response()->json($tutores);
    }

    public function estudiantes()
    {
        // $estudiantes = User::role('Estudiante')->get();
        // return response()->json($estudiantes);
        
        $asesor_id = Auth::user()->id;
        $usuarios = User::role('Estudiante')->get();
        $estudiantes = Estudiante::where('asesor_id', $asesor_id)->get();
    
        $usuarios_filtrados = $usuarios->filter(function($usuario) use ($estudiantes) {
            return $estudiantes->contains('user_id', $usuario->id); //
        });
    
        // Retorna los datos filtrados como JSON
        return response()->json($usuarios_filtrados);
    }

    public function mostrarPerfil(string $id)
    {
        $usuario = User::findOrFail($id);
        return view('perfil', compact('usuario'));
    }
    
    public function actualizarPerfil(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
    
        $usuario = User::findOrFail($id);
    
        $usuario->username = $request->input('username');
        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->input('password'));
        }
    
        $usuario->save();
    
        return redirect()->route('perfil', ['id' => $usuario->id]);
    }
    
}
