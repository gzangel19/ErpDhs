<?php 

    function getValueJS($json,$key){

        if($json == null):
        
            return null;
        
        else:
            
            $json = $json;
            
            $json = json_decode($json,true);
            
            if(array_key_exists($key,$json)):
            
                return $json[$key];
            
            else:

                return null;
            
            endif;

        endif;

    }
     
    function getModulesArray() {	
         
        $array = [
             '0' => 'Productos',
             '1' => 'Blog'
        ];

        return $array;
        
    }

    function getModulesTipo($mode) {	
         
        $tipo = [
             '0' => 'Escritorio',
             '1' => 'Mobile'
        ];

        if(!is_null($mode)):

            return $tipo[$mode];

        endif;

    }

    function getModulesVisible($mode) {	
         
        $visible = [
             '0' => 'No Visible',
             '1' => 'Visible'
        ];

        if(!is_null($mode)):

            return $visible[$mode];

        endif;
        
    }

    function getRolesArray($mode,$id) {	
        $roles = [
            'cliente' => 'Cliente',
            'usuario' => 'Usuario',
            'admin' => 'Administrador',
            'vendedor' => 'Vendedor',
            'munay' => 'Munay',
            'sinopsys' => 'Sinopsys',
            'vendedorcaja' => 'Vendedor Caja'
       ];

        if(!is_null($mode)):

            return $roles;
        
        else:
        
            return $roles[$id];
        
        endif;

    }

    function userPermissions(){
        
        $permisos = [
            'dashboard'=> [
                'icon' =>'<i class="fas fa-cash-register"></i>',
                'title' => 'Modulo de Dashboard',
                'keys' => [
                    'dashboard'=> 'Puede Ver el Dashboard?',
                    'dashboardStats' => 'Puede ver el Estadisticas ?',
                ]
            ],

            'cajas'=> [
                'icon' =>'<i class="fas fa-cash-register"></i>',
                'title' => 'Modulo de Caja',
                'keys' => [
                    'cajas'=> 'Puede Ver el Menu de Cajas ?',
                    'getAbrirCaja'=> 'Puede Abrir Caja ?',
                    'getCerrarCaja'=> 'Puede Cerrar Caja ?',
                    'getIngresoDinero'=> 'Puede Ingresar Dinero ?',
                    'getRetiroDinero'=> 'Puede Retirar Dinero ?',
                    'getFlujoCaja'=> 'Puede Ver el Movimiento en Caja ?',
                    'getPagos'=> 'Puede Ver Los Pagos ?',
                    'getPagosTotal'=> 'Puede Realizar Pagos ?',
                    'getPagosParcial'=> 'Puede Ingresar un Pago Parcial ?',
                    'getRecibos'=> 'Puede Ver Los Recibos ?',
                    'getCuentaCorriente'=> 'Puede Ver Las Cuentas Corrientes?'
                ]
            ],

            'vendedores'=> [
                'icon' =>'<i class="fas fa-people-carry"></i>',
                'title' => 'Modulo de Vendedores',
                'keys' => [
                    'getVendedores'=> 'Puede Ver el Menu de Vendedores ?',
                    'getComisionIndividual'=> 'Puede Ver Las Comisiones Individuales ?',
                    'getComisionGlobal'=> 'Puede Ver Las Comisiones Globales ?'
                ]
            ],

            'Ventas'=> [
                'icon' =>'<i class="fas fa-shopping-cart"></i>',
                'title' => 'Modulo de Pedidos',
                'keys' => [
                    'ventas'=> 'Puede Ver el Menu Ventas?',
                    'getPedidos' => 'Puede Ver Las Ventas',
                    'pedidosSearch'=> 'Puede Buscar una Venta?',
                    'pedidosCreate'=> 'Puede Agregar Ventas?',
                    'pedidosPdf'=> 'Puede Imprimir el Reporte de Ventas ?',
                    'pedidosExcel'=> 'Puede Imprimir el Reporte en Excel ?',
                    'pedidosShow'=> 'Puede Ver el Detalle del Pedido ?',
                    'pedidosEdit'=> 'Puede Editar el Pedido ?',
                    'pedidosDelete'=> 'Puede Eliminar el Pedido ?',
                    'pedidosPagos'=> 'Puede Ver los Pagos del Pedido ?',
                    'getCadete'=> 'Puede Vender Por Cadete ?',
                    'pedidosRemito'=> 'Puede Imprimir el Comprobante?',

                ]
            ],

            'Clientes'=> [
                'icon' =>'<i class="fas fa-address-card"></i>',
                'title' => 'Modulo de Clientes',
                'keys' => [
                    'getClientes'=> 'Puede Ver los Clientes?',
                    'clientesAdd'=> 'Puede Agregar Clientes?',
                    'clientesExcel'=> 'Puede Imprimir en Excel el Listado?',
                    'clientesPDF'=> 'Puede Imprimir en PDF el Listado?',
                    'clienteSearch'=> 'Puede Buscar un Cliente?',
                    'clienteShow'=> 'Puede Ver el Detalle de los Clientes?',
                    'clienteProduct'=> 'Puede ver el Historial de Productos?',
                    'clientesEdit'=> 'Puede Editar los Clientes?',
                    'clientesCuentas'=> 'Puede Editar la Cuenta Corriente?',
                    'clientesPagosParciales'=> 'Ver Pagos Parciales?',
                    'clientesReportePDF'=> 'Ver el Reporte del Cliente?',
                    'clientesReportePagosPDF'=> 'Ver el Historial de Pagos del Cliente?'
                ]
            ],

            'Presupuesto'=> [
                'icon' =>'<i class="fas fa-address-book"></i>',
                'title' => 'Modulo de Presupuesto',
                'keys' => [
                    'getPresupuesto'=> 'Puede Ver los Presupuestos?',
                    'presupuestosAdd'=> 'Puede Crear Presupuestos?',
                    'presupuestosShow'=> 'Puede Ver un Presupuesto?',
                    'presupuestoReport'=> 'Puede Imprimir los Presupuestos?'
                ]
            ],

            'Eccomerce'=> [
                'icon' =>'<i class="fas fa-shopping-cart"></i>',
                'title' => 'Modulo de Pedidos Eccomerce',
                'keys' => [
                    'getEccomerce'=> 'Puede Ver las Ordenes del Eccomerce?',
                    'ordenFilter'=> 'Puede Filtrar Ordenes?',
                    'eccomerceShow'=> 'Puede ver el Detalle de la Orden?',
                    'eccomerceEdit'=> 'Puede Cambiar el Estado de la Orden?'
                ]
            ],

            'Servicio Tecnico'=> [
                'icon' =>'<i class="nav-icon fas fa-tools"></i>',
                'title' => 'Modulo de Servicio Tecnico',
                'keys' => [
                    'getServicioTecnico'=> 'Puede Ver los Servicio Tecnico?',
                    'servicioSearch'=> 'Puede Buscar un Servicio Tecnico?',
                    'servicioCreate'=> 'Puede Registrar un Servicio Tecnico?',
                    'servicioShow'=> 'Puede Ver un Servicio Tecnico?',
                    'servicioDelete'=> 'Puede Cancelar un Servicio Tecnico?',
                    'comprobanteEntrega'=> 'Puede Ver el Comprobante de Entrega?',
                    'comprobanteRetiro'=> 'Puede Ver el Comprobante de Retiro?'
                ]
            ],

            'Maquinas'=> [
                'icon' =>'<i class="nav-icon fas fa-warehouse"></i>',
                'title' => 'Modulo de Sucursales',
                'keys' => [
                    'getDepositos'=> 'Puede Ver las Sucursales?',
                    'depositoSearch' => 'Puede Buscar un Deposito ?',
                    'depositoAdd'=> 'Puede Agregar un Deposito?',
                    'depositoShow'=> 'Puede Ver un Deposito?',
                    'depositoStock'=> 'Puede Ver El Inventario?',
                    'depositoMovimiento'=> 'Puede Mover Productos?',
                    'depositoUpdateStock'=> 'Puede Actualizar Stock del Deposito?',
                    'depositoImprimirStock'=> 'Puede Imprimir el Inventario?',
                    'depositoEdit'=>'Puede Editar los Depositos?'
                ]
            ],
            
            'depositos'=> [
                'icon' =>'<i class="nav-icon fas fa-warehouse"></i>',
                'title' => 'Modulo de Sucursales',
                'keys' => [
                    'getDepositos'=> 'Puede Ver las Sucursales?',
                    'depositoSearch' => 'Puede Buscar un Deposito ?',
                    'depositoAdd'=> 'Puede Agregar un Deposito?',
                    'depositoShow'=> 'Puede Ver un Deposito?',
                    'depositoStock'=> 'Puede Ver El Inventario?',
                    'depositoMovimiento'=> 'Puede Mover Productos?',
                    'depositoUpdateStock'=> 'Puede Actualizar Stock del Deposito?',
                    'depositoImprimirStock'=> 'Puede Imprimir el Inventario?',
                    'depositoEdit'=>'Puede Editar los Depositos?'
                ]
            ],

            'movimientos'=> [
                'icon' =>'<i class="fas fa-truck-moving"></i>',
                'title' => 'Modulo de Movimiento Deposito',
                'keys' => [
                    'getMovimiento'=> 'Puede Mover entre Depositos?'
                ]
            ],

            'productos'=> [
                'icon' =>'<i class="fas fa-boxes"></i>',
                'title' => 'Modulo de Producto',
                'keys' => [
                    'productosUnidades'=> 'Puede Seleccionar una Unidad?',
                    'getProductos' => 'Puede Ver los Productos ?',
                    'getProductSearch' => 'Puede Buscar un Producto ?',
                    'productsAdd'=> 'Puede Agregar Productos?',
                    'productoShow'=> 'Puede ver el Detalle de un Producto?',
                    'productosEdit'=> 'Puede Editar Productos?',
                    'productoStock'=> 'Puede Ver el Stock del Producto?'
                ]
            ],

            'Estadisticas'=> [
                'icon' =>'<i class="fas fa-boxes"></i>',
                'title' => 'Modulo de Estadisticas',
                'keys' => [
                    'getEstadisticas'=> 'Puede Ver las Estadisticas?'
                ]
            ],

            'Grafica'=> [
                'icon' =>'<i class="fas fa-luggage-cart"></i>',
                'title' => 'Modulo de Grafica Munay',
                'keys' => [
                    'getGraficaMunay'=> 'Puede Ver La Grafica?'
                ]
            ],

            'Tareas'=> [
                'icon' =>'<i class="fas fa-tasks"></i>',
                'title' => 'Modulo de Tareas',
                'keys' => [
                    'getTareas'=> 'Puede Ver las Tareas?',
                    'tareasCreate'=> 'Puede Crear Tareas?',
                    'tareasEdit'=> 'Puede Modificar Tareas?'
                ]
            ],

        ];

        return $permisos;
    }

    function getPaymentsMethods($method = null){
        
        $list = [
            '0' => 'Efectivo',
            '1' => 'Transferencia Bancaria',
            '2' => 'Mercado Pago'
        ];

       if(!is_null($method)):

           return $list[$method];

       endif;
    }

    function getOrderStatus($status = null){
        
        $list = [
            '0' => 'En Proceso',
            '1' => 'Pago Pendiente',
            '2' => 'Pago Recibido',
            '3' => 'Preparando Orden',
            '4' => 'Orden Enviada',
            '5' => 'Orden Entregada',
            '100' => 'Rechazada'
        ];

       if(!is_null($status)):

           return $list[$status];
       else:
            return $list;
       endif;
    }

    function getOrderEnvio($envio = null){
        
        $list = [
            '0' => 'Entrega a Domicilio',
            '1' => 'TO GO'
        ];

       if(!is_null($envio)):

           return $list[$envio];

       else:
        
        return $list;

       endif;
    }
    
?>