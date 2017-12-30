<?php

namespace App\Http\Controllers\Compras;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use Session;
use DB;
use PDF;
use App\User;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $facturas = Factura::select("factura.id", "factura.numero_factura","factura.fecha","factura.comprador",
          "users.name")->join("users","users.id","=","factura.idUsuario")->get();
        //$ordenes = OrdenCompra::all();
        return view('gastronomica/sombreros/factura/factura')->with('facturas', $facturas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Session::flash('save','Eliga el modelo de sombrero, el proveedor e ingresar la cantidad.');
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        $numero_orden = OrdenCompra::pluck('numero_orden','id')->prepend('Seleccione Numero Orden...');
        return view('gastronomica/sombreros/factura/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'numero_orden'=>$numero_orden));
    }

    public function mostrarCabeceraOrden($numero_orden)
    {
      # code...
      $datos = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->where('orden_compra.numero_orden','=',$numero_orden)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();

      return response()->json($datos);
    }

    public function mostrarOrdenesCompra($numero_orden)
    {
      # code...
      $orden = OrdenCompra::select('id')->where('numero_orden','=',$numero_orden)->first();
      $datos = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
      "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
      "orden_compra_detalle.descripcion","proveedor.empresa")
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('orden_compra_detalle.idOrdenCompra','=',$orden->id)->get();

      return response()->json($datos);
    }

    public function mostrarNumeroFactura($cod)
    {
      # code...
      $datos = Factura::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarFactura($tipo,$codigo,$idProveedor,$cantidad,$precio_unitario,
    $comprador,$nombreUsuario,$descripcion)
    {
      # code...

      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = Factura::count();
        $n = ((int)$cant)+1;
        $now = new \DateTime();
        $fecha_anio = ($now->format('Y-m-d'))."";
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $usuario = User::where('name','=',$nombreUsuario)->first();
        if ($cant<1000000) {
          # code...
          if ($n>0 && $n<10) {
            Factura::insert(['numero_factura'=>'001-00000'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
            //la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            Factura::insert(['numero_factura'=>'001-0000'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
          } else if($n>=100 && $n<1000){
            Factura::insert(['numero_factura'=>'001-000'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
          } else if($n>=1000 && $n<10000){
            Factura::insert(['numero_factura'=>'001-00'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
          } else if($n>=10000 && $n<100000){
            Factura::insert(['numero_factura'=>'001-0'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
          } else if($n>=100000 && $n<1000000){
            Factura::insert(['numero_factura'=>'001-'.$n,
            'fecha'=>$fecha_anio, "comprador"=>$comprador, "idUsuario"=>$usuario->id]);
          }
          $facturas = Factura::all()->last();//ultimo registro de la tabla orden _compra
          FacturaDetalle::insert(['idFactura'=>$facturas->id,'idSombrero'=>$sombrero->id,
          'descripcion'=>$descripcion,'precio_unitario'=>$precio_unitario,'cantidad'=>$cantidad,
          'sub_total'=>((int)$precio_unitario)*((int)$cantidad)]);
          Session::flash('save','Se ha guardado correctamente');
        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de facturas');
        }
      } else {//guardar solo en la tabla orden compra detalle
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $facturas = Factura::all()->last();//ultimo registro de la tabla orden _compra
        FacturaDetalle::insert(['idFactura'=>$facturas->id,'idSombrero'=>$sombrero->id,
        'descripcion'=>$descripcion,'precio_unitario'=>$precio_unitario,'cantidad'=>$cantidad,
        'sub_total'=>((int)$precio_unitario)*((int)$cantidad)]);
        Session::flash('save','Se ha guardado correctamente');
      }

      $miFactura = Factura::all()->last();
      //estod datos pasan a la TABLA
      $datos = FacturaDetalle::select("sombrero.codigo","sombrero.photo","factura_detalle.id",
      "factura_detalle.cantidad","factura_detalle.descripcion","factura_detalle.precio_unitario",
      "factura_detalle.sub_total")->join('sombrero','sombrero.id','=','factura_detalle.idSombrero')
      ->where('factura_detalle.idFactura','=',$miFactura->id)->get();

      return response()->json($datos);
    }

    public function ver($id)
    {
      # code...
      $facturas = Factura::select("factura.id", "factura.numero_factura","factura.fecha","factura.comprador",
        "users.name")->join("users","users.id","=","factura.idUsuario")->where('factura.id','=',$id)->first();

      $detalles = FacturaDetalle::select("sombrero.codigo","sombrero.photo","factura_detalle.id",
        "factura_detalle.cantidad","factura_detalle.descripcion","factura_detalle.precio_unitario",
        "factura_detalle.sub_total")->join('sombrero','sombrero.id','=','factura_detalle.idSombrero')
        ->where('factura_detalle.idFactura','=',$id)->get();

      return View('gastronomica.sombreros.factura.ver',array('factura'=>$facturas,'detalles'=>$detalles));
    }

    public function reporte($id)
    {
      # code...
      $facturas = Factura::select("factura.id", "factura.numero_factura","factura.fecha","factura.comprador",
        "users.name")->join("users","users.id","=","factura.idUsuario")->where('factura.id','=',$id)->first();

      $detalles = FacturaDetalle::select("factura_detalle.cantidad", "factura_detalle.descripcion",
      "factura_detalle.precio_unitario", "factura_detalle.sub_total")->where('factura_detalle.idFactura',
      '=',$id)->get();

      $pdf = PDF::loadView('reportes/factura',['factura'=>$facturas,'detalles'=>$detalles]);
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
