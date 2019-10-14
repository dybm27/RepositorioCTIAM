<?php

namespace RepoCTIAM\Http\Controllers;

use RepoCTIAM\User;
use RepoCTIAM\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RepoCTIAM\Http\Requests\ValidacionUsuario;
use Toastr;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('id')->get();
        return view('theme.usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposusuarios = TipoUsuario::orderBy('id')->get();
        return view('theme.usuarios.agregar',compact('tiposusuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionUsuario $request)
    {  
        User::create([
            'name' => $request['nombre'],
            'email' => $request['email'],
            'tipousuario_id' => $request['tipousuario'],
            'password' => Hash::make($request['pass'])
            ]);

        Toastr::success('Registro exitoso','Excelente!!!', 
            ["positionClass" => "toast-top-right"]);

        return redirect('admin/gestionarUsuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  \RepoCTIAM\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \RepoCTIAM\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $tiposusuarios = TipoUsuario::orderBy('id')->get();
        $usuario = User::find($id);
        return view('theme.usuarios.editar',compact('tiposusuarios','usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \RepoCTIAM\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionUsuario $request, $id)
    {
       
        $user= User::find($id);
        if(empty ($request['pass'])){
            $pass=$user->password;
        }else{
            $pass=Hash::make($request['pass']);
        }
        $input = [
            'name' => $request['nombre'],
            'email' => $request['email'],
            'tipousuario_id' => $request['tipousuario'],
            'password' => $pass
        ];
       
        $user->update($input);
        // tambien puede ser--- pero habria que encriptar la pass
        //User::find($id)->update(array_filter($request->all()));
        Toastr::success('Actualizacion Exitosa', 'Excelente!!!', 
            ["positionClass" => "toast-top-right"]);

        return redirect('admin/gestionarUsuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \RepoCTIAM\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        Toastr::success('Eliminacion Exitosa', 'Excelente!!!', 
            ["positionClass" => "toast-top-right"]);
            
        return redirect('admin/gestionarUsuarios');
    }
}
