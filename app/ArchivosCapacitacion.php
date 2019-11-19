<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class ArchivosCapacitacion extends Model
{
    protected $table='archivoscapacitacion';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre',
        'capacitacion_id',
        'descripcion',
        'estado',
        'extension',
        'ruta'
    ];

    public function capacitacion()
    {
        return $this->belongsTo(Capacitacion::class);
    }
}
