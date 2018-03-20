<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Empleado;
use Session;
use DB;
use PDF;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function indexCompras()
    {
      # code...
      $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
      $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
      $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
      $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
      $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
          ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();

      /*$ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();*/
        $imagenes = Sombrero::
        select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
          'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
          'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
          'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
          'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();

      return view ('gastronomica/sombreros/reportes/compras', array('modelo'=>$modelos, 'tejido'=>$tejidos,
      'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'ordenes'=>$ordenes, 'imagenes'=>$imagenes));
    }

    public function indexVentas()
    {
      # code...
      $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
      $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
      $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
      $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
      $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres",
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
      DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
      ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
      ->join("empleado","empleado.id","=","venta.idEmpleado")
      ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();

      $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();

      return view ('gastronomica/sombreros/reportes/ventas', array('modelo'=>$modelos, 'tejido'=>$tejidos,
      'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'ventas'=>$ventas, 'imagenes'=>$imagenes));
    }

    public function indexUtilidadesVentas()
    {
      # code...
      $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
      $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
      $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
      $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
      $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
      DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
      ->join('venta_detalle','venta_detalle.idVenta', '=','venta.id')
      ->join("users","users.id","=","venta.idUsuario")
      ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'users.name', 'venta.utilidad')->get()->take(10);

      $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();

      return view ('gastronomica/sombreros/reportes/utilidades', array('modelo'=>$modelos, 'tejido'=>$tejidos,
      'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'sombreros'=> $ventas, 'imagenes'=>$imagenes));
    }

    public function indexUtilidadesSombreros(){
      $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
      $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
      $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
      $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
      $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

      $sombreros = Sombrero::select('sombrero.codigo','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('sombrero.codigo', 'sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get()->take(10);
      
      $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();

      return view ('gastronomica/sombreros/reportes/utilidadessombreros', array('modelo'=>$modelos, 'tejido'=>$tejidos,
        'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'utilidades'=> $sombreros, 'imagenes'=>$imagenes));
    }

    public function indexVentasPorEmpleado(){
      $empleados = Empleado::select('empleado.id','encargo.nombre as encargo','empleado.nombres',
        'empleado.apellidos','empleado.dni','empleado.direccion','empleado.telefono','empleado.email')
        ->join('encargo','encargo.id','=','empleado.idEncargo')->get()->take(10);
      return view ('gastronomica/sombreros/reportes/ventasporempleado')->with('empleados',$empleados);
    }

    //Ventas por empleado
    public function numeroVentasPorEmpleadoConsolidado($idEmpleado, $fecha_inicio, $fecha_fin){
      $datos = Venta::select(
        DB::raw('count(venta.idEmpleado) as cantidad_venta'))
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('empleado.id','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->get();
      return response()->json($datos);
    }

    public function ventaPorEmpleadoConsolidado($idEmpleado, $fecha_inicio, $fecha_fin){      
      $datos = VentaDetalle::select(
        DB::raw('COUNT(venta.idEmpleado) as cantidad_venta'),
        DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_total'),
        DB::raw('SUM(venta_detalle.sub_total) as total'))
        ->join('venta','venta.id','=','venta_detalle.idVenta')
        ->where('venta.idEmpleado','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->get();
      return response()->json($datos);
    }

    public function ventasPorEmpleado($idEmpleado, $fecha_inicio, $fecha_fin){
      $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
      DB::raw('SUM(venta_detalle.cantidad) as cantidad'),
      DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_empleado'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('empleado.id','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
      return response()->json($datos);
    }

    public function verVentasPorEmpleado($id){
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'),
        DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_empleado'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total","venta_detalle.comisionempleado", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      return View('gastronomica.sombreros.reportes.ventasporempleadover',array('venta'=>$ventas,'detalles'=>$detalles));
    }

    public function reporteventasporempleado($idEmpleado, $fecha_inicio, $fecha_fin){
      $empleado = Empleado::select("nombres")->where('id','=',$idEmpleado)->first();
      $numventas = Venta::select(
        DB::raw('count(venta.idEmpleado) as num_ventas'))
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('empleado.id','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->first();
      
      $datos = VentaDetalle::select(
        DB::raw('COUNT(venta.idEmpleado) as cantidad_venta'),
        DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_total'),
        DB::raw('SUM(venta_detalle.sub_total) as total'))
        ->join('venta','venta.id','=','venta_detalle.idVenta')
        ->where('venta.idEmpleado','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->first();
      
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
      DB::raw('SUM(venta_detalle.cantidad) as cantidad'),
      DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_empleado'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('empleado.id','=',$idEmpleado)
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
      
        $codSombrero = "";
      $pdf = PDF::loadView('reportes/ventasporempleadogeneral',['empleado'=>$empleado,'fechaInicio'=>$fecha_inicio,
      'fechaFin'=>$fecha_fin,'numventas'=>$numventas,'venta'=>$datos,'detalles'=>$ventas, 'codSombrero'=>$codSombrero]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    //

    public function reportePorFecha($tipo,$codigo,$fecha_inicio,$fecha_fin)
    {
      # code...
      if ($tipo==1) {//compras
        # code...
        if ($codigo=="0") {
          # code... sin uso del codigo de sombrero
          $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
          ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();
        } else {
          # con uso del codigo de sombrero
          $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
          ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->where('sombrero.codigo', '=', $codigo)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();
        }
        

        /*$datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();*/
      } else if($tipo==2){//ventas
        # code...
        if ($codigo=="0") {
          # code...
          $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          //->join("users","users.id","=","venta.idUsuario")
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
        } else {
          $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          //->join("users","users.id","=","venta.idUsuario")
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->where('sombrero.codigo', '=', $codigo)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
        }
      } else if($tipo==3){//utilidades
        if ($codigo=="0") {
          # code...
          $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta', '=','venta.id')
          ->join("users","users.id","=","venta.idUsuario")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'users.name', 'venta.utilidad')->get();
        } else {
          $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          ->join("users","users.id","=","venta.idUsuario")
          ->where('sombrero.codigo', '=', $codigo)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();
        }
        /*$datos = Sombrero::select('venta_detalle.idVenta','sombrero.codigo','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo', DB::raw('SUM(venta_detalle.utilidad) as utilidad'))
          ->join('venta_detalle','venta_detalle.idSombrero','=','sombrero.id')
          ->join('venta','venta.id','=','venta_detalle.idVenta')
          ->join('modelos','modelos.id','=','sombrero.idModelo')->join('tejidos','tejidos.id','=',
          'sombrero.idTejido')->join('materiales','materiales.id','=','sombrero.idMaterial')
          ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
          ->join('tallas','tallas.id','=','sombrero.idTalla')->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('sombrero.codigo','venta_detalle.idVenta','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
            'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
            'sombrero.utilidad','sombrero.photo')->get();*/
      }
      return response()->json($datos);
    }

    public function mostrarCodigo($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code..

      $modelo = Modelos::select('modelo')->where('modelos.id','=',$modelo_id)->first();
      $tejido = Tejidos::select('tejido')->where('tejidos.id','=',$tejido_id)->first();
      $material = Materiales::select('material')->where('materiales.id','=',$material_id)->first();
      $publicosdirigido = PublicoDirigido::select('publico')->where('publicodirigido.id','=',$publico_id)->first();
      $tallas = Tallas::select('talla')->where('tallas.id','=',$talla_id)->first();
      
      $codigo = substr($modelo->modelo,0,3).substr($tejido->tejido,0,3).substr($material->material,0,3).substr($publicosdirigido->publico,0,3).substr($tallas->talla,0,3);
      $codigo = strtolower($codigo);
      $datos = Sombrero::select('codigo')->where('sombrero.codigo','=',$codigo)->get();
      
      /*$datos = Sombrero::select('codigo')
      ->where('sombrero.idTalla','=',$talla_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->get();*/
      
      /*$datos = Sombrero::select('codigo')
      ->where('sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idTalla','=',$talla_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->get();*/

      //echo(strtolower($codigo)); strtolower(substr($modelo->modelo,0,3))
      return response()->json($datos);
    }

    public function mostrarGaleria($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id){
      
      
      $servicio = '';
      if($modelo_id==0){
        $modelo = '';
        $servicio = $servicio.$modelo.'%';
      } else {
        $modelo = Modelos::select('modelo')->where('modelos.id','=',$modelo_id)->first();
        $servicio = $servicio.strtolower(substr($modelo->modelo,0,3)).'%';
      }
      if($tejido_id==0){
        $tejido = '';
        $servicio = $servicio.$tejido.'%';
      } else {
        $tejido = Tejidos::select('tejido')->where('tejidos.id','=',$tejido_id)->first();
        $servicio = $servicio.strtolower(substr($tejido->tejido,0,3)).'%';
      }
      if($material_id==0){
        $material = '';
        $servicio = $servicio.$material.'%';
      } else {
        $material = Materiales::select('material')->where('materiales.id','=',$material_id)->first();
        $servicio = $servicio.strtolower(substr($material->material,0,3)).'%';
      }
      if($publico_id==0){
        $publicosdirigido = '';
        $servicio = $servicio.$publicosdirigido.'%';
      } else {
        $publicosdirigido = PublicoDirigido::select('publico')->where('publicodirigido.id','=',$publico_id)->first();
        $servicio = $servicio.strtolower(substr($publicosdirigido->publico,0,3)).'%';        
      }
      if($talla_id==0){
        $tallas = '';
        $servicio = $servicio.$tallas;
      } else {
        $tallas = Tallas::select('talla')->where('tallas.id','=',$talla_id)->first();
        $servicio = $servicio.strtolower(substr($tallas->talla,0,3)); 
      }
      //echo($servicio);
      //xq tu ni me miras 
      
      $datos = Sombrero::select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
        'publicodirigido.publico','tallas.talla','sombrero.stock_actual','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->where('sombrero.codigo','like',$servicio)
        ->get();

      return response()->json($datos);
    }

    public function verCompras($id)
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->first();

      /*$ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->where('orden_compra.id','=',$id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->first();*/

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
      "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
      "orden_compra_detalle.descripcion","proveedor.empresa")
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('orden_compra_detalle.idOrdenCompra','=',$id)->get();

      return View('gastronomica.sombreros.reportes.comprasver',array('orden'=>$ordenes,'detalles'=>$detalles));
    }

    public function verVentas($id)
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      return View('gastronomica.sombreros.reportes.ventasver',array('venta'=>$ventas,'detalles'=>$detalles));
    }

    public function reporteDescargar($id)
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->where('orden_compra.id','=',$id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->first();

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra_detalle.idOrdenCompra','=',$id)->get();

      $pdf = PDF::loadView('reportes/ordencompra',['orden'=>$ordenes,'detalles'=>$detalles]);
      return $pdf->download('reporte_compra.pdf');
    }

    public function ventaDescarga($id)
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha",
        "users.name", DB::raw('SUM(venta_detalle.sub_total) as precio_total'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("users","users.id","=","venta.idUsuario")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

        $pdf = PDF::loadView('reportes/ventas',['venta'=>$ventas,'detalles'=>$detalles]);
        $pdf->setPaper('a4','landscape');//orientacion horizontal
        return $pdf->download('reporte_venta.pdf');
    }

    public function ventaPorEmpleadoDescarga($id){
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'),
        DB::raw('SUM((venta_detalle.comisionempleado/100.00)*venta_detalle.precio_venta*venta_detalle.cantidad) as comision_empleado'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total","venta_detalle.comisionempleado", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      $pdf = PDF::loadView('reportes/ventasporempleado',['venta'=>$ventas,'detalles'=>$detalles]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->download('reporte_venta.pdf');
    }

    public function reporteGeneralCompras()
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();

      /*$ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();*/

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')->get();

      $fecha_inicio = "";
      $fecha_fin = "";
      $codigo = "";
      $codigoSomb = "";
      $pdf = PDF::loadView('reportes/ordencomprageneral',['ordenes'=>$ordenes,'detalles'=>$detalles,
      'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_fin,'codigo'=>$codigo, 'codSombrero'=>$codigoSomb]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      //$font = Font_Metrics::get_font("helvetica", "bold"); 
      //$pdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
      return $pdf->stream();
    }

    public function reporteGeneralVentas()
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();

      $detalles = VentaDetalle::select("venta_detalle.id","venta_detalle.idVenta","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")->get();

      $fecha_inicio = "";
      $fecha_fin = "";
      $codigo = "";
      $codigoSomb = "";
      $pdf = PDF::loadView('reportes/ordenventageneral',['ventas'=>$ventas,'detalles'=>$detalles,
      'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_fin,'codigo'=>$codigo, 'codSombrero'=>$codigoSomb]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    /*public function reporteGeneralUtilidades()
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
      DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
      ->join('venta_detalle','venta_detalle.idVenta', '=','venta.id')
      ->join("users","users.id","=","venta.idUsuario")
      ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'users.name', 'venta.utilidad')->get();

      $now = new \DateTime();
      $fecha = $now->format('Y-m-d H:i:s');

      $pdf = PDF::loadView('reportes/utilidadesventas',['detalles'=>$ventas, 'fecha'=>$fecha]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }*/

    public function reporteGeneralUtilidadesSombreros(){
      $detalles = Sombrero::select('sombrero.codigo','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('sombrero.codigo', 'sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get();
      
      $now = new \DateTime();
      $fecha = $now->format('Y-m-d H:i:s');
      $pdf = PDF::loadView('reportes/utilidadessombreros',['utilidades'=>$detalles,'fecha'=>$fecha]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    public function reporteUtilidadSombrerosCodigo($codigo) {
      $datos = Sombrero::select('sombrero.codigo','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.codigo','=',$codigo)
        ->groupBy('sombrero.codigo', 'sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get();

      return response()->json($datos);
    }

    public function mostrarTodoUtilidadSombreros(){
      $datos = Sombrero::select('sombrero.codigo','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('sombrero.codigo', 'sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get();

      return response()->json($datos);
    }

    function reporteUtilidadSombrerosPorCodigo($codigo){
      $datos = Sombrero::select('sombrero.codigo','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.codigo','=',$codigo)
        ->groupBy('sombrero.codigo', 'sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get();
      
      $now = new \DateTime();
      $fecha = $now->format('Y-m-d H:i:s');
      $pdf = PDF::loadView('reportes/utilidadessombreros',['utilidades'=>$datos,'fecha'=>$fecha]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    public function mostrarTodoUtilidadVentas(){
      $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", "venta.utilidad",
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("users","users.id","=","venta.idUsuario")
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name', "venta.utilidad")->get();

      return response()->json($datos);
    }

    public function reporteGeneralUtilidadesVentas(){
      $detalles = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("users","users.id","=","venta.idUsuario")
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name', 'venta.utilidad')->get();
      $now = new \DateTime();
      $fecha = $now->format('Y-m-d H:i:s');
      $codigo = "";
      $pdf = PDF::loadView('reportes/utilidadesventas',['detalles'=>$detalles,'fecha'=>$fecha, 'codigo'=>$codigo]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    /**
     * Reporte Por comprasPorFechas
     */

    public function ReporteComprasPorFechas($fecha_inicio,$fecha_fin, $codigo_sombrero)
    {
      # code...
      $codigo = "";
      $codigoSomb = "";
      if ($codigo_sombrero=="0") {
        # code...sin uso del codigo de sombrero
        $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();

        $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa",'orden_compra.fecha')
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])->get();

      } else {
        $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('sombrero.codigo', '=', $codigo_sombrero)
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();

        $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa",'orden_compra.fecha')
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])->get();

        $codigoSomb = $codigo_sombrero;
        $codigo = "// Articulo: ".$codigo_sombrero." // ";
      }

      /*$ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();*/

      

      //echo($ordenes.'<br/>');
      //echo($detalles);
      $pdf = PDF::loadView('reportes/ordencomprageneral',['ordenes'=>$ordenes,'detalles'=>$detalles,
        'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_fin, 'codigo'=>$codigo, 'codSombrero'=>$codigoSomb]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    function reporteVentasPorFechas($fecha_inicio,$fecha_fin, $codigo_sombrero) {
      $codigo = "";
      $codigoSom = "";
      if ($codigo_sombrero=="0") {
        # code...
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
        
          $detalles = VentaDetalle::select("venta_detalle.id","venta_detalle.idVenta","sombrero.codigo", "sombrero.photo",
          "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
          "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
          ->join('venta','venta.id','=','venta_detalle.idVenta')
          ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->get();

        /*$detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
          "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
            "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
            ->join('venta','venta.id','=','venta_detalle.idVenta')
            ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
            ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])->get();*/
      } else {
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->where('sombrero.codigo', '=', $codigo_sombrero)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();
      
        $detalles = VentaDetalle::select("venta_detalle.id","venta_detalle.idVenta","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join('venta','venta.id','=','venta_detalle.idVenta')
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])->get();

        $codigoSom = $codigo_sombrero;

        $codigo = "// Articulo: ".$codigo_sombrero." // ";
      }
      
  
     

      $pdf = PDF::loadView('reportes/ordenventageneral',['ventas'=>$ventas,'detalles'=>$detalles,
        'fecha_inicio'=>$fecha_inicio,'fecha_fin'=>$fecha_fin, 'codigo'=>$codigo, 'codSombrero'=>$codigoSom]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    public function mostrarTodoCompras(){
      $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();
      return response()->json($datos);
    }

    public function mostrarTodoVentas()
    {
      # code...
      $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("users","users.id","=","venta.idUsuario")
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();
      return response()->json($datos);
    }

    public function reporteUtilidadesVentasPorFechas($fecha_inicio,$fecha_fin, $codigo_sombrero){
      $codigo = "";
      if ($codigo_sombrero=="0") {
        # code...
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
            ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
            ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
            ->join("users","users.id","=","venta.idUsuario")
            ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
            ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name','venta.utilidad')->get();
      } else {
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 'venta.utilidad',
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
            ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
            ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
            ->join("users","users.id","=","venta.idUsuario")
            ->where('sombrero.codigo', '=', $codigo_sombrero)
            ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
            ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name','venta.utilidad')->get();
        $codigo = "// Articulo: ".$codigo_sombrero." // ";
      }
      
      
      $now = new \DateTime();
      $fecha = $now->format('Y-m-d H:i:s');
      
      $pdf = PDF::loadView('reportes/utilidadesventas',['detalles'=>$ventas, 'fecha'=>$fecha, 'codigo'=>$codigo]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      //$font = Font_Metrics::get_font("helvetica", "bold"); 
      //$pdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
      return $pdf->stream();
      
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
