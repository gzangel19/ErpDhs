    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <div class="container-fluid">
            <div class="form-group">
                <label>Seleccione un Producto</label>
                <select class="form-control" name="producto" id="producto">
                    <option value="0">producto</option> 
                    @foreach ($productos as $p)
                    <option value="{{$p->idProductos}}">{{ $p->nombre }}</option> 
                    @endforeach                        
                </select>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>Estado:</label>
                <select class="form-control" name="estado" id="estado">
                    <option value="0">estado</option>
                    <option value="1">Alquilado</option>   
                    <option value="2">libre</option>                     
                </select>
                </div>          
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <label>N° Serie</label>
                <input type="text" class="form-control" id="numero_serie" name="numero_serie">
                </div>
            </div>                       

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary modalGuardar">Guardar</button>
        </div>
        </div>
    </div>
    </div>
    {{-- fin modal --}}