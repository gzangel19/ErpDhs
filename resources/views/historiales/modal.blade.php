    <!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('historiales.store')}}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Historial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="idProductos_en_servicios" id="idProductos_en_servicios">
                        <input type="hidden" name="idServicios" id="idServicios">
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
                                <div class="form-group">
                                <label>Detalle</label>
                                <textarea class="form-control" name="detalle" id="detalle" rows="4"></textarea>
                                </div>
                            </div>
                        </div>                       
    
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    {{-- <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Cerrar</button> --}}
                    <button type="submit" class="btn btn-success btn-block modalCrearHistorial" >Guardar</button>
                   {{--  <a href="{{ route('historiales.create') }}" class="btn btn-success btn-block modalCrearHistorial">Guardar</a> --}}
                </div>
            </form>

        </div>
    </div>
</div>
    {{-- fin modal --}}