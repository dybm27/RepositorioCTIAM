<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RepoCTIAM\ArchivosCapacitacion;
use RepoCTIAM\AudioVisual;
use RepoCTIAM\Capacitacion;
use RepoCTIAM\Documento;
use RepoCTIAM\Libro;
use RepoCTIAM\Revista;
use RepoCTIAM\TipoUsuario;
use RepoCTIAM\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('users', function () {
    return datatables()
        ->eloquent(User::query())
        ->addColumn('tipousuario', function($data){
            $tiposusuarios = TipoUsuario::orderBy('id')->get();
            $tipoU='';
            foreach($tiposusuarios as $tipo){
                if ($tipo->id==$data->tipousuario_id) {
                    $tipoU=$tipo->nombre;
                }
            }
            return $tipoU;
        })
        ->addColumn('btns','theme.usuarios.btnsIndex')
        ->rawColumns(['btns'])
        ->toJson();
});

Route::get('documentos', function () {
    return datatables()
        ->eloquent(Documento::query())
        ->addColumn('descargar','theme.documentos.btnsDescargar')
        ->addColumn('btns','theme.documentos.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('audiovisuales', function () {
    return datatables()
        ->eloquent(AudioVisual::query())
        ->addColumn('descargar','theme.audiovisuales.btnsDescargar')
        ->addColumn('btns','theme.audiovisuales.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('revistas', function () {
    return datatables()
        ->eloquent(Revista::query())
        ->addColumn('descargar','theme.revistas.btnsDescargar')
        ->addColumn('btns','theme.revistas.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('libros', function () {
    return datatables()
        ->eloquent(Libro::query())
        ->addColumn('descargar','theme.libros.btnsDescargar')
        ->addColumn('btns','theme.libros.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
});

Route::get('capacitaciones', function () {
    return datatables()
        ->eloquent(Capacitacion::query())
        ->addColumn('verArchivos','theme.capacitaciones.btnsVerArchivos')
        ->addColumn('btns','theme.capacitaciones.btnsIndex')
        ->rawColumns(['btns','verArchivos'])
        ->toJson();
});

Route::get('archivosCapacitacion/{id}', function () {
    $id= $_GET['id'];
    return datatables()
        ->eloquent(Capacitacion::find($id)->archivos())
        ->addColumn('descargar','theme.archivosCapacitaciones.btnsDescargar')
        ->addColumn('btns','theme.archivosCapacitaciones.btnsIndex')
        ->rawColumns(['btns','descargar'])
        ->toJson();
})->name('listar_archivosCapacitacion');

