<?php

namespace App\Http\Controllers\Consultas;

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
use App\Models\Cliente;
use Session;
use DB;
use PDF;

class ConsultaController extends Controller
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

    /**Stock Actual */
    public function indexStockActual(){

        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

        $datos = Sombrero::select('sombrero.id', 'sombrero.codigo','sombrero.stock_actual', 'modelos.modelo', 'tejidos.tejido', 
        'materiales.material', 'publicodirigido.publico','tallas.talla','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')->get();

        return view ('gastronomica/sombreros/consultas/articulos/stockactual', array('modelo'=>$modelos, 'tejido'=>$tejidos,
        'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas, 'imagenes'=>$datos));       
    }
    /**Orden de Compra */
    public function indexOrdenCompra(){
        return view ('gastronomica/sombreros/consultas/ordencompra/ordencompra');
    }

    public function indexOrdenCompraConsolidado($numeroOrden){
        $orden = OrdenCompra::select('id')->where('orden_compra.numero_orden','=',$numeroOrden)->first();


        $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->where('orden_compra.id','=',$orden->id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();

        /*$detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.cantidad_ingreso","orden_compra_detalle.precio_unitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra_detalle.idOrdenCompra','=',$id)->get();*/

        return response()->json($datos);
    }

    public function indexOrdenCompraDetalles($numeroOrden){
        $orden = OrdenCompra::select('id')->where('orden_compra.numero_orden','=',$numeroOrden)->first();

        $datos = OrdenCompraDetalle::select("orden_compra_detalle.id","sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.cantidadingreso","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra_detalle.idOrdenCompra','=',$orden->id)->get();

        return response()->json($datos);
    }

    public function guiasIngresoPorOrdenCompraDetalleCabecera($idOrdenCompraDetalle){
        $datos = OrdenCompraDetalle::select(DB::raw("COUNT(*) as cantidad_guia"),
        DB::raw("SUM(guia_ingreso_detalle.cantidad) as cantidad_items"))
        ->join("guia_ingreso_detalle", "guia_ingreso_detalle.idOrdenCompraDetalle","=","orden_compra_detalle.id")
        ->join("guia_ingreso","guia_ingreso.id","guia_ingreso_detalle.idGuiaIngreso")
        ->where("orden_compra_detalle.id","=",$idOrdenCompraDetalle)->get();

        return response()->json($datos);
    }

    public function guiasIngresoPorOrdenCompraDetalle($idOrdenCompraDetalle){
        $datos = OrdenCompraDetalle::select("orden_compra_detalle.cantidad as castidadorden", 
        "guia_ingreso_detalle.cantidad as cantidadingreso","guia_ingreso.numero_guia", "guia_ingreso.fecha", "guia_ingreso_detalle.descripcion")
        ->join("guia_ingreso_detalle", "guia_ingreso_detalle.idOrdenCompraDetalle","=","orden_compra_detalle.id")
        ->join("guia_ingreso","guia_ingreso.id","guia_ingreso_detalle.idGuiaIngreso")
        ->where("orden_compra_detalle.id","=",$idOrdenCompraDetalle)->get();

        return response()->json($datos);
    }

    /*Orden de compra por proveedor*/

    public function indexOrdenCompraProveedor(){
        $proveedor = Proveedor::select("id","empresa", "ruc", "direccion")->get();
        return view ('gastronomica/sombreros/consultas/ordencompra/ordencompraproveedor')->with("proveedores", $proveedor);
    }

    public function ordenCompraProveedorConsolidado($idProveedor,$fecha_inicio,$fecha_fin){
        $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),
        DB::raw('SUM(orden_compra_detalle.cantidadingreso) as ingresos'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')
        ->where('proveedor_precio.idProveedor','=',$idProveedor)->get();

        
        return response()->json($datos);
    }
    

    public function numeroOrdenCompra($idOrdenCompra){
        $datos = OrdenCompra::select("orden_compra.numero_orden")->where("orden_compra.id","=",$idOrdenCompra)->get();
        return response()->json($datos);
    }

    public function ordenCompraDetallesProveedor($idOrdenCompra){
        $datos = OrdenCompraDetalle::select("orden_compra_detalle.id","sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.cantidadingreso","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra_detalle.idOrdenCompra','=',$idOrdenCompra)->get();

        return response()->json($datos);
    }

    /**Ventas por cliente */
    public function indexVentasCliente(){
        $clientes = Cliente::select('id','nombres','dni','direccion','telefono')->get();
        return view ('gastronomica/sombreros/consultas/ventas/ventascliente')->with("clientes", $clientes);        
    }

    public function ventasClienteConsolidado($idCliente,$fecha_inicio,$fecha_fin){
        $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')
          ->where('cliente.id','=',$idCliente)->get();
        return response()->json($datos);
    }

    public function numeroVenta($idVenta){
        $datos = Venta::select("numero_venta")->where("id","=",$idVenta)->get();
        return response()->json($datos);
    }

    public function ventaDetallesCliente($idVenta){
        $datos = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$idVenta)->get();

        return response()->json($datos);
    }

    /**Ventas por vendedor*/

    public function indexVentasVendedor()
    {
        # code...
        $vendedores = Empleado::select('id','nombres','apellidos','dni','direccion','telefono')->get();
        return view('gastronomica/sombreros/consultas/ventas/ventasvendedor')->with("vendedores", $vendedores);
    }

    public function ventasVendedorConsolidado($idVendedor,$fecha_inicio,$fecha_fin){
        $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha","venta.utilidad","venta.comision",
        "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha',"venta.utilidad","venta.comision",
          'empleado.nombres','cliente.nombres')
          ->where('empleado.id','=',$idVendedor)->get();
        return response()->json($datos);
    }

    /**Ventas por cancelacion */
    public function indexVentasCancelacion()
    {
        # code...
        return view('gastronomica/sombreros/consultas/ventas/ventascancelacion');
    }

    public function ventasCancelacionFechas($cancelacion,$fecha_inicio,$fecha_fin)
    {
        # code...
        $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')
          ->where('venta.estadocancelado','=',$cancelacion)->get();
        
        return response()->json($datos);
    }

    /*Orden de compra por articulo */
    public function indexOrdenCompraArticulo(){
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

        /*$imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();*/

        return view ('gastronomica/sombreros/consultas/ordencompra/ordencompraarticulo', array('modelo'=>$modelos, 'tejido'=>$tejidos,
        'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas));
    }
    public function ordenCompraArticuloConsolidado($codigoSombrero,$fecha_inicio,$fecha_fin){
        $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),
          DB::raw('SUM(orden_compra_detalle.cantidadingreso) as ingresos'),'proveedor.empresa')
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
          ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->whereBetween('orden_compra.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')
          ->where('sombrero.codigo','=',$codigoSombrero)->get();
        
        return response()->json($datos);
    }

    public function ordenCompraDetallesArticulo($codigoSombrero){
        $datos = OrdenCompraDetalle::select("orden_compra_detalle.id","sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.cantidadingreso","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('sombrero.codigo','=',$codigoSombrero)->get();

        return response()->json($datos);
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
