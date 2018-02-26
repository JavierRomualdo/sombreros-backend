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
use App\Models\GuiaIngreso;
use App\Models\GuiaIngresoDetalle;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use Session;
use DB;
use PDF;

class GuiaIngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
        DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
        DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
        ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
        ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->get();
        
        return view('gastronomica/sombreros/guiaingreso/guiaingreso')->with('guias', $guias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Session::flash('save','Eliga Orden de Compra e ingresar la cantidad.');
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');

        /*Ordenes de Compra*/
        $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.precio_unitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'),'proveedor.empresa')
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
          ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha','proveedor.empresa')->get();
        
        return view('gastronomica/sombreros/guiaingreso/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas, 'ordenes'=>$ordenes));
    }

    public function mostrarOrdenCompraDetalles($idOrdenCompra){
      $datos = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.id",
      "orden_compra_detalle.idOrdenCompra", "orden_compra_detalle.cantidad_ingreso",
      "orden_compra_detalle.cantidad","orden_compra_detalle.precio_unitario",
      "orden_compra_detalle.descripcion","proveedor.empresa")
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('orden_compra_detalle.idOrdenCompra','=',$idOrdenCompra)->get();

      return response()->json($datos);
    }

    public function mostrarDatosSombrero($idOrdenCompraDetalle){
      $datos = OrdenCompraDetalle::select("orden_compra.numero_orden","orden_compra_detalle.id","orden_compra_detalle.cantidad", 
      "orden_compra_detalle.cantidad_ingreso", "sombrero.codigo", 
      "sombrero.photo", "modelos.modelo", 'tejidos.tejido', "materiales.material", "publicodirigido.publico", 
      "tallas.talla", "proveedor.id as id_proveedor", "proveedor.empresa", "proveedor_precio.precio", "sombrero.stock_actual")
      ->join('orden_compra', 'orden_compra.id','orden_compra_detalle.idOrdenCompra')
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('modelos', 'modelos.id','=','sombrero.idModelo')
      ->join('tejidos', 'tejidos.id','=','sombrero.idTejido')
      ->join('materiales','materiales.id','=','sombrero.idMaterial')
      ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
      ->join('tallas','tallas.id','=','sombrero.idTalla')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('orden_compra_detalle.id','=',$idOrdenCompraDetalle)->get();

      return response()->json($datos);
    }

    public function mostrarNumeroGuia($cod)
    {
      # code...
      $datos = GuiaIngreso::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarGuia($tipo,$codigo,$idProveedor,$cantidad,$descripcion,$idOrdenCompraDetalle)
    {
      # code...
      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = GuiaIngreso::count();
        $n = ((int)$cant)+1;
        $now = new \DateTime();
        $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
        $anio = substr($año,2,2);
        $fecha_anio = ($now->format('Y-m-d'))."";
        if ($cant<10000) {
          # code...
          if ($n>0 && $n<10) {
            GuiaIngreso::insert(['numero_guia'=>'GI-000'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'idProveedor'=>$idProveedor]);//la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            GuiaIngreso::insert(['numero_guia'=>'GI-00'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'idProveedor'=>$idProveedor]);
          } else if($n>=100 && $n<1000){
            GuiaIngreso::insert(['numero_guia'=>'GI-0'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'idProveedor'=>$idProveedor]);
          } else if($n>=1000 && $n<10000){
            GuiaIngreso::insert(['numero_guia'=>'GI-'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'idProveedor'=>$idProveedor]);
          }
          $guias = GuiaIngreso::all()->last();//ultimo registro de la tabla orden _compra
          if ($descripcion=="0") {//No hay descripcion
            # code...
            GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idOrdenCompraDetalle'=>$idOrdenCompraDetalle,
             'cantidad'=>$cantidad]);
          } else {//Si hay descripcion
            GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idOrdenCompraDetalle'=>$idOrdenCompraDetalle,
             'cantidad'=>$cantidad, 'descripcion'=>$descripcion]);
          }
          Session::flash('save','Se ha guardado correctamente');
        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
      } else {//guardar solo en la tabla orden compra detalle
        $guias = GuiaIngreso::all()->last();//ultimo registro de la tabla orden _compra
        if ($descripcion=="0") {
          # code...
          GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idOrdenCompraDetalle'=>$idOrdenCompraDetalle,
             'cantidad'=>$cantidad]);
        } else {
          GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idOrdenCompraDetalle'=>$idOrdenCompraDetalle,
             'cantidad'=>$cantidad, 'descripcion'=>$descripcion]);
        }
        Session::flash('save','Se ha guardado correctamente');
      }

      //Modificamos el stock actual del sombrero **
      $sombrero = Sombrero::where('codigo','=',$codigo)->first();
      Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$cantidad+$sombrero->stock_actual]);

      //Modificamos la OrdenCompraDetalle
      $orden_compra_detalle = OrdenCompraDetalle::select('cantidad_ingreso', 'cantidad')->where('id',$idOrdenCompraDetalle)->first();
      $cantidad_nueva = ($orden_compra_detalle->cantidad_ingreso + $cantidad);
      if ($cantidad_nueva==$orden_compra_detalle->cantidad) {
        # code...
         OrdenCompraDetalle::where('id',$idOrdenCompraDetalle)->update(['cantidad_ingreso'=>$cantidad_nueva, 'estado_ingreso'=>'Ingresado']);
      } else if($cantidad_nueva < $orden_compra_detalle->cantidad){
         OrdenCompraDetalle::where('id',$idOrdenCompraDetalle)->update(['cantidad_ingreso'=>$cantidad_nueva, 'estado_ingreso'=>'Falta Ingresar']);
      }

      $guiaDeIngreso = GuiaIngreso::all()->last();
      //estod datos pasan a la TABLA
      $datos = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('guia_ingreso_detalle.idGuiaIngreso','=',$guiaDeIngreso->id)->get();

      return response()->json($datos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function ver($id)
     {
       # code...
       $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
       DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
       DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
       ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
       ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
       ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
       ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
       ->where('guia_ingreso.id','=',$id)
       ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->first();

      $detalles = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();

         /*$detalles = GuiaIngresoDetalle::select("sombrero.codigo","sombrero.photo","guia_ingreso_detalle.idGuiaIngreso",
           "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.descripcion")
           ->join('sombrero','sombrero.id','=','guia_ingreso_detalle.idSombrero')
           ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
           ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();*/

       return View('gastronomica.sombreros.guiaingreso.ver',array('guia'=>$guias,'detalles'=>$detalles));
     }

     public function reporte($id)
     {
       # code...
       $guias = GuiaIngreso::select("guia_ingreso.numero_guia", "guia_ingreso.fecha",
       DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
       DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
       ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
       ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
       ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
       ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
       ->where('guia_ingreso.id','=',$id)
       ->groupBy('guia_ingreso.numero_guia','guia_ingreso.fecha')->first();
       
       $detalles = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();

       $pdf = PDF::loadView('reportes/guiaingreso',['guia'=>$guias,'detalles'=>$detalles]);
       $pdf->setPaper('a4','landscape');//orientacion horizontal
       return $pdf->stream();
     }

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
