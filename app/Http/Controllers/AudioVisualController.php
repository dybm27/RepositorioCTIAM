<?php

namespace App\Http\Controllers;

use File;
use App\AudioVisual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ValidacionAudioVisual;
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
        return view('theme.audiovisuales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $rules = array(
            'audiovisual' => 'required|mimetypes:video/mp4',
            'descripcion' => 'required'
        );
        $messages = [
            'audiovisual.mimetypes' => 'El campo audiovisual debe ser un archivo de tipo: mp4.'
        ];
        $error=Validator::make($request->all(),$rules,$messages);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //obtenemos el campo file definido en el formulario
        $file = $request->file('audiovisual');
        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();
    
        $audiovisualentrante= AudioVisual::where('nombre',$fileName)->first();
    
        if (empty($audiovisualentrante)) {
            $array= explode('.',$fileName);
        
            $extension=end($array);

            Storage::disk('local')->put('/public/audiovisuales/'.$fileName,file_get_contents($file));
            $ruta='/public/audiovisuales/'.$fileName;
            $rutaPublica='/storage/audiovisuales/'.$fileName;
            
            $audiovisual=  AudioVisual::create([
                'nombre' => $fileName,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ]);
        }else{
            return response()->json(['errors' => 
                        [0 =>'El Archivo Multimedia ya existe']
                        ]);
        }   
       
       return Response::json($audiovisual);
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function show(AudioVisual $audioVisual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $audiovisual  = AudioVisual::find($id);
        $noms= explode('.',$audiovisual->nombre,-1);
        $nombre=implode('.', $noms);         
        $audiovisual=array_add($audiovisual,'nomsinext',$nombre);
        return Response::json($audiovisual);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'required'
        );
        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $audiovisual  = AudioVisual::find($id);
        $nombreNuevo=$request['nombre'].'.'.$audiovisual->extension;
        $audiovisualentrante= AudioVisual::where('nombre',$nombreNuevo)->first();

        if (empty($audiovisualentrante)) {

            Storage::move('/public/audiovisuales/'.$audiovisual->nombre,
            '/public/audiovisuales/'.$nombreNuevo);
                   
            $ruta='/public/audiovisuales/'.$nombreNuevo;
            $rutaPublica='/storage/audiovisuales/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ];
        
            $audiovisual->update($input);
        }elseif($audiovisualentrante->id==$audiovisual->id){

            $input = [
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado']
            ];
        
            $audiovisual->update($input);
            
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe un Archivo Multimedia con ese nombre']
                        ]);
        }

        return Response::json($audiovisual);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudioVisual  $audioVisual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $audiovisual = AudioVisual::find($id);
        Storage::disk('local')->delete($audiovisual->ruta);
        $audiovisual->delete();
        return Response::json($audiovisual);
    }

    public function descargar($id)
    {
        $audiovisual = AudioVisual::find($id);
        return response()->download(storage_path("app".$audiovisual->ruta));
    }
}
