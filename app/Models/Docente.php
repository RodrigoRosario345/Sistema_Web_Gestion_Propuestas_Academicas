<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'celular',
        'direccion',
        'ci',
        'especialidad'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function especialidad(){
        return $this->belongsToMany(Etiqueta::class, 'docente_especialidad', 'docente_id', 'especialidad_id');
    }

}
