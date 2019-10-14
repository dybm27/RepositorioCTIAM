<?php

namespace RepoCTIAM\Http\Controllers;

use File;
use RepoCTIAM\AudioVisual;
use Illuminate\Http\Request;
use RepoCTIAM\Http\Requests\ValidacionAudioVisual;
use Toastr;

class AudioVisualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audiovisuales = AudioVisual::orderBy('id')->get();
        return view('theme.audiovisuales.index',compact('audiovisuales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.audiovisuales.agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionAudioVisual $request)
    {
        //cuando se arregele la validacion descomentarear codigo
        //obtenemos el campo file definido en el formulario
        /* $file = $request->file('audiovisual');

        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();
        $nombre=explode('.',$fileName)[0];
        $extension = explode('.',$fileName)[1];
     
        if(strcmp($extension,'mp3')==0||strcmp($extension,'mp4')==0){
        }else{
            $nombre=explode('.',$fileName)[0].'.'.explode('.',$fileName)[1];
            $extension = explode('.',$fileName)[2];
        }        
        $file->move(storage_path().'/audiovisuales',$fileName);
        $path='../storage/audiovisuales/'.$fileName;

        AudioVisual::create([
            'nombre' => $nombre,
            'descripcion' => $request['descripcion'],
            'extension' => $extension,
            'ruta' => $path
            ]);
        
        Toastr::success('Registro exitoso','Excelente!!!', 
                ["positionClass" => "toast-top-right"]);
        
                //return redirect()->back();
        return redirect('admin/gestionarAudioVisuales'); /*->with('mensaje','ok')*/

        $file = $request->file('audiovisual');

        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();

        $array= explode('.',$fileName);
        $extension=end($array);
     
        if(strcmp($extension,'mp3')==0||strcmp($extension,'mp4')==0){

            $audiovisualentrante= AudioVisual::where('nombre',$fileName)->first();

            if (empty($audiovisualentrante)) {
                $file->move(storage_path().'/audiovisuales',$fileName);
                $path='../storage/audiovisuales/'.$fileName;

                AudioVisual::create([
                    'nombre' => $fileName,
                    'descripcion' => $request['descripcion'],
                    'extension' => $extension,
                    'ruta' => $path
                    ]);
                
                Toastr::success('Registro exitoso','Excelente!!!', 
                        ["positionClass" => "toast-top-right"]);
                        
                return redirect('admin/gestionarAudioVisuales');
            }else{
                Toastr::error('El archivo ya Existe...','Error!!!', 
                    ["positionClass" => "toast-top-right"]);

                    return redirect()->back();
            }
            
        }else{
            Toastr::error('Tipo de archivo erroneo, solo se acepta mp3 y mp4','Error!!!', 
                ["positionClass" => "toast-top-right"]);
        
            return redirect()->back();
        }        
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function show(AudioVisual $audioVisual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audiovisual  = AudioVisual::find($id);
        $noms= explode('.',$audiovisual->nombre,-1);
        $nombre=implode(".", $noms);
        return view('theme.audiovisuales.editar',compact('audiovisual','nombre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionAudioVisual $request, $id)
    {
        $audioVisual  = AudioVisual::find($id);
        $audiovisualentrante= AudioVisual::where('nombre',$request['nombre'].'.'.$audioVisual->extension)->first();

        if (empty($audiovisualentrante)||$audiovisualentrante->id==$audioVisual->id) {

            File::move(storage_path('audiovisuales/'.$audioVisual->nombre),
             storage_path('audiovisuales/'.$request['nombre'].'.'.$audioVisual->extension));
        
            $ruta='../storage/audiovisuales/'.$request['nombre'].'.'.$audioVisual->extension;

            $input = [
                'nombre' => $request['nombre'].'.'.$audioVisual->extension,
                'descripcion' => $request['descripcion'],
                'ruta' => $ruta
            ];
        
            $audioVisual->update($input);

            Toastr::success('Actualizacion Exitosa', 'Excelente!!!', 
                ["positionClass" => "toast-top-right"]);

            return redirect('admin/gestionarAudioVisuales');
        }else{
            Toastr::error('Ya existe un archivo con ese nombre...','Error!!!', 
                    ["positionClass" => "toast-top-right"]);

                    return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $audioVisual = AudioVisual::find($id);
        File::delete($audioVisual->ruta);
        $audioVisual->delete();

        Toastr::success('Eliminacion Exitosa', 'Excelente!!!', 
            ["positionClass" => "toast-top-right"]);

        return redirect('admin/gestionarAudioVisuales');
    }

    public function descargar($id)
    {
        $audiovisual = AudioVisual::find($id);
        return response()->download($audiovisual->ruta);
    }
}
