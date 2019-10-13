<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table='documentos';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'descripcion',
        'extension',
        'ruta'
    ];

}
