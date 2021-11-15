<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      
    <div class="modal-dialog" role="document">
            
        <div class="modal-content shadow">
                
            <div class="modal-header">
        
                <h5 class="modal-title" id="modalTitle"> </h5>
            
            </div>

            <div class="inside">      

                <table class="table table-hover mtop16">
                                
                    <thead>
                                    
                            <tr>
                                <th>Fecha</th>
                                <th>Forma de Pago</th>
                                <th>Monto</th>
                                <th>Tipo</th>
                            </tr>
                
                    </thead>
                                            
                    <tbody id="cuerpoTabla">

                    </tbody>
                
                </table>

                <div class="mtop16">

                    {!! Form::open(['url'=>'clientes/imprimir/historialPagos/individual']) !!}

                        {!!Form::hidden('pedido_id',null,['class' => 'form-control mtop16','id' => "pedido_id"])!!}

                        {!!Form::submit('Imprimir',['class' => 'btn btn-primary']) !!}   

                    {!! Form::close() !!}

                </div>
                
            </div>

        </div>

    </div>

</div>