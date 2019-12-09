<?php

namespace App\Http\Controllers;

use App\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Response;
use Validator;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('theme.libros.index');
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
            'libro' => 'required|mimes:pdf',
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
    
        $libroentrante= Libro::where('nombre',$fileName)->first();
    
        if (empty($libroentrante)) {
            $array= explode('.',$fileName);
        
            $extension=end($array);

            Storage::disk('local')->put('/public/libros/'.$fileName,file_get_contents($file));
            $ruta='/public/libros/'.$fileName;
            $rutaPublica='/storage/libros/'.$fileName;

            $libro=  Libro::create([
                'nombre' => $fileName,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'extension' => $extension,
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica,
                'tipo' => 'libro'
            ]);
        }else{
            return response()->json(['errors' => 
                        [0 =>'El libro ya existe']
                        ]);
        }   
       
       return Response::json($libro);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro  = Libro::find($id);
        $noms= explode('.',$libro->nombre,-1);
        $nombre=implode('.', $noms);         
        $libro=array_add($libro,'nomsinext',$nombre);
        return Response::json($libro);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
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

        $libro  = Libro::find($id);
        $nombreNuevo=$request['nombre'].'.'.$libro->extension;
        $libroentrante= Libro::where('nombre',$nombreNuevo)->first();

        if (empty($libroentrante)) {

            Storage::move('/public/libros/'.$libro->nombre,
            '/public/libros/'.$nombreNuevo);
                   
            $ruta='/public/libros/'.$nombreNuevo;
            $rutaPublica='/storage/libros/'.$nombreNuevo;

            $input = [
                'nombre' => $nombreNuevo,
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado'],
                'ruta' => $ruta,
                'rutaPublica' => $rutaPublica
            ];
        
            $libro->update($input);
        }elseif($libroentrante->id==$libro->id){

            $input = [
                'descripcion' => $request['descripcion'],
                'estado' => $request['estado']
            ];
        
            $libro->update($input);
            
        }else{
            return response()->json(['errors' => 
                        [0 =>'ya existe un libro con ese nombre']
                        ]);
        }

        return Response::json($libro);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libro = Libro::find($id);
        Storage::disk('local')->delete($libro->ruta);
        $libro->delete();
        return Response::json($libro);
    }

    public function descargar($id)
    {
        $libro = Libro::find($id);
        return response()->download(storage_path("app".$libro->ruta));
    }
}
