<?php

namespace RepoCTIAM\Http\Controllers;

use RepoCTIAM\Documento;
use Illuminate\Http\Request;
use RepoCTIAM\Http\Requests\ValidacionDocumento;
use Toastr;

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
           //obtenemos el campo file definido en el formulario
            $file = $request->file('documento');
                
            //obtenemos el nombre del archivo
            $fileName = $file->getClientOriginalName();
         
            $nombre=explode('.',$fileName)[0];
            $extension = explode('.',$fileName)[1];
            
            $file->move(storage_path().'/documentos',$fileName);
            $ruta='../storage/documentos/'.$fileName;

            $documento = Documento::create([
                'nombre' => $nombre,
                'descripcion' => $request['descripcion'],
                'extension' => $extension,
                'ruta' => $ruta
                ]);


                Toastr::success('Registro exitoso','Excelente!!!', 
                ["positionClass" => "toast-top-right"]);

            return redirect('admin/gestionarDocumentos')/*->with('mensaje','ok')*/;
           // return Response::json($documento);
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
    public function edit($id)
    {
        $where = array('id' => $id);
        $documento  = Documento::where($where)->first();
 
       // return Response::json($documento);
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
    public function destroy($id)
    {
        $documento = Documento::where('id',$id)->delete();
   
        //return Response::json($documento);
    }

    public function descargar($id)
    {
        $documento = Documento::find($id);
        return response()->download($documento->ruta);
    }
}
