<?php

namespace RepoCTIAM\Http\Controllers;

use RepoCTIAM\Documento;
use Illuminate\Http\Request;
use RepoCTIAM\Http\Requests\ValidacionDocumento;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $documentos = Documento::orderBy('id')->get();
        return view('theme.documentos.index',compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('theme.documentos.agregar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionDocumento $request)
    {
      if ($request->hasFile('documento')) {
           //obtenemos el campo file definido en el formulario
       $file = $request->file('documento');
        
       //obtenemos el nombre del archivo
       $fileName = $file->getClientOriginalName();
       $nombre=explode('.',$fileName)[0];
       $extension = explode('.',$fileName)[1];
        if(strcmp($extension,'pdf')==0||strcmp($extension,'docx')==0||strcmp($extension,'doc')==0
            ||strcmp($extension,'pptx')==0||strcmp($extension,'xlsx')==0){
            //indicamos que queremos guardar un nuevo archivo en la carpeta publica
            // \Storage::disk('local')->put($nombre,  \File::get($file));
            $file->move(storage_path().'/documentos',$fileName);
            $ruta=storage_path().$fileName;

            Documento::create([
                'nombre' => $nombre,
                'descripcion' => $request['descripcion'],
                'extension' => $extension,
                'ruta' => $ruta
                ]);
            return redirect('admin/gestionarDocumentos')->with('mensaje','ok');
        }else {
            return 'Tipo de documento erroneo';    
        }
      }
      return 'no entro';
    }

    /**
     * Display the specified resource.
     *
     * @param  \RepoCTIAM\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \RepoCTIAM\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RepoCTIAM\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \RepoCTIAM\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //
    }
}
