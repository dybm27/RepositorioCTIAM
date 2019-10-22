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
                    <button  onclick="location.href='{{route('formulario_agregar_usuario')}}'" class="btn btn-primary pull-right">Agregar Nuevo Usuario</button>
                </div>
                <div class="box-body">
                    <table id="tablaUsuarios" class="table table-bordered table-striped">
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
                                    <td><button class="btn btn-warning" onclick="location.href='{{route('formulario_editar_usuario',$usuario->id)}}'"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger" onclick="location.href='{{route('eliminar_usuario',$usuario->id)}}'"><span class="fa fa-trash"></span></button></td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                    </table>
                    <div class="box-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#tablaUsuarios').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
            // "lengthMenu":    [2,4,6,8,10]
            });
        });
    </script>
@endsection