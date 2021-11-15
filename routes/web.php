<?php
use App\RoleUser;

/* Route::get('/', function () {
  return redirect()->route('home');
}); */


// Rutas de la tienda

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){

  // MENU VENTAS //

// Clientes

    Route::get('clientes', 'ClienteController@home')->name('clientes.index');

    Route::get('clientes/create', 'ClienteController@create')->name('clientes.create');

    Route::post('clientes/store', 'ClienteController@store')->name('clientes.store');
    
    Route::post('clientes/storec', 'ClienteController@storeCliente')->name('clientes.storeCliente');

    Route::get('clientes/detalle/{cliente}', 'ClienteController@show')->name('clientes.show');

    Route::get('clientes/edit/{cliente}', 'ClienteController@edit')->name('clientes.edit');

    Route::post('clientes/update/{cliente}', 'ClienteController@update')->name('clientes.update');

    Route::get('cliente/exportar', 'ClienteController@exportCliente')->name('cliente.downloadExcel');

    Route::get('cliente/pdf', 'PdfController@listadoClientes')->name('cliente.downloadPdf');

    Route::get('cliente/delete/{cliente}', 'ClienteController@delete')->name('clientes.delete');

    Route::get('cliente/reportePagos/{cliente}', 'ClienteController@reportePagosCliente')->name('cliente.pagosReporte');

    Route::post('clientes/imprimir/historialPagos/individual','ClienteController@imprimirHistorialPagosPedido')->name('cliente.imprimirHistorialPagosPedido');
// Presupuesto

    Route::get('presupuestos', 'PresupuestoController@index')->name('presupuestos.index');

    Route::get('presupuestos/create/{cliente}/{unidad}', 'PresupuestoController@create')->name('presupuesto.create');

    Route::get('presupuesto/nuevo','PresupuestoController@nuevoSinCliente')->name('presupuesto.nuevo');

    Route::get('presupuestos/{id}/cambiar', 'PresupuestoController@cambiar')->name('presupuestos.cambiar');

    Route::post('presupuestos/store', 'PresupuestoController@store')->name('presupuestos.store');

    Route::get('presupuestos/{presupuestos}', 'PresupuestoController@show')->name('presupuestos.show');

    Route::get('presupuesto/exportar', 'PresupuestoController@exportPresupuestos')->name('presupuestos.downloadExcel');

    Route::get('presupuesto/pdf', 'PresupuestoController@listadoPresupuestos')->name('presupuestos.downloadPdf');

    Route::get('presupuesto/Impimir/Factura/{presupuesto}', 'PresupuestoController@recivo')->name('presupuesto.imprimir');
    
    Route::get('presupuesto/seleccionar', 'PresupuestoController@seleccionar')->name('presupuesto.seleccionar');
    
    Route::get('presupuesto/seleccionarNegocio/{cliente}', 'PresupuestoController@seleccionarNegocio')->name('presupuesto.seleccionarNegocio');
    
    Route::post('presupuesto/storec', 'PresupuestoController@storeCliente')->name('presupuesto.storeCliente');
// Proveedores

     Route::get('proveedores', 'ProveedorController@index')->name('proveedores.index');

     Route::get('proveedores/create', 'ProveedorController@create')->name('proveedores.create');

     Route::post('proveedores/store', 'ProveedorController@store')->name('proveedores.store');

     Route::get('proveedores/{proveedores}', 'ProveedorController@show')->name('proveedores.show');

     Route::get('proveedores/{proveedores}/edit', 'ProveedorController@edit')->name('proveedores.edit');

     Route::put('proveedores/{proveedores}', 'ProveedorController@update')->name('proveedores.update');

     Route::delete('proveedores/{proveedores}', 'ProveedorController@destroy')->name('proveedores.destroy');

     Route::get('proveedor/pdf', 'ProveedorController@listadoProveedores')->name('proveedores.downloadPdf');

//CONTACTOS PROVEEDORES

     Route::post('Contacto_Proveedor/store', 'ContactoProveedorController@store')->name('ContactosProveedores.store');

     Route::put('Contacto_Proveedor/update', 'ContactoProveedorController@update')->name('ContactosProveedores.update');

     Route::delete('Contacto_Proveedor/{contactos}', 'ContactoProveedorController@destroy')->name('ContactosProveedores.destroy');

// PDFS

   Route::get('pdf/listadoDepositosPdf', 'PdfController@listadoDepositos')->name('pdf.ListadoDepositosPdf');

   Route::get('pdf/listadoPdf', 'PdfController@listadoEmpresas')->name('pdf.ListadoClientePdf');

   Route::get('pdf/impimirPresupuesto/{presupuesto}', 'PdfController@presupuesto')->name('pdf.impimirPresupuesto');

   Route::get('pdf/impimirMovimientoPedido/{pedido}', 'PdfController@movimientoPedido')->name('pdf.impimirMovimientoPedido');

   Route::get('pdf/remitox/{pedido}', 'PdfController@imprimirRemito')->name('pdf.imprimirRemito');

   Route::get('pdf/comprobante/{pago}', 'PdfController@imprimirReciboComprobante')->name('pdf.comprobante');

   Route::get('pdf/historialPagos/{pago}', 'PdfController@historialPagos')->name('pdf.historialPagos');

   Route::get('pdf/cajaDiario', 'PdfController@reporteCajaDiario')->name('pdf.reporteCajaDiario');

   Route::get('pdf/inventario/{deposito}', 'PdfController@inventario')->name('pdf.inventario');

   Route::get('reporte/{desde}/{hasta}', 'PdfController@imprimirComisionesGlobal')->name('reporte.comisiones');

   //Route::get('comisiones/imprimir/{vendedor}/{fechaDesde}/{fechaHasta}', 'ComisionController@imprimir')->name('comisiones.imprimir');
// Cedes

  Route::post('cede/store', 'CedeController@store')->name('cede.store');

// Unidades de Negocio

  Route::get('unidades', 'UnidadNegocioController@index')->name('unidades.index');

  Route::get('unidades/create', 'UnidadNegocioController@create')->name('unidades.create');

  Route::post('unidades/store', 'UnidadNegocioController@store')->name('unidades.store');

  Route::get('unidades/detalle/{unidadnegocio}', 'UnidadNegocioController@show')->name('unidadnegocio.show');

  Route::get('unidades/editar/{unidadnegocio}', 'UnidadNegocioController@edit')->name('unidadnegocio.edit');

  Route::post('unidades/update/{unidadnegocio}', 'UnidadNegocioController@update')->name('unidadnegocio.update');
  
  Route::get('unidad/delete/{unidad}', 'UnidadNegocioController@delete')->name('unidades.delete');

  // Servicios

  Route::get('servicios', 'ServiciosController@index')->name('servicios.index');

  Route::post('Servicios/Search', 'ServiciosController@search')->name('servicios.search');

  Route::post('servicios/store/clientes', 'ServiciosController@storeCliente')->name('servicios.storeCliente');

  Route::get('servicios/clientes', 'ServiciosController@clientes')->name('servicios.cliente');

  Route::get('servicios/{cliente}', 'ServiciosController@equipos')->name('servicios.equipos');

  Route::post('servicios/maquinarias', 'ServiciosController@maquinarias')->name('servicios.maquinarias');

  Route::get('servicios/create/{cliente}/{maquina}', 'ServiciosController@create')->name('servicios.create');

  Route::post('servicios/store', 'ServiciosController@store')->name('servicios.store');

  Route::get('servicios/detalle/{servicios}', 'ServiciosController@show')->name('servicios.show');

  Route::get('servicio/{servicios}/delete', 'ServiciosController@delete')->name('servicios.cancelar');
  
  Route::get('servicios/cotizar/{servicios}', 'ServiciosController@cotizar')->name('servicios.cotizar');

  Route::put('servicios/finalizar/{servicios}', 'ServiciosController@update')->name('servicios.update');

  Route::get('servicios/imprimir/comprobante/{servicio}', 'ServiciosController@comprobante')->name('servicios.comprobante');
  
  Route::get('servicio/comprobante/retiro/{servicio}', 'ServiciosController@comprobanteRetiro')->name('servicios.comprobanteRetiro');

  Route::get('servicio/producto/store/{producto}/{servicio}','ServiciosController@cargarProductoServicio')->name('cargarProductoServicio');


    // Productos

  Route::get('productos/unidades', 'ProductosController@unidades')->name('productosUnidades');

  Route::get('productos/index/{unidad}', 'ProductosController@index')->name('getProductos');

  Route::get('productos/create/{unidad}', 'ProductosController@create')->name('productosAdd');

  Route::post('productos/store', 'ProductosController@store')->name('productosAdd');

  Route::get('productos/{productos}', 'ProductosController@show')->name('productoShow');

  Route::get('productos/{productos}/edit', 'ProductosController@edit')->name('productosEdit');

  Route::put('productos/{productos}/edit', 'ProductosController@update')->name('productosEdit');

  Route::get('producto/pdf', 'ProductosController@listadoProductos')->name('productosPdf');
  

   //Materias Primas/

  Route::get('materiales/listado', 'MaterialesController@index')->name('materiales.index');

  Route::post('materiales/store', 'MaterialesController@store')->name('materiales.store');

  Route::post('materiales/edit', 'MaterialesController@update')->name('materiales.edit');

   //Cotizadores/

  Route::get('cotizadores/listado', 'CotizadoresController@index')->name('cotizaciones.index');

  Route::get('cotizadores/cargar', 'CotizadoresController@create')->name('cotizaciones.create');

  Route::post('cotizadores/store', 'CotizadoresController@store')->name('cotizaciones.store');

  Route::get('cotizador/{producto}/editar', 'CotizadoresController@editar')->name('productoCotizado.editar');

  Route::put('cotizador/modificar/{producto}', 'CotizadoresController@modificar')->name('productoCotizado.modificar');

  Route::get('cotizadores/{productos}', 'CotizadoresController@show')->name('cotizaciones.show');

  Route::post('materiasPrimas/editar', 'CotizadoresController@update')->name('cotizaciones.editar');
  
  Route::delete('materiasPrimas/eliminar/{id}', 'CotizadoresController@destroy')->name('cotizaciones.destroy');
  
  Route::post('materiasPrimas/añadir', 'CotizadoresController@añadir')->name('cotizaciones.añadir');

  //Usuarios
  Route::get('usuarios', 'UsuarioController@index')->name('usuarios.index');

  Route::get('usuarios/create', 'UsuarioController@create')->name('usuarios.create');

  Route::post('usuarios/store', 'UsuarioController@store')->name('usuarios.store');

  Route::get('usuarios/{user}/edit', 'UsuarioController@edit')->name('usuarios.edit');

  Route::put('usuarios/{user}', 'UsuarioController@update')->name('usuarios.update');

  Route::get('usuarios/{usuario}', 'UsuarioController@show')->name('usuarios.show');

  Route::get('usuario/perfil', 'UsuarioController@editPerfil')->name('usuarios.editPerfil');

  Route::put('usuario/updatePerfil', 'UsuarioController@updatePerfil')->name('usuarios.updatePerfil');

  Route::put('usuario/inactivo/{usuario}', 'UsuarioController@inactivo')->name('usuarios.inactivo');

  Route::put('usuario/activo/{usuario}', 'UsuarioController@activo')->name('usuarios.activo');

  Route::get('usuario/cambiarDeposito', 'UsuarioController@seleccionarDeposito')->name('usuarios.cambiarDeposito');

  Route::get('usuario/updateDeposito/{deposito}', 'UsuarioController@updateDeposito')->name('usuarios.updateDeposito');

  Route::get('usuarios/{user}/permisos', 'UsuarioController@getPermisos')->name('usuarios.permisos');

  Route::post('users/{user}/permisos', 'UsuarioController@postPermisos')->name('usuarios.permisos');


  //historial
  Route::get('historial', 'HistorialProductoController@index')->name('historiales.index');

 // Route::get('historial/create', 'HistorialProductoController@create')->name('historiales.create');

  Route::post('historial/store', 'HistorialProductoController@store')->name('historiales.store');

  Route::get('historial/{historial}', 'HistorialProductoController@show')->name('historiales.show');

  //Route::get('historial/{historial}/edit', 'HistorialProductoController@edit')->name('historiales.edit');

  //Route::put('historial/{historial}', 'HistorialProductoController@update')->name('historiales.update');

  //Route::delete('historial/{historial}', 'HistorialProductoController@destroy')->name('historiales.destroy');

  

     // Pedidos

     Route::get('Pedidos/Index/', 'PedidoController@index')->name('pedidos.index');

     Route::post('Pedidos/Search','PedidoController@Search')->name('pedidos.search');

     Route::get('pedidos/seleccionar', 'PedidoController@seleccionar')->name('pedidos.seleccionar');

     Route::get('pedidos/seleccionarNegocio/{cliente}', 'PedidoController@seleccionarNegocio')->name('pedidos.seleccionarNegocio');

     Route::get('pedidos/create/{cliente}/{unidad}', 'PedidoController@create')->name('pedidos.create');

     Route::post('pedidos/store', 'PedidoController@store')->name('pedidos.store');
     
     Route::get('Pedidos/Detalle/{pedidos}', 'PedidoController@show')->name('pedidos.show');

     Route::get('pedidos/movimiento/{id}', 'PedidoController@movimientoPedido')->name('pedido.movimiento');

     Route::get('pedidos/preparar/{id}/{pedido}', 'PedidoController@preparar')->name('pedidos.preparar');

     Route::get('pedido/entregar', 'PedidoController@pedidosaEntregar')->name('pedidos.entregar');

     Route::get('pedido/finalizar/{id}', 'PedidoController@pedidosfinalizar')->name('pedido.finalizar');

     Route::get('pedidos/reporte/pdf', 'PedidoController@generarReportePDF')->name('pedidos.downloadPdf');

     Route::get('pedidos/reporte/excel', 'PedidoController@generarReporteExcel')->name('pedidos.downloadExcel');

     Route::get('pedido/eliminar/{pedido}', 'PedidoController@eliminar')->name('pedidos.eliminar');

     Route::put('pedidos/{pedido}', 'PedidoController@update')->name('pedidos.update');

    // Ordenes Eccomerce

      Route::get('Ordenes/{status}/{forma}','OrdenController@getOrdenes')->name('getOrder');

      Route::get('Orden/detalle/{orden}','OrdenController@getOrden')->name('getOrden');

      Route::post('Orden/update/status/{orden}','OrdenController@postUpdateStatus')->name('getOrden');
     
      Route::post('Orden/Search','OrdenController@ordenSearch')->name('getOrden');
      

     // Munay
     
     Route::get('pedido/munay', 'PedidoController@munay')->name('pedidos.munay');

     Route::post('pedidos/munay/store', 'PedidoController@munayStore')->name('munay.store');

     // Depositos

     Route::get('depositos', 'DepositoController@index')->name('getDepositos');

     Route::get('depositos/create', 'DepositoController@create')->name('depositoAdd');

     Route::get('deposito/detalle/{depositos}', 'DepositoController@show')->name('depositoShow');

     Route::post('depositos/store', 'DepositoController@store')->name('depositos.store');

     Route::get('depositos/edit/{depositos}', 'DepositoController@edit')->name('depositos.edit');

     Route::post('depositos/update/{depositos}', 'DepositoController@update')->name('depositos.update');

     Route::put('deposito/UpdateStock', 'DepositoController@updateStock')->name('depositos.stock');

     Route::get('deposito/{depositos}/exportProducto', 'DepositoController@exportProducto')->name('deposito.downloadProductos');

     Route::get('depositos/moverProducto/{depositos}', 'DepositoController@moverProducto')->name('depositos.moverProducto');

     Route::post('deposito/moverProducto/store', 'DepositoController@movimientoStore')->name('movimientos.store');

      // Tareas

      Route::get('tareas/create', 'TareaController@create')->name('tareas.create');

      Route::post('tareas/store', 'TareaController@store')->name('tareas.store');

      Route::get('tareas/visor', 'TareaController@visor')->name('tareas.visor');

      Route::get('tareas/global', 'TareaController@global')->name('tareas.global');

      Route::put('tareas/movimiento', 'TareaController@movimiento')->name('tareas.movimiento');

      Route::put('tareas/asignar', 'TareaController@asignar')->name('tareas.asignar');


// Movimientos Pedidos

      Route::get('movimientos', 'MovimientoDepositoController@index')->name('movimientos.index');

      Route::get('movimientos/{movimientos}', 'MovimientoDepositoController@show')->name('movimientos.show');

    //Compras
      Route::get('compras', 'ComprasController@index')->name('compras.index');

      Route::get('compras/create', 'ComprasController@create')->name('compras.create');

      Route::post('compras/store', 'ComprasController@store')->name('compras.store');

      Route::get('compras/{compra}', 'ComprasController@show')->name('compras.show');

      // Orden de Compra

  Route::get('ordenCompra', 'OrdenCompraController@index')->name('ordenCompra.index');

  Route::get('ordenCompra/create', 'OrdenCompraController@create')->name('ordenCompra.create');

  Route::post('ordenCompra/store/', 'OrdenCompraController@store')->name('ordenCompra.store');

  Route::get('ordenCompra/{presupuestos}', 'OrdenCompraController@show')->name('ordenCompra.show');

  Route::delete('ordenCompra/{presupuestos}', 'OrdenCompraController@destroy')->name('ordenCompra.destroy');

  Route::get('ordenCompra/pdf/{orden}', 'OrdenCompraController@comprobante')->name('ordenCompra.downloadComprobante');

  Route::get('ordenPago/pdf/{orden}', 'OrdenCompraController@comprobantePago')->name('ordenCompra.downloadComprobantePago');

  // Roles
  Route::get('roles', 'RoleController@index')->name('roles.index');

  Route::get('roles/create', 'RoleController@create')->name('roles.create');

  Route::post('roles/store', 'RoleController@store')->name('roles.store');

  Route::get('roles/{rol}', 'RoleController@show')->name('roles.show');

  Route::get('roles/{rol}/edit', 'RoleController@edit')->name('roles.edit');

  Route::put('roles/{roles}', 'RoleController@update')->name('roles.update');


  // CATEGORIAS //

  Route::get('categorias', 'CategoriaController@index')->name('categorias.index');

  Route::post('categorias/store', 'CategoriaController@store')->name('categorias.store');

  Route::put('categorias/{categorias}', 'CategoriaController@update')->name('categorias.update');

  Route::put('categorias/eliminar/{categorias}', 'CategoriaController@eliminar')->name('categorias.eliminar');

  Route::put('categorias/activar/{categorias}', 'CategoriaController@activar')->name('categorias.activar');
  
  // CAJAS //

  Route::get('cajas', 'CajasController@index')->name('cajas.index');

  Route::post('cajas/resta/{caja}', 'CajasController@resta')->name('cajas.resta');

  Route::post('cajas/ingresar/{caja}', 'CajasController@sumar')->name('cajas.sumar');

  Route::get('cajas/abrirCerrar/{caja}', 'CajasController@abrirCerrar')->name('cajas.abrirCerrar');

  Route::get('cajas/{caja}', 'CajasController@show')->name('cajas.show');

  Route::get('caja/dia/{caja}', 'CajasController@diario')->name('cajas.diaria');



  // CUENTAS //

  Route::get('cuentas', 'ClienteController@cuentasCorriente')->name('cuentas.index');

  Route::get('cuentas/show/{cliente}', 'ClienteController@showCorriente')->name('cuentas.show');

  Route::post('cuentas/store', 'ClienteController@storeCuenta')->name('cuentas.store');

  Route::get('cuentas/historial/{pago}', 'ClienteController@historialPagos')->name('cuentas.historial');

  Route::get('cuentas/historial/Cliente/{cliente}', 'ClienteController@historialClienteCorriente')->name('cuentas.historialClienteCorriente');



  // ESTADISTICAS //
  Route::get('estadisticas/index', 'EstadisticasController@index')->name('estadisticas.index');
  
  Route::get('estadisticas/cliente/{id}', 'EstadisticasController@cliente')->name('estadisticas.cliente');
  
  Route::post('estadisticas/clientes', 'EstadisticasController@clientes')->name('estadisticas.clientes');
  
  Route::post('estadisticas/productos', 'EstadisticasController@productos')->name('estadisticas.productos');

  Route::get('estadisticas/producto/{id}', 'EstadisticasController@producto')->name('estadisticas.producto');

  Route::post('estadisticas/cajas', 'EstadisticasController@cajas')->name('estadisticas.cajas');

  Route::get('estadistica/caja/{id}/{desde}/{hasta}', 'EstadisticasController@caja')->name('estadisticas.caja');





  Route::get('estadisticas/productosStockCritico', 'EstadisticasController@productosEnStockCritico')->name('estadisticas.productosEnStockCritico');

  Route::get('estadisticas/productosMasVendidos', 'EstadisticasController@productosMasVendidos')->name('estadisticas.productosMasVendidos');

  Route::get('estadisticas/ventas', 'EstadisticasController@indexVentas')->name('estadisticas.indexVentas');

  Route::post('estadisticas/ventasMensual', 'EstadisticasController@VentasMensual')->name('estadisticas.ventasMensual');

  Route::post('estadisticas/ventasDiaria', 'EstadisticasController@VentasDiaria')->name('estadisticas.ventasDiaria');

  // PAGOS //

  Route::get('pagos/index', 'PagosController@index')->name('pagos.index');

  Route::post('pagos/store', 'PagosController@store')->name('pagos.store');

  Route::post('pagos/mixto', 'PagosController@storeMixto')->name('pagos.storeMixto');

  Route::get('pagos/parcial/{id}', 'PagosController@pagoParcial')->name('pagos.parcial');

  Route::post('pagos/parcial/store/{id}', 'PagosController@pagoParcialStore')->name('pagos.parcial.store');

  Route::get('pedido/cerrar/{pedido}', 'PagosController@cerrar')->name('pedidos.cerrar');

  Route::get('pagos/recibos', 'PagosController@recibos')->name('pagos.recibos');

// Comisiones //

  Route::get('comisiones/index', 'ComisionController@index')->name('comisiones.index');

  Route::get('comisiones/global', 'ComisionController@mostrarComisiones')->name('comisiones.global');

  Route::get('comisiones/{vendedor}', 'ComisionController@show')->name('comisiones.show');

  Route::post('comisiones/pagar', 'ComisionController@pagar')->name('comisiones.pagar');

  Route::get('comisiones/imprimir/{vendedor}/{fechaDesde}/{fechaHasta}', 'ComisionController@imprimir')->name('comisiones.imprimir');

  Route::post('comision/store', 'ComisionController@store')->name('comisiones.store');

  Route::post('comision/porcentaje/store', 'ComisionController@guardar')->name('porcentaje.store');

  Route::get('comision/{vendedor}/edit', 'ComisionController@edit')->name('comisiones.edit');

  Route::put('comision/{comision}', 'ComisionController@update')->name('comisiones.update');

  Route::get('comision/imprimir/{desde}/{hasta}', 'ComisionController@imprimiReporte')->name('reporte.comisiones');


  // VENDEDORES //

  Route::get('maquinarias/index', 'MaquinariaController@index')->name('maquinarias.index');

  Route::get('maquinarias/create', 'MaquinariaController@create')->name('maquinarias.create');

  Route::post('maquinarias/store','MaquinariaController@store')->name('maquinarias.store');

  Route::get('maquinarias/showAlquiler/{maquinaria}', 'MaquinariaController@showAlquilarVender')->name('maquinarias.AlquilerVenta');
  
  Route::post('maquinarias/storeAlquiler','MaquinariaController@storeAlquiler')->name('maquinarias.storeAlquiler');

  Route::get('maquinaria/finalizarAlquiler/{maquinaria}','MaquinariaController@finalizarAlquiler')->name('maquinarias.finalizarAlquiler');

  Route::get('maquinaria/imprimirDetalleAlquiler/{alquiler}','MaquinariaController@imprimirDetalleAlquiler')->name('maquinarias.imprimirDetalleAlquiler');

  Route::put('maquinaria/updateAlquiler/{alquiler}','MaquinariaController@updateAlquiler')->name('maquinarias.updateAlquiler');

    // MUNAYS CAJAS//

    Route::get('Munay/cajas', 'MunayController@cajasIndex')->name('munayCajas.index');
    
    Route::post('Munay/Caja/resta/{caja}', 'MunayController@restaCaja')->name('munayCajas.resta');

    Route::post('Munay/Caja/ingresar/{caja}', 'MunayController@sumarCaja')->name('munayCajas.sumar');

    Route::put('Munay/Cajas/abrirCerrar/{caja}', 'MunayController@abrirCerrarCaja')->name('munayCajas.abrirCerrar');

    Route::get('Munay/Caja/abrir/{caja}', 'MunayController@abrirCerrarCaja')->name('munayCajas.abrir');

    Route::get('Munay/Cajas/detalle/{caja}', 'MunayController@cajaDiaria')->name('munayCajas.diaria');

    Route::get('Munay/Pdf/Reporte', 'MunayController@reporteCajaDiario')->name('munay.reporteCajaDiario');

    // MUNAYS PEDIDOS//

    Route::get('Munay/Pedidos/Home', 'MunayController@pedidos')->name('munay.pedidos');

    Route::get('Munay/Pedidos/Clientes', 'MunayController@seleccionarCliente')->name('munay.pedidosClientes');

    Route::get('Munay/Pedidos/create/{cliente}', 'MunayController@createPedido')->name('munay.pedidos.create');

    Route::post('Munay/Pedidos/store', 'MunayController@storePedido')->name('munay.pedidos.store');


    // MUNAYS PRODUCTOS//

    Route::get('Munay/Productos', 'MunayController@productos')->name('munay.productos');
    

    Route::get('Munay/Productos/edit/{producto}', 'MunayController@productosedit')->name('munay.productos.edit');

    Route::put('Munay/Producto/Update/{producto}', 'MunayController@productosupdate')->name('munay.productos.update');
    
    Route::get('Munay/Productos/Detalle/{productos}', 'MunayController@showProductos')->name('munay.productos.show');

    Route::get('Munay/Materias_Primas', 'MunayController@materiasindex')->name('munay.materiales.index');

    Route::post('Munay/Materias_Primas/store', 'MunayController@materiasstore')->name('munay.materiales.store');
  
    Route::post('Munay/Materias_Primas/edit', 'MunayController@materiasupdate')->name('munay.materiales.edit');


    // MUNAYS Clientes //

    Route::get('Munay/Clientes', 'MunayController@clientes')->name('munay.clientes');

    Route::get('Munay/Clientes/create/{condicion}', 'MunayController@clientescreate')->name('munay.clientes.create');

    Route::post('Munay/Clientes/store/', 'MunayController@clientesstore')->name('munay.clientes.store');

    Route::get('Munay/Clientes/detalle/{cliente}', 'MunayController@clientesshow')->name('munay.clientes.show');

    Route::get('Munay/Clientes/edit/{cliente}', 'MunayController@clientesedit')->name('munay.clientes.edit');

    Route::post('Munay/Clientes/update/{cliente}', 'MunayController@clientesupdate')->name('munay.clientes.update');


    // SYNOPSIS CAJAS //

    Route::get('Sinopsys/Productos', 'SinopsysController@productos')->name('Sinopsys.productos');

    Route::get('Sinopsys/Productos/Create', 'SinopsysController@productosCreate')->name('Sinopsys.productos.create');
   
    Route::post('Sinopsys/Productos/store', 'SinopsysController@productostore')->name('Sinopsys.productos.store');

    Route::get('Sinopsys/Productos/edit/{producto}', 'SinopsysController@productosedit')->name('Sinopsys.productos.edit');

    Route::put('Sinopsys/Producto/Update/{producto}', 'SinopsysController@productosupdate')->name('Sinopsys.productos.update');
    
    Route::get('Sinopsys/Productos/Detalle/{productos}', 'SinopsysController@showProductos')->name('Sinopsys.productos.show');


     // APIS  //

     Route::get('api/clientes/pedidos/{cliente}', 'ApiController@showPagosPendientes')->name('showPagosPendientes');



});
