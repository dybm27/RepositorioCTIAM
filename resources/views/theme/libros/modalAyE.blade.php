<div class="modal fade in" id="modalLibros" role="dialog">
        <div class="modal-dialog">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="modal-header with-border">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                <h3 id="modalT" class="modal-title">Agregar Libro</h3>
                            </div>
                            <!-- /.box-header -->   
                            <!-- form start -->
                            <div class="modal-body">
                                <span id="form_results"></span>
                                <form  id="formLibros" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group archivo">
                                        <label id="nomRev" for="examplse">Nuevo Libro</label>
                                        <input type="file" id="libro" name="libro" >
                                        <input type="hidden" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                                    </div>                          
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="visible">VISIBLE</option>
                                            <option value="oculto">OCULTO</option>
                                        </select>
                                    </div>                                  
                                    <label>Descripcion</label>
                                    <textarea class="form-control" rows="3" placeholder="..." id="descripcion" name="descripcion">
                                        {{old('descripcion')}}</textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right" id="btnModal">Agregar</button>
                                <input type="hidden" id="libro_id" name="libro_id" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>