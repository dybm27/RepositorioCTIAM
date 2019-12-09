<?php

namespace App\Http\Controllers;

use App\Revista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RevistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.revistas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'revista' => 'required|mimes:pdf',
            'descripcion' => 'required'
        );

        $error=Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        //obtenemos el campo file definido en el formulario
        $file = $request->file('revista');
        //obtenemos el nombre del archivo
        $fileName = $file->getClientOriginalName();
    
        $revistaentrante= Revista::where('nombre',$fileName)->first();
    
        if (empty($revistaentrante)) {
            $array= explode('.',$fileName);
        
            $extension=end($array);

            Storage::disk('local')->put('/public/revistas/'.$fileName,file_get_contents($file));
            $ruta='/public/revistas/'.$fileName;
            $rutaPublica='/storage/revistas/'.$fileName;

            $revista=  Revista::create([
                'nombre' => $fileName,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica,
                'tipo' => 'revista'
            ]);
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe una revista con ese nombre']
                        ]);
        }   
       
       return Response::json($revista);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revista  $revista
     * @return \Illuminate\Http\Response
     */
    public function show(Revista $revista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revista  $revista
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revista  = Revista::find($id);
        $noms= explode('.',$revista->nombre,-1);
        $nombre=implode('.', $noms);         
        $revista=array_add($revista,'nomsinext',$nombre);
        return Response::json($revista);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revista  $revista
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

        $revista  = Revista::find($id);
        $nombreNuevo=$request['nombre'].'.'.$revista->extension;
        $revistaentrante= Revista::where('nombre',$nombreNuevo)->first();
        
        if (empty($revistaentrante)) {

            Storage::move('/public/revistas/'.$revista->nombre,
            '/public/revistas/'.$nombreNuevo);
                   
            $ruta='/public/revistas/'.$nombreNuevo;
            $rutaPublica='/storage/revistas/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ];
        
            $revista->update($input);
        }elseif($revistaentrante->id==$revista->id){
            $input = [
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado']
            ];
        
            $revista->update($input);
            
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe una revista con ese nombre']
                        ]);
        }
        return Response::json($revista);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revista  $revista
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revista = Revista::find($id);
        Storage::disk('local')->delete($revista->ruta);
        $revista->delete();
        return Response::json($revista);
    }

    public function descargar($id)
    {
        $revista = Revista::find($id);
        return response()->download(storage_path("app".$revista->ruta));
    }
}
