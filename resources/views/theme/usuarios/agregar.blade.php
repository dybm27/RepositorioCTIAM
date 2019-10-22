@extends("theme.$theme.layout")

@section('titulo')
    Usuarios
@endsection

@section('titulo1')
    <h1> Gestionar Usuarios </h1>
@endsection

@section('contenido')
    <div class="container">
        <div class="row col-centered ">
            <div class="col-md-6 ">
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
                                name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" 
                                name="email" placeholder="Enter email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Tipo Usuario</label>
                                <select class="form-control" name="tipousuario">
                                    @foreach ($tiposusuarios as $tipousuario)
                                <option value="{{$tipousuario->id}}">{{strtoupper($tipousuario->nombre)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="passInput">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passInput" 
                                    name="pass" placeholder="Contraseña" value="{{ old('pass') }}">
                                    <span class="input-group-addon" id="show_password" onclick="mostrarPassword()"><i class="fa  fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->       
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                            <button type="button" class="btn btn-primary pull-right" onclick="location.href='{{route('listar_usuarios')}}'">
                                <i class="fa fa-arrow-circle-o-left"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection