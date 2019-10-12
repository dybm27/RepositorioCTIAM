@extends("theme.$theme.layout")

@section('titulo')
    Usuarios
@endsection

@section('titulo1')
    <h1> Gestionar Usuarios</h1>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Usuarios</h3>
                </div>
                <div class="box-body">
                    <table id="tabla" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Tipo</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{$usuario->id}}</td>
                                    <td>{{$usuario->name}}</td>
                                    <td>{{$usuario->email}}</td>
                                    <td>{{$usuario->tipousuario->nombre}}</td>
                                    <td></td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <button  onclick="location.href='{{route('formulario_agregar_usuario')}}'" class="btn btn-primary">Agregar Nuevo Documento</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection