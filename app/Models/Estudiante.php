<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends User
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        // 'nombre',
        // 'username',
        'celular',
        // 'password',
        'curso',
        'asesor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  
}
