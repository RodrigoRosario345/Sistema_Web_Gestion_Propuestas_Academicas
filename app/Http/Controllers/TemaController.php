<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Carrera;
use App\Models\Etiqueta;
use App\Models\TemaEtiqueta;
use App\Models\Objetivo;

use Illuminate\Http\Request;
use PDF;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Estudiante;



class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::orderByDesc('fecha', 'desc')->get();
        return $temas;
    }

    public function search(Request $request){
        $texto = $request->input('texto');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $carrera = $request->input('carrera');
        $etiquetas = $request->input('tags');
        $orden = $request->input('orden');
        $resultados = Tema::query();
        if (!empty($texto)) {
            $resultados->where('titulo', 'like', "%$texto%")
                        ->orWhere('tutor', 'like', "%$texto%");
        }
        if ($carrera != 'all') {
            $resultados->where('carrera_id', $carrera);
        }
        if (!empty($fecha_inicio)) {
            $resultados->whereDate('fecha', '>=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $resultados->whereDate('fecha', '<=', $fecha_fin);
        }
        if (!empty($etiquetas)) {
            $etiquetas = explode('-', $etiquetas);
            $resultados->whereHas('etiquetas', function ($query) use ($etiquetas) {
                $query->whereIn('etiquetas.id', $etiquetas);
            });
        }
        $temas = $resultados->with(['etiquetas', 'carrera'])->orderBy($orden, 'desc')->get();
        return response()->json($temas);
    }


    
    public function store(Request $request)
    {
        $carrera = Carrera::find($request->input('carrera_id'));
        $codigo = $this->getCode($carrera->id);
        $request['codigo'] = $codigo;

        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = "$codigo.pdf";
            $save_path = public_path('docs/');
            $file->move($save_path, $file_name);
            $request['documento'] = $file_name; 

            $image = $request->input('image');
            $image = base64_decode($image);
            $image_name = "$codigo.png";
            $image_save_path = public_path("images/previews/");
            file_put_contents($image_save_path.$image_name, $image);
            $request['preview_img'] = $image_name;
        } else {
            $request['documento'] = 'none';
            $request['preview_img'] = 'not_found.png';
        }

        $request['estudiante'] = $request->input('estudiante') == '' ? "Ninguno" : $request->input('estudiante');
        $request['asesor'] = $request->input('asesor') == '' ? "Ninguno" : $request->input('asesor');
        $request['estado'] = $request->input('estado') == '' ? "Ninguno" : $request->input('estado');
         
        $tema = Tema::create($request->all());


        $objetivos = explode("\n", $request->input('objetivos'));
        $tema->objetivos()->createMany(array_map(function($texto){
            return [
                'texto' => $texto
            ];
        }, $objetivos));

        $tematicas = $request->input('tematicas');
        $tematicas = explode('-', $tematicas);
        $tema->etiquetas()->attach($tematicas);

        if ($tema) {
            $exito = "registrado exitosamente!";
            return redirect()->route('form_temas')->with('exito', $exito);
        } else {
            $error = "Error al registrar el tema";
            return view('form_temas_titulacion', compact('error'));
        }
        
    }

    public function getCode($id) {
        $carrera = Carrera::find($id);
        $last_work = $carrera->temas()->orderBy('codigo', 'desc')->first();
        $sigla = $carrera->sigla;
        if ($last_work) {
            $last_code = $last_work->codigo;
            $number = explode('-', $last_code)[1];
            $number = str_pad((int)$number + 1, 5, '0', STR_PAD_LEFT);
            $code = "$sigla-$number";
        } else {
            $code = "$sigla-00001";
        }
        return $code;
    }

    public function show($id){
        $tema = Tema::with(['carrera','etiquetas', 'objetivos'])->find($id);
        return response()->json($tema);
    }

    public function edit($id)
    {
        $tema = Tema::find($id);
        $tematicas = $tema->etiquetas()->where('tipo', 'Temática')->get();

        return view('form_temas_titulacion', compact('tema', 'tematicas'));
    }


    public function update(Request $request, $id)
    {
        $tema = Tema::findOrFail($id);

        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = "$tema->codigo.pdf";
            $save_path = public_path('docs/');
            $file->move($save_path, $file_name);
            $request['documento'] = $file_name; 

            $image = $request->input('image');
            $image = base64_decode($image);
            $image_name = "$tema->codigo.png";
            $image_save_path = public_path("images/previews/");
            file_put_contents($image_save_path.$image_name, $image);
            $request['preview_img'] = $image_name;
        } else {
            $request['documento'] = $tema->documento;
            $request['preview_img'] = $tema->preview_img;
        }

        $tema->objetivos()->delete();

        $objetivos = explode("\n", $request->input('objetivos'));
        $tema->objetivos()->createMany(array_map(function($texto) {
            return ['texto' => $texto];
        }, $objetivos));
    
        $tema->etiquetas()->detach();

        $tematicas = $request->input('tematicas');
        $tematicas = explode('-', $tematicas);
        $tema->etiquetas()->attach($tematicas);


        $tema->update($request->all());

        if ($tema) {
            $exito = "actualizado exitosamente!";
            return redirect()->route('form_temas')->with('exito', $exito);
        } else {
            $error = "Error al actualizar el tema";
            return view('form_temas_titulacion', compact('error'));
        }
    }


    public function destroy($id)
    {
        $tema = Tema::findOrFail($id);
        if ($tema->documento != 'none'){
            unlink(public_path("docs/$tema->documento"));
            unlink(public_path("images/previews/$tema->preview_img"));
        }
        $tema->objetivos()->delete();
        $tema->etiquetas()->detach();
        $tema->delete();
        return redirect()->route('temas');
    }

    //asignar temas a estudiantes y asesores
    public function asigned_student_tem(Request $request, $id)
    {
        $tema = Tema::findOrFail($id);

        if($request->hasFile('file')){
            $file = $request->file('file');
            $file_name = "$tema->codigo.pdf";
            $save_path = public_path('docs/');
            $file->move($save_path, $file_name);
            $request['documento'] = $file_name; 

            $image = $request->input('image');
            $image = base64_decode($image);
            $image_name = "$tema->codigo.png";
            $image_save_path = public_path("images/previews/");
            file_put_contents($image_save_path.$image_name, $image);
            $request['preview_img'] = $image_name;
        } else {
            $request['documento'] = $tema->documento;
            $request['preview_img'] = $tema->preview_img;
        }


        $tema->update($request->all());
        return redirect()->route('temas');
    }

    //reportes
    public function reportes(){
        $asesor = Auth::user();
        // Obtener los estudiantes que tienen como asesor al usuario logeado

        $estudiantes = Estudiante::where('asesor_id', $asesor->id)->pluck('user_id')->toArray();
        $users = User::whereIn('id', $estudiantes)->get();
        $temas = Tema::whereIn('estudiante', $users->pluck('name'))->get();
        $temasAsig = Tema::where('estado', 'Asignado')->get();
        $temas_no_asignados = Tema::where('estudiante', 'Ninguno')->get();

        return view('reportes', compact('temas', 'asesor', 'temas_no_asignados','temasAsig'));
    }

    // reportes pdf de asesor 
    public function generarPDF($tipo)
    {
        $asesor = Auth::user();
        $estudiantes = Estudiante::where('asesor_id', $asesor->id)->pluck('user_id')->toArray();
        $users = User::whereIn('id', $estudiantes)->get();

        $fecha = Carbon::now()->timezone('America/La_Paz')->format('d/m/Y H:i');

        switch ($tipo) {
            case 'temas':
                $temas = Tema::whereIn('estudiante', $users->pluck('name'))->get();
                $pdf = PDF::loadView('reportes_pdf', compact('temas', 'asesor', 'fecha'));
                return $pdf->download('Reporte Temas ' . now()->format('d-m-Y') . '.pdf');
            case 'no_asignados':
                $temas = Tema::where('estudiante', 'Ninguno')->get();
                $pdf = PDF::loadView('reportes_pdf_no_asignados', compact('temas', 'asesor', 'fecha'));
                return $pdf->download('Reporte Temas No Asignados ' . now()->format('d-m-Y') . '.pdf');
            case 'asignados':
                $temas = Tema::where('estado', 'Asignado')->get();
                $pdf = PDF::loadView('reportes_pdf_asignados', compact('temas', 'fecha'));
                return $pdf->download('Reporte Temas Asignados ' . now()->format('d-m-Y') . '.pdf');
            default:
                return abort(404);
        }
    }
}

