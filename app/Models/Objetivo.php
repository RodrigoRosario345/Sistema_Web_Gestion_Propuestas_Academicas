<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tema;

class Objetivo extends Model
{
    use HasFactory;

    protected $hidden = [
        'id',
        'tema_id',
        'created_at',
        'updated_at'
    ];

    public function tema(){
        return $this->belongsTo(Tema::class);
    }

    protected $fillable = [
        'id',
        'tema_id',
        'texto',
    ];
}
