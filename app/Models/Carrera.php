<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function temas(){
        return $this->hasMany(Tema::class);
    }

    protected $fillable = [
        'id',
        'nombre', 
        'sigla', 
        'logo', 
        'color',
        'created_at',
        'updated_at'
    ];
}
