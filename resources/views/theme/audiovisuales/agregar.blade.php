@extends("theme.$theme.layout")

@section('titulo')
    AudioVisuales
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
                        <h3 class="box-title">Agregar AudioVisual</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                <form  method="POST" action="{{route('agregar_audiovisual')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Nuevo AudioVisual</label>
                                <input type="file" id="exampleInputFile" name="audiovisual">
                            </div>
                        </div>
                        <!-- textarea -->
                        <div class="box-body">
                            <label>Descripcion</label>
                        <textarea class="form-control" rows="3" placeholder="..." name="descripcion">{{old('descripcion')}}</textarea>
                       </div>
                        <!-- /.box-body -->       
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection