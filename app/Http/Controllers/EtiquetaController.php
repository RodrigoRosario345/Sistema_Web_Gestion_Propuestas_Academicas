<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function search(Request $request){
        $input = $request->input('input');
        $tipo = $request->input('tipo');
        if($tipo == 'any')
            $etiquetas = Etiqueta::where('nombre', 'like', "%$input%")->get();
        else
            $etiquetas = Etiqueta::where('nombre', 'like', "%$input%")->where('tipo', $tipo)->get();
        return response()->json($etiquetas);
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etiqueta = Etiqueta::findOrfail($id);
        return response()->json($etiqueta);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etiqueta $etiqueta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etiqueta $etiqueta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etiqueta $etiqueta)
    {
        //
    }
}
