@extends("theme.$theme.layout")

@section('titulo')
    AudioVisuales
@endsection

@section('titulo1')
    <h1> Gestionar Informacion</h1>
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">AudioVisuales</h3>
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
                            @foreach ($audiovisuales as $audiovisual)
                                <tr>
                                    <td>{{$audiovisual->id}}</td>
                                    <td>{{$audiovisual->nombre}}</td>
                                    <td>{{$audiovisual->descripcion}}</td>
                                    <td><a href="gestionarAudioVisuales/descargar/{{$audiovisual->id}}"><img src={{asset("iconos/$audiovisual->extension.png")}}></a></td>
                                    <td><button class="btn btn-warning" onclick="location.href='{{route('formulario_editar_audiovisual',$audiovisual->id)}}'"><span class="fa fa-pencil"></span></button>
                                        <button class="btn btn-danger" onclick="location.href='{{route('eliminar_audiovisual',$audiovisual->id)}}'"><span class="fa fa-trash"></span></button></td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                    </table>
                    <div class="box-footer">
                    <button  onclick="location.href='{{route('formulario_agregar_audiovisual')}}'"
                     class="btn btn-primary">Agregar Nuevo AudioVisual</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection