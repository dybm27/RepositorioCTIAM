<?php

namespace RepoCTIAM;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table='tipousuario';

    protected $primaryKey='id';

    protected $fillable =[
        'nombre'
    ];

    protected $guarded=['id'];

    public function users()
    {
        return $this->hasMany('RepoCTIAM\User','tipouser_id','id');
    }
}
