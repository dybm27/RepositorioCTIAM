<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class AudioVisual extends Model
{
    protected $table= 'audiovisual';

    protected $primaryKey='id';

    protected $fillable= [
        'nombre',
        'descripcion',
        'extension',
        'ruta'
    ];

    protected $guarded=['id'];
}
