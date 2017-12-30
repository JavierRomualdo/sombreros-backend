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
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();

      return view ('gastronomica/sombreros/reportes/compras', array('modelo'=>$modelos, 'tejido'=>$tejidos,
      'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'ordenes'=>$ordenes));
    }

    public function indexVentas()
    {
      # code...
      $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
      $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
      $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
      $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
      $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name",
      DB::raw('SUM(venta_detalle.sub_total) as precio_total'))->join('venta_detalle','venta_detalle.idVenta',
      '=','venta.id')->join("users","users.id","=","venta.idUsuario")->groupBy('venta.id',
      'venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();

      return view ('gastronomica/sombreros/reportes/ventas', array('modelo'=>$modelos, 'tejido'=>$tejidos,
      'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'ventas'=>$ventas));
    }

    public function indexUtilidades()
    {
      # code...

      $sombreros = Sombrero::select('venta_detalle.idVenta','sombrero.codigo','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo', DB::raw('SUM(venta_detalle.utilidad) as utilidad'))
        ->join('venta_detalle','venta_detalle.idSombrero','=','sombrero.id')
        ->join('venta','venta.id','=','venta_detalle.idVenta')
        ->join('modelos','modelos.id','=','sombrero.idModelo')->join('tejidos','tejidos.id','=',
        'sombrero.idTejido')->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('sombrero.codigo','venta_detalle.idVenta','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->paginate(5);

      return view ('gastronomica/sombreros/reportes/utilidades')->with('sombreros', $sombreros);
    }

    public function reportePorFecha($tipo,$codigo,$fecha_inicio,$fecha_fin)
    {
      # code...
      if ($tipo==1) {//compras
        # code...
        $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();
      } else if($tipo==2){//ventas
        # code...
        $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha",
          "users.name", DB::raw('SUM(venta_detalle.sub_total) as precio_total'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("users","users.id","=","venta.idUsuario")
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();
      } else if($tipo==3){
        $datos = Sombrero::select('venta_detalle.idVenta','sombrero.codigo','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
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
            'sombrero.utilidad','sombrero.photo')->get();
      }
      return response()->json($datos);
    }

    public function mostrarCodigo($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code..
      $datos = Sombrero::select('codigo')
      ->where('sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idTalla','=',$talla_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->get();

      return response()->json($datos);
    }

    public function verCompras($id)
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

      return View('gastronomica.sombreros.reportes.comprasver',array('orden'=>$ordenes,'detalles'=>$detalles));
    }

    public function verVentas($id)
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
        return $pdf->download('reporte_venta.pdf');
    }

    public function reporteGeneralCompras()
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')->get();

      $pdf = PDF::loadView('reportes/ordencomprageneral',['ordenes'=>$ordenes,'detalles'=>$detalles]);
      return $pdf->stream();
    }

    public function reporteGeneralVentas()
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha",
        "users.name", DB::raw('SUM(venta_detalle.sub_total) as precio_total'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("users","users.id","=","venta.idUsuario")
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();

      $detalles = VentaDetalle::select("venta_detalle.id","venta_detalle.idVenta","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")->get();

      $pdf = PDF::loadView('reportes/ordenventageneral',['ventas'=>$ventas,'detalles'=>$detalles]);
      return $pdf->stream();
    }

    public function reporteGeneralUtilidades()
    {
      # code...
      $detalles = Sombrero::select('venta_detalle.idVenta','sombrero.codigo','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
        'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
        'sombrero.utilidad','sombrero.photo', DB::raw('SUM(venta_detalle.utilidad) as utilidad'))
        ->join('venta_detalle','venta_detalle.idSombrero','=','sombrero.id')
        ->join('venta','venta.id','=','venta_detalle.idVenta')
        ->join('modelos','modelos.id','=','sombrero.idModelo')->join('tejidos','tejidos.id','=',
        'sombrero.idTejido')->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('sombrero.codigo','venta_detalle.idVenta','venta.fecha','sombrero.id','modelos.modelo','tejidos.tejido','materiales.material',
          'publicodirigido.publico','tallas.talla','proveedor_precio.precio','sombrero.precio_venta','sombrero.stock_actual',
          'sombrero.utilidad','sombrero.photo')->get();

      $pdf = PDF::loadView('reportes/utilidadesgeneral',['detalles'=>$detalles]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
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
