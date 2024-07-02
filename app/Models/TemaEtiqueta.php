<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tema;

class TemaEtiqueta extends Model
{
    use HasFactory;

    protected $table = 'tema_etiquetas';

    protected $fillable = [
        'tema_id',
        'etiqueta_id'
    ];
}
