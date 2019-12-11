<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VistasDescargasRevistas extends Model
{
    protected $table='vistas_descargas_revistas';

    protected $primaryKey='id';

    protected $fillable = [
        'id_revista', 'tipo_accion','tipo_archivo'
    ];
    
    public function revista()
    {
        return $this->belongsTo(Revista::class);
    }
}
