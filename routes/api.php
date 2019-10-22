<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
