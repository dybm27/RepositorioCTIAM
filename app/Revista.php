<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class Revista extends Model
{
    protected $table='revistas';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'descripcion',
        'estado',
        'extension',
        'ruta'
    ];
}
