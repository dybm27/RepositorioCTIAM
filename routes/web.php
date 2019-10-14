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

// ------ RUTA LOGIN ------
Route::get('/login', 'LoginController@index')->name('login');

// ---------- RUTAS DE ADMIN ------
Route::group(['prefix' => '/admin'/*,'middleware'=>'auth'*/], function () {
    Route::get('/','InicioController@index')->name('admin_inico');

    // --------- DOCUMENTOS ----------
    Route::get('/gestionarDocumentos','DocumentoController@index')->name('listar_documentos');
    Route::get('/gestionarDocumentos/agregar','DocumentoController@create')->name('formulario_agregar_documento');
    Route::post('/gestionarDocumentos/agregar','DocumentoController@store')->name('agregar_documento');
    Route::get('/gestionarDocumentos/descargar/{id}','DocumentoController@descargar')->name('descargar_documento');
    Route::get('/gestionarDocumentos/editar/{id}','DocumentoController@edit')->name('formulario_editar_documento');
    Route::post('/gestionarDocumentos/editar/{id}','DocumentoController@update')->name('editar_documento');
    Route::get('/gestionarDocumentos/eliminar/{id}','DocumentoController@destroy')->name('eliminar_documento');

    // --------- AUDIOVISUAL ----------
    Route::get('/gestionarAudioVisuales','AudioVisualController@index')->name('listar_audiovisuales');
    Route::get('/gestionarAudioVisuales/agregar','AudioVisualController@create')->name('formulario_agregar_audiovisual');
    Route::post('/gestionarAudioVisuales/agregar','AudioVisualController@store')->name('agregar_audiovisual');
    Route::get('/gestionarAudioVisuales/descargar/{id}','AudioVisualController@descargar')->name('descargar_audiovisual');
    Route::get('/gestionarAudioVisuales/editar/{id}','AudioVisualController@edit')->name('formulario_editar_audiovisual');
    Route::post('/gestionarAudioVisuales/editar/{id}','AudioVisualController@update')->name('editar_audiovisual');
    Route::get('/gestionarAudioVisuales/eliminar/{id}','AudioVisualController@destroy')->name('eliminar_audiovisual');

    // --------- USUARIO ----------
    Route::get('/gestionarUsuarios','UsuarioController@index')->name('listar_usuarios');
    Route::get('/gestionarUsuarios/agregar','UsuarioController@create')->name('formulario_agregar_usuario');
    Route::post('/gestionarUsuarios/agregar','UsuarioController@store')->name('agregar_usuario');
    Route::get('/gestionarUsuarios/editar/{id}','UsuarioController@edit')->name('formulario_editar_usuario');
    Route::post('/gestionarUsuarios/editar/{id}','UsuarioController@update')->name('editar_usuario');
    Route::get('/gestionarUsuarios/eliminar/{id}','UsuarioController@destroy')->name('eliminar_usuario');
    
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
