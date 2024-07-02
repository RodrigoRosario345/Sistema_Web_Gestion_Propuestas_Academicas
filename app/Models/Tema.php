<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carrera;
use App\Models\Etiqueta;
use App\Models\Objetivo;


class Tema extends Model
{
    use HasFactory;

    protected $hidden = [
        'carrera_id',
        'created_at',
        'updated_at',
        'pivot'
    ];

    public function carrera(){
        return $this->belongsTo(Carrera::class);
    }

    public function objetivos(){
        return $this->hasMany(Objetivo::class);
    }

    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class, 'tema_etiquetas', 'tema_id', 'etiqueta_id');
    }

    protected $fillable = [
        'id',
        'titulo',
        'codigo',
        'documento',
        'preview_img',
        'carrera_id',
        'fecha',
        'estudiante',
        'tipo',
        'tutor',
        'asesor',
        'problematica',
        'estado',
        'created_at',
        'updated_at'
    ];
}
