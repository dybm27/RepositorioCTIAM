<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// ---------- RUTAS DE ADMIN ------
Route::group(['prefix' => '/admin'], function () {
    Route::get('/','InicioController@index')->name('admin_inico');

    // --------- DOCUMENTOS ----------
    Route::get('/gestionarDocumentos','DocumentoController@index')->name('listar_documentos');
    Route::get('/gestionarDocumentos/agregar','DocumentoController@create')->name('formulario_agregar_documento');
    Route::post('/gestionarDocumentos/agregar','DocumentoController@store')->name('agregar_documento');
});
