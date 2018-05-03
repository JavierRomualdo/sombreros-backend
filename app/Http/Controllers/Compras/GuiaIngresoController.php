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
use App\Models\Atributos;
use App\Models\Precios;
use App\Models\Movimiento;
use App\Models\PedidoReposicion;
use App\Models\PedidoReposicionDetalle;
use App\Models\ProveedorPrecio;
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
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
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
          DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'))
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
          ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();
        
        return view('gastronomica/sombreros/guiaingreso/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas, 'ordenes'=>$ordenes));
    }

    public function mostrarOrdenCompraDetalles($idOrdenCompra){
      $datos = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.id",
      "orden_compra_detalle.idOrdenCompra", "orden_compra_detalle.cantidadingreso",
      "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
      "orden_compra_detalle.descripcion","proveedor.empresa")
      ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
      ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('orden_compra_detalle.idOrdenCompra','=',$idOrdenCompra)->get();

      return response()->json($datos);
    }

    public function mostrarDatosSombrero($idOrdenCompraDetalle){
      $datos = OrdenCompraDetalle::select("orden_compra.numero_orden","orden_compra_detalle.id","orden_compra_detalle.cantidad", 
      "orden_compra_detalle.cantidadingreso", "sombrero.codigo", 
      "sombrero.photo", "modelos.modelo", 'tejidos.tejido', "materiales.material", "publicodirigido.publico", 
      "tallas.talla", "proveedor.id as id_proveedor", "proveedor.empresa", "proveedor_precio.precio", "sombrero.stock_actual")
      ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
      ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->join('orden_compra', 'orden_compra.id','orden_compra_detalle.idOrdenCompra')
      ->join('modelos', 'modelos.id','=','sombrero.idModelo')
      ->join('tejidos', 'tejidos.id','=','sombrero.idTejido')
      ->join('materiales','materiales.id','=','sombrero.idMaterial')
      ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
      ->join('tallas','tallas.id','=','sombrero.idTalla')
      ->where('orden_compra_detalle.id','=',$idOrdenCompraDetalle)->get();

      return response()->json($datos);
    }

    public function mostrarNumeroGuia($cod)
    {
      # code...
      $datos = GuiaIngreso::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarGuia($tipo,$codigo,$cantidad,$descripcion,$idOrdenCompraDetalle)
    {
      # code...
      $now = new \DateTime();
      $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
      $anio = substr($año,2,2);
      $fecha_anio = ($now->format('Y-m-d'))."";
      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = GuiaIngreso::count();
        $n = ((int)$cant)+1;
        
        if ($cant<10000) {
          # code...
          if ($n>0 && $n<10) {
            GuiaIngreso::insert(['numero_guia'=>'GI-000'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);//la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            GuiaIngreso::insert(['numero_guia'=>'GI-00'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=100 && $n<1000){
            GuiaIngreso::insert(['numero_guia'=>'GI-0'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=1000 && $n<10000){
            GuiaIngreso::insert(['numero_guia'=>'GI-'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
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

      $sombrero = Sombrero::where('codigo','=',$codigo)->first();
      

      //Modificamos la OrdenCompraDetalle
      $orden_compra_detalle = OrdenCompraDetalle::select('cantidadingreso', 'cantidad', 'costounitario')->where('id',$idOrdenCompraDetalle)->first();
      $cantidad_nueva = ($orden_compra_detalle->cantidadingreso + $cantidad);
      if ($cantidad_nueva==$orden_compra_detalle->cantidad) {
        # code...
         OrdenCompraDetalle::where('id',$idOrdenCompraDetalle)->update(['cantidadingreso'=>$cantidad_nueva, 'estadoingreso'=>'Ingresado']);
      } else if($cantidad_nueva < $orden_compra_detalle->cantidad){
         OrdenCompraDetalle::where('id',$idOrdenCompraDetalle)->update(['cantidadingreso'=>$cantidad_nueva, 'estadoingreso'=>'Falta Ingresar']);
      }

      /*Ingresamos movimiento*/

      $parametros = Atributos::first();
      $stockactual = $sombrero->stock_actual + $cantidad;
      $valoranterior = $sombrero->costo_promedio * $sombrero->stock_actual;
      $valor = ($orden_compra_detalle->costounitario * $cantidad) + $valoranterior;
      $costopromedio = $valor / $stockactual;
      Movimiento::insert(['idSombrero'=>$sombrero->id,'cantidadingreso'=>$cantidad,'costounitario'=>$orden_compra_detalle->costounitario,
      'costototal'=>$cantidad * $orden_compra_detalle->costounitario,'stock_actual'=>$stockactual,'valor'=>$valor,'costopromedio'=>$costopromedio,
      'margenganancia'=>$parametros->margenganancia,'preciosistema'=>($costopromedio / ($parametros->margenganancia/100.00)), 'fecha'=>$fecha_anio]);
      
      //Modificamos el stock actual del sombrero **
      Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$stockactual,'costo_promedio'=>$costopromedio,
      'precio_venta'=>($costopromedio / ($parametros->margenganancia/100.00)),'precio_lista'=>($costopromedio / ($parametros->margenganancia/100.00))]);
      //Nota: quisas hay que verificar en los pedidos de reposicion y desactivar el pedido de reposicion de este sombrero
      
      /*Fin Movimiento*/

      /**------------- PEDIDO REPOSICION------- */
      $pedidosreposicion = PedidoReposicion::where('estado','=','A')->get();
      if($pedidosreposicion != ''){//si hay pedido de reposicion

        $preciostodo = ProveedorPrecio::where('idSombrero','=',$sombrero->id)->get();
        $pedidoreposicion_id = 0;
        $cantidadingreso = 0;
        foreach($pedidosreposicion as $pd){
          foreach($preciostodo as $p){
            if($pd->idProveedorPrecio == $p->id) {
              $pedidoreposicion_id =  $pd->id;
              $cantidadingreso = $pd->cantidadingresado;
            }
          }
        }

        if($pedidoreposicion_id!=0){//si hay pedido reposicion detalle del sombrero
          $cantidadingresado = $cantidadingreso + $cantidad;
          if($cantidadingresado <= $sombrero->stock_minimo){//estado = A
            PedidoReposicion::where('id',$pedidoreposicion_id)->update(['cantidadingresado'=>$cantidadingresado]);
          } else {//estado = N
            PedidoReposicion::where('id',$pedidoreposicion_id)->update(['estado'=>'N','cantidadingresado'=>$cantidadingresado]);
          }
        }
      }
      /**------------- FIN PE REPOSICION------- */
      //----tabla precios
      $precios = Precios::select('id','stock')->where('idSombrero','=',$sombrero->id,'and','precio','=',$orden_compra_detalle->costounitario)->first();
      if($precios==""){
        $atributo = Atributos::select('igv','margenganancia')->first();
        $precio_con_igv = $orden_compra_detalle->costounitario * ($atributo->igv / 100.00);
        $precio_con_margenganancia = $orden_compra_detalle->costounitario * ($atributo->margenganancia / 100.00);
        //$precios_con_servicios = $orden_compra_detalle->costounitario * ($atributo->gastosservicios / 100.00);
        $precio_venta = $orden_compra_detalle->costounitario + $precio_con_igv + $precio_con_margenganancia;// + $precios_con_servicios;
        Precios::insert(['idSombrero'=>$sombrero->id,'stock'=>$cantidad,'costo'=>$orden_compra_detalle->costounitario, 'precio'=>$precio_venta]);
      } else {
        Precios::where('id',$precios->id)->update(['stock'=>($precios->stock + $cantidad)]);
      }
      //--------

      $guiaDeIngreso = GuiaIngreso::all()->last();
      //estod datos pasan a la TABLA
      $datos = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
      ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
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
       ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
       ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
       ->where('guia_ingreso.id','=',$id)
       ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->first();

      $detalles = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
      ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
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
       ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
       ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
       ->where('guia_ingreso.id','=',$id)
       ->groupBy('guia_ingreso.numero_guia','guia_ingreso.fecha')->first();
       
       $detalles = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
      ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();

       $pdf = PDF::loadView('reportes/guiaingreso',['guia'=>$guias,'detalles'=>$detalles]);
       $pdf->setPaper('a4','landscape');//orientacion horizontal
       return $pdf->stream();
     }

    public function guiasIngreso($codSombrero, $fecha_inicio,$fecha_fin){
      $datos = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
        DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
        DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
        ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
        ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.id','=',$codSombrero)
        ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->get();

      return response()->json($datos);
    }

    public function guiasIngresoPorArticulo($fecha_inicio,$fecha_fin){
      $datos = GuiaIngreso::select("sombrero.id","sombrero.codigo","sombrero.photo","guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
        DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
        DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'), "sombrero.id")
        ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
        ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy("sombrero.id","sombrero.codigo","sombrero.photo",'guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha', "sombrero.id")->get();

      return response()->json($datos);
    }

    public function guiaIngresoDetalle($idGuiaIngreso){
      $datos = GuiaIngresoDetalle::select("orden_compra.numero_orden","sombrero.codigo","sombrero.photo","proveedor.empresa",
      "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.cantidad", "proveedor_precio.precio","guia_ingreso_detalle.descripcion")
      ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
      ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
      ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
      ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
      ->where('guia_ingreso_detalle.idGuiaIngreso','=',$idGuiaIngreso)->get();

      return response()->json($datos);
    }

    public function guiasIngresoPorCodSombrero($codSombrero){
      $datos = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
        DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
        DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
        ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
        ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.codigo','=',$codSombrero)
        ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->get();

        return response()->json($datos);
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
