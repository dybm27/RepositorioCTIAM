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

use Illuminate\Support\Facades\Route;

Route::get('/login', 'LoginController@index')->name('login');

// ---------- RUTAS DE ADMIN ------
Route::group(['prefix' => '/admin'/*,'middleware'=>'auth'*/], function () {
    Route::get('/','InicioController@index')->name('admin_inico');

    // --------- DOCUMENTOS ----------
    Route::get('/gestionarDocumentos','DocumentoController@index')->name('listar_documentos');
    Route::post('/gestionarDocumentos/agregar','DocumentoController@store')->name('agregar_documento');
    Route::get('/gestionarDocumentos/descargar/{id}','DocumentoController@descargar')->name('descargar_documento');
    Route::get('/gestionarDocumentos/editar/{id}','DocumentoController@edit')->name('formulario_editar_documento');
    Route::put('/gestionarDocumentos/editar/{id}','DocumentoController@update')->name('editar_documento');
    Route::get('/gestionarDocumentos/eliminar/{id}','DocumentoController@destroy')->name('eliminar_documento');

    // --------- AUDIOVISUAL ----------
    Route::get('/gestionarAudioVisuales','AudioVisualController@index')->name('listar_audiovisuales');
    Route::post('/gestionarAudioVisuales/agregar','AudioVisualController@store')->name('agregar_audiovisual');
    Route::get('/gestionarAudioVisuales/descargar/{id}','AudioVisualController@descargar')->name('descargar_audiovisual');
    Route::get('/gestionarAudioVisuales/editar/{id}','AudioVisualController@edit')->name('formulario_editar_audiovisual');
    Route::put('/gestionarAudioVisuales/editar/{id}','AudioVisualController@update')->name('editar_audiovisual');
    Route::get('/gestionarAudioVisuales/eliminar/{id}','AudioVisualController@destroy')->name('eliminar_audiovisual');

    // --------- USUARIO ----------
    Route::get('/gestionarUsuarios','UsuarioController@index')->name('listar_usuarios');                  
    Route::post('/gestionarUsuarios/agregar','UsuarioController@store')->name('agregar_usuario');
    Route::get('/gestionarUsuarios/editar/{id}','UsuarioController@edit')->name('formulario_editar_usuario');
    Route::put('/gestionarUsuarios/editar/{id}','UsuarioController@update')->name('editar_usuario');
    Route::get('/gestionarUsuarios/eliminar/{id}','UsuarioController@destroy')->name('eliminar_usuario');

    // --------- REVISTAS ---------
    Route::get('/gestionarRevistas','RevistaController@index')->name('listar_revistas');                  
    Route::post('/gestionarRevistas/agregar','RevistaController@store')->name('agregar_revista');
    Route::get('/gestionarRevistas/editar/{id}','RevistaController@edit')->name('formulario_editar_revista');
    Route::put('/gestionarRevistas/editar/{id}','RevistaController@update')->name('editar_revista');
    Route::get('/gestionarRevistas/eliminar/{id}','RevistaController@destroy')->name('eliminar_revista');
    Route::get('/gestionarRevistas/descargar/{id}','RevistaController@descargar')->name('descargar_revista');

     // --------- LIBROS ---------
     Route::get('/gestionarLibros','LibroController@index')->name('listar_libros');                  
     Route::post('/gestionarLibros/agregar','LibroController@store')->name('agregar_libro');
     Route::get('/gestionarLibros/editar/{id}','LibroController@edit')->name('formulario_editar_libro');
     Route::put('/gestionarLibros/editar/{id}','LibroController@update')->name('editar_libro');
     Route::get('/gestionarLibros/eliminar/{id}','LibroController@destroy')->name('eliminar_libro');
     Route::get('/gestionarLibros/descargar/{id}','LibroController@descargar')->name('descargar_libro');
     
     // --------- Capacitaciones ---------
     Route::get('/gestionarCapacitaciones','CapacitacionController@index')->name('listar_capacitaciones');                  
     Route::post('/gestionarCapacitaciones/agregar','CapacitacionController@store')->name('agregar_capacitacion');
     Route::get('/gestionarCapacitaciones/editar/{id}','CapacitacionController@edit')->name('formulario_editar_capacitacion');
     Route::put('/gestionarCapacitaciones/editar/{id}','CapacitacionController@update')->name('editar_capacitacion');
     Route::get('/gestionarCapacitaciones/eliminar/{id}','CapacitacionController@destroy')->name('eliminar_capacitacion');


     // --------- ArchivosCapacitacion ---------
     Route::get('/gestionarArchivosCapacitacion/{id}','ArchivosCapacitacionController@index')->name('listar_archivoscapacitacion');   
     Route::post('/gestionarArchivosCapacitacion/{idc}/agregar','ArchivosCapacitacionController@store')->name('agregar_archivoscapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/editar/{id}','ArchivosCapacitacionController@edit')->name('formulario_editar_archivocapacitacion');
     Route::put('/gestionarArchivosCapacitacion/{idc}/editar/{id}','ArchivosCapacitacionController@update')->name('editar_archivocapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/eliminar/{id}','ArchivosCapacitacionController@destroy')->name('eliminar_archivocapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/descargar/{id}','ArchivosCapacitacionController@descargar')->name('descargar_archivocapacitacion');               
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
