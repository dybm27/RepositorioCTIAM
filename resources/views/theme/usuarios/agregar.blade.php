@extends("theme.$theme.layout")

@section('titulo')
    Usuarios
@endsection

@section('titulo1')
    <h1> Gestionar Usuarios </h1>
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include("theme.includes.error")
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Usuario</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                <form  method="POST" action="{{route('agregar_usuario')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputFile">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputFile" 
                                name="nombre" placeholder="nombre">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" 
                                name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label>Tipo Usuario</label>
                                <select class="form-control" name="tipousuario">
                                    @foreach ($tiposusuarios as $tipousuario)
                                    <option>{{$tipousuario->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" 
                                name="pass" placeholder="Password">
                            </div>
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