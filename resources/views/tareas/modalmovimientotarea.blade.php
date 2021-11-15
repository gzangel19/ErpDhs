
<!-- Modal -->
<div class="modal fade" id="modalMovimientoTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" action="{{ route('tareas.movimiento')}}" role="form">
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <label>Tarea</label>
                            <input type="text" class="form-control" placeholder="Enter ..." id="tareaDescripcion" name="tareaDescripcion">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="Enter ..." id="tareaid" name="tareaid">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>
                    </div>

                </form>          
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

