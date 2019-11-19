<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table='libros';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'descripcion',
        'estado',
        'extension',
        'ruta'
    ];
}
