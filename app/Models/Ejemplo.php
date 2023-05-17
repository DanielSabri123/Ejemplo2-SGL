<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejemplo extends Model
{
    use HasFactory;
    protected $table = 'Ejemplos';
    public $timestamps = false;
    protected $fillable =[
        "Id_Ejemplo", "Nombre", "Descripcion"
    ];
}