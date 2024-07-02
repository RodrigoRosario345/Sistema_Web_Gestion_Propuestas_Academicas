<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tema;

class Etiqueta extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot'
    ];

    public function temas(){
        return $this->belongsToMany(Tema::class);
    }

    protected $fillable = [
        'id',
        'nombre',
        'tipo'
    ];
}
