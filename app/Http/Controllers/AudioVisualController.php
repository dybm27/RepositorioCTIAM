<?php

namespace RepoCTIAM\Http\Controllers;

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
        //obtenemos el campo file definido en el formulario
        $file = $request->file('audiovisual');

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
        return redirect('admin/gestionarAudioVisuales')/*->with('mensaje','ok')*/;
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
    public function edit(AudioVisual $audioVisual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudioVisual $audioVisual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudioVisual $audioVisual)
    {
        //
    }

    public function descargar($id)
    {
        $audiovisual = AudioVisual::find($id);
        return response()->download($audiovisual->ruta);
    }
}
