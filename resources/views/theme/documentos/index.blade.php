@extends("theme.$theme.layout")

@section('titulo')
    Documentos
@endsection

@section('titulo1')
    <h1> Gestionar Informacion</h1>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Documentos</h3>
                    <button  onclick="location.href='{{route('formulario_agregar_documento')}}'" 
                    class="btn btn-primary pull-right">Agregar Nuevo Documento</button>
                </div>
                <div class="box-body">
                    <table id="tablaDocumentos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Descargar</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentos as $documento)
                                <tr>
                                    <td>{{$documento->id}}</td>
                                    <td>{{$documento->nombre}}</td>
                                    <td>{{$documento->descripcion}}</td>
                                    <td><a href="gestionarDocumentos/descargar/{{$documento->id}}"><img src={{asset("iconos/$documento->extension.png")}}></a></td>
                                    <td><button class="btn btn-warning" onclick="location.href='{{route('formulario_editar_documento',$documento->id)}}'"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger" onclick="location.href='{{route('eliminar_documento',$documento->id)}}'"><span class="fa fa-trash"></span></button></td>
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
            $('#tablaDocumentos').DataTable({
            "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
            // "lengthMenu":    [2,4,6,8,10]
            });
        });
    </script>
@endsection