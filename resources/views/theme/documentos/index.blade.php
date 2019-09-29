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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentos as $documento)
                                <tr>
                                    <td>{{$documento->id}}</td>
                                    <td>{{$documento->nombre}}</td>
                                <td><img src={{asset("iconos/$documento->extension.png")}}></td>
                                </tr>  
                            @endforeach                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection