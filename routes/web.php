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

use Illuminate\Support\Facades\Route;

// ------ LOGIN ------
//debe llamarse login para que el metodo render del archivo app/exceptions/handler no genere error
Route::get('/','Auth\LoginController@showLoginForm')->name('login'); 
Route::post('login', 'Auth\LoginController@login')->name('iniciar_sesion');
Route::post('cerrarsesion','Auth\LoginController@logout')->name('cerrar_sesion');

// ------ REGISTRAR ------
// Registration Routes...
Route::get('registrar', 'Auth\RegisterController@showRegistrationForm')->name('form_registrar');
Route::post('registrar', 'Auth\RegisterController@register')->name('registrar');

// ------ RESTABLECER CONTRASEÑA ------
// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// ---------- RUTAS DE ADMIN ------
Route::group(['prefix' => '/admin','middleware' => ['auth','admin:1']], function () {

    // --------- PERFIL ----------
    Route::get('/','PerfilController@index')->name('admin_perfil');
    Route::put('/{id}','PerfilController@update')->name('admin_actualizar');

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
     
     // --------- CAPACITACIONES ---------
     Route::get('/gestionarCapacitaciones','CapacitacionController@index')->name('listar_capacitaciones');                  
     Route::post('/gestionarCapacitaciones/agregar','CapacitacionController@store')->name('agregar_capacitacion');
     Route::get('/gestionarCapacitaciones/editar/{id}','CapacitacionController@edit')->name('formulario_editar_capacitacion');
     Route::put('/gestionarCapacitaciones/editar/{id}','CapacitacionController@update')->name('editar_capacitacion');
     Route::get('/gestionarCapacitaciones/eliminar/{id}','CapacitacionController@destroy')->name('eliminar_capacitacion');


     // --------- ARCHIVOS CAPACITACIONES ---------
     Route::get('/gestionarArchivosCapacitacion/{id}','ArchivosCapacitacionController@index')->name('listar_archivoscapacitacion');   
     Route::post('/gestionarArchivosCapacitacion/{idc}/agregar','ArchivosCapacitacionController@store')->name('agregar_archivoscapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/editar/{id}','ArchivosCapacitacionController@edit')->name('formulario_editar_archivocapacitacion');
     Route::put('/gestionarArchivosCapacitacion/{idc}/editar/{id}','ArchivosCapacitacionController@update')->name('editar_archivocapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/eliminar/{id}','ArchivosCapacitacionController@destroy')->name('eliminar_archivocapacitacion');
     Route::get('/gestionarArchivosCapacitacion/{idc}/descargar/{id}','ArchivosCapacitacionController@descargar')->name('descargar_archivocapacitacion');   
     
     // --------- ESTADISTICAS ---------
     Route::get('/estadisticas/usuarios','EstadisticasController@indexUsuarios')->name('ver_estadisticas_usuarios'); 
     Route::get('/estadisticas/usuarios/grafica_registros/{anio}/{mes}', 'EstadisticasController@registros_mes')->name('grafica_registros');
     Route::get('/estadisticas/usuarios/grafica_registrosTipo/{anio}/{mes}', 'EstadisticasController@registrosTipo_mes')->name('grafica_registrosTipo_mes');
     Route::get('/estadisticas/usuarios/grafica_inicioSesionTipo/{anio}/{mes}', 'EstadisticasController@inicioSesionTipo')->name('grafica_registrosTipo_mes');

     Route::get('/estadisticas/archivos','EstadisticasController@indexArchivos')->name('ver_estadisticas_archivos'); 
     Route::get('/estadisticas/archivos/grafica_visitas/{anio}/{mes}', 'EstadisticasController@visitas_mes')->name('grafica_visitas');
     Route::get('/estadisticas/archivos/grafica_descargas/{anio}/{mes}', 'EstadisticasController@descargas_mes')->name('grafica_descargas');
     Route::get('/estadisticas/archivos/grafica_visitas_top_libros/{anio}/{mes}', 'EstadisticasController@top_visitas_mes_libros')->name('grafica_visitas_top_libros');
     Route::get('/estadisticas/archivos/grafica_visitas_top_revistas/{anio}/{mes}', 'EstadisticasController@top_visitas_mes_revistas')->name('grafica_visitas_top_revistas');
     Route::get('/estadisticas/archivos/grafica_descargas_top_libros/{anio}/{mes}', 'EstadisticasController@top_descargas_mes_libros')->name('grafica_descargas_top_libros');
     Route::get('/estadisticas/archivos/grafica_descargas_top_revistas/{anio}/{mes}', 'EstadisticasController@top_descargas_mes_revistas')->name('grafica_descargas_top_revistas');

     // --------- SLIDER ---------
     Route::get('/gestionarSlider','SliderController@index')->name('listar_sliders');                  
     Route::post('/gestionarSlider/agregar','SliderController@store')->name('agregar_slider');
     Route::get('/gestionarSlider/editar/{id}','SliderController@edit')->name('formulario_editar_slider');
     Route::post('/gestionarSlider/editar/{id}','SliderController@update')->name('editar_slider');
     Route::get('/gestionarSlider/eliminar/{id}','SliderController@destroy')->name('eliminar_slider');

     
});


// -------------- USUARIO FINAL --------------------
Route::group(['prefix' => '/usuariofinal','middleware' => 'auth'], function () {

     Route::get('/', 'UsuarioFinalController@index')->name('inicio');
     Route::get('/multimedia', 'UsuarioFinalController@multimedia')->name('multimedia');
     Route::get('/multimedia/libros', 'UsuarioFinalController@multimediaLibros')->name('multimedia_libros');
     Route::get('/multimedia/libros/descargar/{id}','LibroController@descargar')->name('descargar_libro_usuariofinal');
     Route::get('/multimedia/libros/ver/{id}', 'LibroController@ver')->name('ver_libro_usuariofinal');
     Route::get('/multimedia/revistas', 'UsuarioFinalController@multimediaRevistas')->name('multimedia_revistas');
     Route::get('/multimedia/revistas/descargar/{id}','RevistaController@descargar')->name('descargar_revista_usuariofinal');
     Route::get('/multimedia/revistas/ver/{id}', 'RevistaController@ver')->name('ver_revista_usuariofinal');

     Route::get('/multimedia/videos/ver/{id}', 'AudioVisualController@ver')->name('ver_video_usuariofinal');
     
});