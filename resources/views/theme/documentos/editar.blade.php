@extends("theme.$theme.layout")

@section('titulo')
    Documentos
@endsection

@section('titulo1')
    <h1> Gestionar Informacion </h1>
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include("theme.includes.error")
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Actualizar Documento</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                <form  method="POST" action="{{route('editar_documento',$documento->id)}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputFile" name="nombre" placeholder="nombre"
                                    {{$nombre=explode('.',$documento->nombre)[0]}}
                                    value="{{$nombre}}">
                            </div>
                        <!-- textarea -->
                            <div class="form-group">
                                <label>Descripcion</label>
                                <textarea class="form-control" rows="3" placeholder="..." name="descripcion">{{$documento->descripcion}}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->       
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-primary pull-right" onclick="location.href='{{route('listar_documentos')}}'">
                                    <i class="fa fa-arrow-circle-o-left"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection