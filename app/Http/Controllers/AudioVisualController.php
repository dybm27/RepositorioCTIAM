<?php

namespace RepoCTIAM\Http\Controllers;

use File;
use RepoCTIAM\AudioVisual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
    public function store(ValidacionAudioVisual $request)
    {
        $rules = array(
            'audiovisual' => 'required|mimes:mp3,mp4',
            'descripcion' => 'required'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //obtenemos el campo file definido en el formulario
        $file = $request->file('libro');
        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();
    
        $audiovisualentrante= AudioVisual::where('nombre',$fileName)->first();
    
        if (empty($audiovisualentrante)) {
            $array= explode('.',$fileName);
        
            $extension=end($array);

            Storage::disk('local')->put('/public/audiovisuales/'.$fileName,file_get_contents($file));
            $ruta='/public/audiovisuales/'.$fileName;

            $audiovisual=  AudioVisual::create([
                'nombre' => $fileName,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'extension' => $extension,
                'ruta' => $ruta
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
        $nombre=implode('.', $noms);         
        $audiovisual=array_add($audiovisual,'nomsinext',$nombre);
        return Response::json($audiovisual);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
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
        $audiovisualentrante= Libro::where('nombre',$nombreNuevo)->first();

        if (empty($audiovisualentrante)) {

            Storage::move('/public/libros/'.$audiovisual->nombre,
            '/public/libros/'.$nombreNuevo);
                   
            $ruta='/public/libros/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'ruta' => $ruta
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
     * @param  \RepoCTIAM\AudioVisual  $audioVisual
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
