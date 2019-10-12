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
                </div>
                <div class="box-body">
                    <table id="tabla" class="table table-bordered table-striped">
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
                                    <td></td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <button  onclick="location.href='{{route('formulario_agregar_documento')}}'" 
                        class="btn btn-primary">Agregar Nuevo Documento</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection