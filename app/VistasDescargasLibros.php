<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VistasDescargasLibros extends Model
{
    protected $table='vistas_descargas_libros';

    protected $primaryKey='id';

    protected $fillable = [
        'id_libro', 'tipo_accion','tipo_archivo'
    ];
    
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
