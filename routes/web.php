<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (DB::table('cargo')->count()==0) {
      # code...
      DB::table('cargo')->insert(['cargo'=>'Usuario', 'descripcion'=>'Encargado para ingresar, consultar y reportar.']);
      DB::table('cargo')->insert(['cargo'=>'Administrador', 'descripcion'=>'Encargado para configurar el sistema de acuerdo a sus politicas.']);
    }
    return view('auth.login');//welcome
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('gastronomica/proveedores/proveedores/proveedor', 'Proveedores\ProveedorController@manageItemAjax');
//Route::resource('item-ajax', 'Proveedores\ProveedorController');
Route::resource('gastronomica/proveedores/proveedores/proveedor', 'Proveedores\ProveedorController');
Route::get('gastronomica/proveedores/proveedores/datos','Proveedores\ProveedorController@datos');
Route::get('gastronomica/proveedores/proveedores/datoseditar','Proveedores\ProveedorController@datoseditar');
Route::get('gastronomica/proveedores/proveedores/ver/{prov_id}','Proveedores\ProveedorController@ver');
Route::get('listall', 'Proveedores\ProveedorController@listall');

Route::resource('gastronomica/proveedores/precios/precios', 'Proveedores\PreciosController');
//Route::get('listallget', 'Proveedores\ProveedorController@store');
Route::resource('gastronomica/sombreros/sombreros/sombrero', 'Sombreros\SombreroController');
Route::get('gastronomica/sombreros/sombreros/ver/{somb_id}','Sombreros\SombreroController@ver');
Route::get('gastronomica/sombreros/sombreros/foto/{somb_id}', 'Sombreros\SombreroController@foto');
Route::post('photosombrero','Sombreros\SombreroController@update_photo');

Route::resource('gastronomica/sombreros/modelos/modelo', 'Sombreros\ModeloController');
Route::get('gastronomica/sombreros/modelos/foto/{somb_id}', 'Sombreros\ModeloController@foto');
Route::get('gastronomica/sombreros/modelos/ver/{mod_id}','Sombreros\ModeloController@ver');
Route::post('photomodelo','Sombreros\ModeloController@update_photo');

Route::resource('gastronomica/sombreros/materiales/material', 'Sombreros\MaterialController');
Route::get('gastronomica/sombreros/materiales/foto/{somb_id}', 'Sombreros\MaterialController@foto');
Route::get('gastronomica/sombreros/materiales/ver/{mat_id}','Sombreros\MaterialController@ver');
Route::post('photomaterial','Sombreros\MaterialController@update_photo');

Route::resource('gastronomica/sombreros/tejidos/tejido', 'Sombreros\TejidoController');
Route::get('gastronomica/sombreros/tejidos/foto/{somb_id}', 'Sombreros\TejidoController@foto');
Route::get('gastronomica/sombreros/tejidos/ver/{mat_id}','Sombreros\TejidoController@ver');
Route::post('phototejido','Sombreros\TejidoController@update_photo');

Route::resource('gastronomica/sombreros/tallas/talla', 'Sombreros\TallaController');
Route::resource('gastronomica/sombreros/publicodirigido/publicodirigido', 'Sombreros\PublicoDirigidoController');
Route::resource('gastronomica/sombreros/movimientos/movimiento', 'Sombreros\MovimientoController');
Route::get('gastronomica/sombreros/movimientos/ver/{somb_id}','Sombreros\MovimientoController@ver');

/*Route::get('gastronomica/usuarios/foto/{somb_id}', 'Usuarios\UsuarioController@foto');
Route::post('photousuario','Usuarios\UsuarioController@update_photo');*/

/**Empleados */
Route::resource('gastronomica/sombreros/encargos/encargo', 'Empleados\EncargoController');
Route::resource('gastronomica/sombreros/empleados/empleado', 'Empleados\EmpleadoController');
Route::resource('gastronomica/sombreros/comisionempleado/comision', 'Empleados\EmpleadoComisionController');
Route::get('/ajax-mostrarNombresEmpleados/','Empleados\EmpleadoComisionController@mostrarNombresEmpleados');
Route::get('/ajax-mostrarDatosSombreroComision/{modelo_id}/{tejido_id}/{material_id}/{publico_id}/{talla_id}','Empleados\EmpleadoComisionController@mostrarDatosSombreroComision');
//
Route::get('/ajax-pago/{modelo_id}/{tejido_id}/{material_id}/{publico_id}/{talla_id}', 'Proveedores\PreciosController@mostrarCodigo');
Route::get('/ajax-som/{codSombrero}','Proveedores\PreciosController@ajaxSombrero');

Route::get('/ajax-estados/{codEstado}','Proveedores\ProveedorController@ajaxEstados');
Route::get('/ajax-estadosg/{nombre_titular}/{dni_titular}/{telefono_titular}/{email_titular}/{nombre_segundo}/{dni_segundo}/{telefono_segundo}/{email_segundo}/{empresa}/{ruc}/{direccion}/{numero_cuenta}', 'Proveedores\ProveedorController@ajaxGuardarEstados');

Route::get('gastronomica/sombreros/movimientos/reporte/{somb_id}', 'Sombreros\MovimientoController@reporte');
/*********************COMPRAS*****************/
Route::resource('gastronomica/sombreros/ordencompra/ordencompra', 'Compras\OrdenCompraController');
Route::get('/ajax-verdatos/{modelo_id}/{tejido_id}/{material_id}/{publico_id}/{talla_id}','Compras\OrdenCompraController@mostrarPorModelo');
Route::get('/ajax-OCSomb/{codSombrero}','Compras\OrdenCompraController@mostrarSombrero');
Route::get('/ajax-mostrarCOC/{cod}','Compras\OrdenCompraController@mostrarIdOrden');
Route::get('/ajax-guardarorden/{tipo}/{codigo}/{idProveedor}/{cantidad}/{precio_unitario}/{descripcion}','Compras\OrdenCompraController@guardarOrden');
Route::get('gastronomica/sombreros/ordencompra/ver/{orden_id}','Compras\OrdenCompraController@ver');
Route::get('gastronomica/sombreros/ordencompra/reporte/{orden_id}', 'Compras\OrdenCompraController@reporte');
Route::get('/ajax-mostrarTodoCompras/', 'Reportes\ReporteController@mostrarTodoCompras');
Route::get('/ajax-mostrarCodigoSombreroPorProveedor/{codigo}', 'Compras\OrdenCompraController@mostrarCodigoSombreroPorProveedor');
/******************GUIA INGRESO **************/
Route::resource('gastronomica/sombreros/guiaingreso/guiaingreso', 'Compras\GuiaIngresoController');
Route::get('/ajax-mostrarCGI/{cod}','Compras\GuiaIngresoController@mostrarNumeroGuia');
Route::get('/ajax-guardarguia/{tipo}/{codigo}/{idProveedor}/{cantidad}/{descripcion}/{idOrdenCompraDetalle}','Compras\GuiaIngresoController@guardarGuia');
Route::get('gastronomica/sombreros/guiaingreso/ver/{guia_id}','Compras\GuiaIngresoController@ver');
Route::get('gastronomica/sombreros/guiaingreso/reporte/{guia_id}', 'Compras\GuiaIngresoController@reporte');
Route::get('/ajax-mostrarOrdenCompraDetalles/{idOrdenCompra}', 'Compras\GuiaIngresoController@mostrarOrdenCompraDetalles');
Route::get('/ajax-mostrarDatosSombrero/{idOrdenCompraDetalle}', 'Compras\GuiaIngresoController@mostrarDatosSombrero');
/******************FACTURA*********************/
Route::resource('gastronomica/sombreros/factura/factura', 'Compras\FacturaController');
Route::get('gastronomica/sombreros/factura/factura/{factura_id}','Compras\FacturaController@ver');
Route::get('/ajax-mostrarCF/{cod}','Compras\FacturaController@mostrarNumeroFactura');
Route::get('/ajax-guardarfactura/{tipo}/{codigo}/{idProveedor}/{cantidad}/{precio_unitario}/{comprador}/{usuario}/{descripcion}','Compras\FacturaController@guardarFactura');
Route::get('gastronomica/sombreros/factura/ver/{factura_id}','Compras\FacturaController@ver');
Route::get('gastronomica/sombreros/factura/reporte/{factura_id}', 'Compras\FacturaController@reporte');
/******************VENTAS*********************/
Route::resource('gastronomica/sombreros/ventas/ventas', 'Ventas\VentasController');
Route::get('gastronomica/sombreros/ventas/ver/{venta_id}','Ventas\VentasController@ver');
Route::get('gastronomica/sombreros/ventas/reporte/{venta_id}','Ventas\VentasController@reporte');
Route::get('/ajax-mostrarCOV/{cod}','Ventas\VentasController@mostrarIdVenta');
Route::get('/ajax-guardarventa/{tipo}/{codigo}/{cantidad}/{precio_unitario}/{porcentaje_descuento}/{descuento}/{sub_total}/{usuario}/{utilidad}/{idEmpleado}/{descripcion}','Ventas\VentasController@guardarVenta');
Route::get('/ajax-mostrarTodoVentas/', 'Reportes\ReporteController@mostrarTodoVentas');
/******************REPORTES*********************/
Route::get('gastronomica/sombreros/reportes/compras', 'Reportes\ReporteController@indexCompras');
Route::get('/ajax-vercodigo/{modelo_id}/{tejido_id}/{material_id}/{publico_id}/{talla_id}','Reportes\ReporteController@mostrarCodigo');
Route::get('/ajax-reportePorFecha/{tipo}/{codigo}/{fecha_inicio}/{fecha_fin}','Reportes\ReporteController@reportePorFecha');
Route::get('gastronomica/sombreros/reportes/vercompras/{compra_id}','Reportes\ReporteController@verCompras');
Route::get('gastronomica/sombreros/reportes/comprasver/{compra_id}','Reportes\ReporteController@reporteDescargar');
Route::get('gastronomica/sombreros/reporte_compra','Reportes\ReporteController@reporteGeneralCompras');

Route::get('gastronomica/sombreros/reportes/ventas', 'Reportes\ReporteController@indexVentas');
Route::get('gastronomica/sombreros/reportes/verventas/{venta_id}','Reportes\ReporteController@verVentas');
Route::get('gastronomica/sombreros/reportes/ventasver/{venta_id}','Reportes\ReporteController@ventaDescarga');
Route::get('gastronomica/sombreros/reporte_venta','Reportes\ReporteController@reporteGeneralVentas');
Route::get('reporteUtilidadSombrerosPorCodigo/{codigo}','Reportes\ReporteController@reporteUtilidadSombrerosPorCodigo');

//reporte por ventas por empleado
Route::get('gastronomica/sombreros/reportes/ventasporempleado', 'Reportes\ReporteController@indexVentasPorEmpleado');
Route::get('gastronomica/sombreros/reportes/verventasporempleado/{venta_id}','Reportes\ReporteController@verVentasPorEmpleado');
Route::get('/ajax-reporteVentaPorEmpleado/{idEmpleado}/{fecha_inicio}/{fecha_fin}','Reportes\ReporteController@ventasPorEmpleado');
Route::get('/ajax-reporteVentaPorEmpleadoConsolidado/{idEmpleado}/{fecha_inicio}/{fecha_fin}','Reportes\ReporteController@ventaPorEmpleadoConsolidado');
Route::get('/ajax-numeroVentasPorEmpleadoConsolidado/{idEmpleado}/{fecha_inicio}/{fecha_fin}','Reportes\ReporteController@numeroVentasPorEmpleadoConsolidado');

Route::get('gastronomica/sombreros/reportes/reporteporempleado/{venta_id}','Ventas\VentasController@reporteConComision');
Route::get('gastronomica/sombreros/reportes/reporteporempleados/{venta_id}','Reportes\ReporteController@ventaPorEmpleadoDescarga');
Route::get('reporteventasporempleado/{idEmpleado}/{fecha_inicio}/{fecha_fin}','Reportes\ReporteController@reporteventasporempleado');
/**Utilidades */
Route::get('gastronomica/sombreros/reportes/utilidades', 'Reportes\ReporteController@indexUtilidadesVentas');
Route::get('/ajax-mostrarTodoUtilidadVentas/','Reportes\ReporteController@mostrarTodoUtilidadVentas');
Route::get('gastronomica/sombreros/reporte_utilidad_ventas','Reportes\ReporteController@reporteGeneralUtilidadesVentas');
Route::get('reporteUtilidadesVentasPorFechas/{fecha_inicio}/{fecha_fin}/{codigo_sombrero}','Reportes\ReporteController@reporteUtilidadesVentasPorFechas');


Route::get('gastronomica/sombreros/reportes/utilidadessombreros', 'Reportes\ReporteController@indexUtilidadesSombreros');
Route::get('gastronomica/sombreros/reporte_utilidad_sombreros','Reportes\ReporteController@reporteGeneralUtilidadesSombreros');
Route::get('/ajax-reporteUtilidadSombrerosCodigo/{codigo}','Reportes\ReporteController@reporteUtilidadSombrerosCodigo');
Route::get('/ajax-mostrarTodoUtilidadSombreros/','Reportes\ReporteController@mostrarTodoUtilidadSombreros');
//
Route::get('reporteComprasPorFechas/{fecha_inicio}/{fecha_fin}/{codigo_sombrero}','Reportes\ReporteController@ReporteComprasPorFechas');
Route::get('reporteVentasPorFechas/{fecha_inicio}/{fecha_fin}/{codigo_sombrero}','Reportes\ReporteController@ReporteVentasPorFechas');
/**Consultas* */
//orden de compra
Route::get('gastronomica/sombreros/consultas/ordencompra','Consultas\ConsultaController@indexOrdenCompra');
Route::get('/ajax-indexOrdenCompraConsolidado/{numero_orden}','Consultas\ConsultaController@indexOrdenCompraConsolidado');
Route::get('/ajax-indexOrdenCompraDetalles/{numero_orden}','Consultas\ConsultaController@indexOrdenCompraDetalles');
Route::get("/ajax-guiasIngresoPorOrdenCompraDetalle/{idOrdenCompraDetalle}","Consultas\ConsultaController@guiasIngresoPorOrdenCompraDetalle");
Route::get("/ajax-guiasIngresoPorOrdenCompraDetalleCabecera/{idOrdenCompraDetalle}","Consultas\ConsultaController@guiasIngresoPorOrdenCompraDetalleCabecera");
//orden de compra por proveedor
Route::get('gastronomica/sombreros/consultas/ordencompraproveedor','Consultas\ConsultaController@indexOrdenCompraProveedor');
Route::get('/ajax-ordenCompraProveedorConsolidado/{idProveedor}','Consultas\ConsultaController@ordenCompraProveedorConsolidado');
Route::get('/ajax-ordenCompraDetallesProveedor/{idOrdenCompra}', 'Consultas\ConsultaController@ordenCompraDetallesProveedor');
Route::get('/ajax-numeroOrdenCompra/{idOrdenCompra}', 'Consultas\ConsultaController@numeroOrdenCompra');
//orden de compra por articulo
Route::get('/gastronomica/sombreros/consultas/ordencompraarticulo','Consultas\ConsultaController@indexOrdenCompraArticulo');
Route::get('/ajax-ordenCompraArticuloConsolidado/{codSombrero}','Consultas\ConsultaController@ordenCompraArticuloConsolidado');
/******************USUARIOS*********************/
Route::resource('gastronomica/usuarios/usuario', 'Usuarios\UsuarioController');
/******************FACTURA*********************/
Route::get('/ajax-verCabeceraOrden/{idOrdenCompra}', 'Compras\FacturaController@mostrarCabeceraOrden');
Route::get('/ajax-verOrdenesCompra/{idOrdenCompra}', 'Compras\FacturaController@mostrarOrdenesCompra');
/*Mostrar Imagenes modal*/
Route::get('/ajax-mostrarImagenes/{modelo}/{tejido}/{material}/{publico}/{talla}','Compras\OrdenCompraController@mostrarPorImagen');
//PDF
/*Route::get('pdf', function(){
  $pdf = PDF::loadView('pdf/movimientos');
  //return $pdf->download('archivo.pdf');
  return $pdf->stream();
});*/
