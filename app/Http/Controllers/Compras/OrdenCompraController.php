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
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use App\Models\PedidoReposicion;
use App\Models\PedidoReposicionDetalle;
use App\Models\ProveedorPrecio;
use App\Models\Atributos;
use App\http\Requests\Compras\OrdenCompraCreateRequest;
use Session;
use DB;
use PDF;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
          DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
          DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'))
          ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
          ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
          ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
          ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
          ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->get();

        //$ordenes = OrdenCompra::all();
        return view('gastronomica/sombreros/ordencompra/ordencompra')->with('ordenes', $ordenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Session::flash('save','Eliga el proveedor, modelo de sombrero e ingresar la cantidad.');
        $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        
        //pedido reposicion
        $parametros = Atributos::select('costorepmaximo','costoserviciorep')->first();
        $pedidoscab = PedidoReposicion::select(
          DB::raw('SUM(proveedor_precio.precio * pedidoreposicion.cantidad) as costoreposicion'),
          DB::raw('SUM(pedidoreposicion.cantidad) as cantidadtotal'))
          ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposicion.idProveedorPrecio')
          ->where('pedidoreposicion.estado','=','A')->first();

        return view('gastronomica/sombreros/ordencompra/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'imagenes'=>$imagenes,'pedidoreposicion'=>$pedidoscab,'parametros'=>$parametros));

    }

    public function mostrarCodigoSombreroPorProveedor($idProveedor){
      $datos = Sombrero::select('sombrero.codigo')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->where('proveedor_precio.idProveedor','=', $idProveedor)->get();

      return response()->json($datos);
    }

    public function mostrarPorModelo($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code...
      /*$datos = Sombrero::where('idModelo','=', $modelo_id, 'and', 'idTejido','=',$tejido_id,
            'and','idMaterial','=',$material_id,'and','idPublicoDirigido','=',$publico_id,
            'and','idTalla','=',$talla_id)->get();*/

      //$sombrero = Sombrero::select('codigo')
      //->where('sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idMaterial','=',$material_id,
      //'and','sombrero.idTalla','=',$talla_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      //'sombrero.idModelo','=',$modelo_id)->first();

      $modelo = Modelos::select('modelo')->where('modelos.id','=',$modelo_id)->first();
      $tejido = Tejidos::select('tejido')->where('tejidos.id','=',$tejido_id)->first();
      $material = Materiales::select('material')->where('materiales.id','=',$material_id)->first();
      $publicosdirigido = PublicoDirigido::select('publico')->where('publicodirigido.id','=',$publico_id)->first();
      $tallas = Tallas::select('talla')->where('tallas.id','=',$talla_id)->first();
      
      $codigo = substr($modelo->modelo,0,3).substr($tejido->tejido,0,3).substr($material->material,0,3).substr($publicosdirigido->publico,0,3).substr($tallas->talla,0,3);
      $codigo = strtolower($codigo);

      //$datos = Sombrero::select('codigo')->where('sombrero.codigo','=',$codigo)->get();

      $datos = Sombrero::select('sombrero.codigo','sombrero.precio_venta','sombrero.precio_lista','sombrero.stock_actual','proveedor_precio.precio')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->where('sombrero.codigo','=',$codigo)->get();

      /*$sombrero = Sombrero::select('codigo')
      ->where('sombrero.idTalla','=',$talla_id,'and','sombrero.idMaterial','=',$material_id,
      'and','sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idTejido','=',$tejido_id,'and',
      'sombrero.idModelo','=',$modelo_id)->first();

      $datos = Sombrero::select('sombrero.codigo','sombrero.precio_venta','sombrero.stock_actual','proveedor_precio.precio')
      ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
      ->where('sombrero.codigo','=',$sombrero->codigo)->get();*/

      /*$datos = Sombrero::select('sombrero.codigo','sombrero.precio_venta','proveedor_precio.precio')->join('proveedor_precio',
      'proveedor_precio.idSombrero','=','sombrero.id')->where('sombrero.idModelo','=',$modelo_id,'and',
      'sombrero.idTejido','=',$tejido_id,'and','sombrero.idMaterial','=',$material_id,'and',
      'sombrero.idPublicoDirigido','=',$publico_id,'and','sombrero.idTalla',$talla_id,'and',
      'proveedor_precio.idProveedor','=',$proveedor_id)->get();*/


      return response()->json($datos);
      /*$datos = DB::select("call pa_ingresarStockSombreros($idProveedor,$idModelo,$idTejido,$idPublico,
               $idMaterial,$idTalla,$idProveedor)");*/
    }

    public function mostrarSombrero($codigo)
    {
      # code...
      $datos = Sombrero::select('sombrero.idModelo','sombrero.idTejido','sombrero.idMaterial',
        'sombrero.idPublicoDirigido', 'sombrero.idTalla','sombrero.precio_venta','sombrero.precio_lista','sombrero.stock_actual',
        'proveedor_precio.precio')->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.codigo','=',$codigo)->get();
      return response()->json($datos);
    }

    public function mostrarPorImagen($modelo,$tejido,$material,$publico,$talla)
    {
      # code...
      $datos = Sombrero::
              select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->where('modelos.id',
                '=',$modelo,'or','tejidos.id','=',$tejido,'or','materiales.id','=',$material,'or','publicodirigido.id',
                '=',$publico,'or','tallas.id','=',$talla)->get();
      return response()->json($datos);
    }

    public function mostrarIdOrden($cod)
    {
      # code...
      $datos = OrdenCompra::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarOrden($tipo,$codigo,$idProveedor,$cantidad,$costounitario,$idPedidoReposicionDetalle,$descripcion)
    {
      # code...
      $sombrero = Sombrero::where('codigo','=',$codigo)->first();
      $proveedorprecio = ProveedorPrecio::where('idSombrero','=',$sombrero->id)->get();
      $proveedorprecio_id = 0;
      foreach($proveedorprecio as $pp){
        if($pp->idProveedor == $idProveedor){
            $proveedorprecio_id = $pp->id;
        }
      }
      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = OrdenCompra::count();
        $n = ((int)$cant)+1;
        $now = new \DateTime();
        $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
        $anio = substr($año,2,2);
        $fecha_anio = ($now->format('Y-m-d'))."";
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        
        if ($cant<10000) {
          # code...
          if ($n>0 && $n<10) {
            OrdenCompra::insert(['numero_orden'=>'OC-000'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);//la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            OrdenCompra::insert(['numero_orden'=>'OC-00'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=100 && $n<1000){
            OrdenCompra::insert(['numero_orden'=>'OC-0'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=1000 && $n<10000){
            OrdenCompra::insert(['numero_orden'=>'OC-'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          }
          $ordenes = OrdenCompra::all()->last();//ultimo registro de la tabla orden _compra
          if ($descripcion=="0") {
            # code...
            if($idPedidoReposicionDetalle==0){
              OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
              'cantidad'=>$cantidad,'costounitario'=>$costounitario]);
            } else {
              OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
              'idPedidoReposicion'=>$idPedidoReposicionDetalle,'cantidad'=>$cantidad,'costounitario'=>$costounitario]);
            }
            
          } else {
            if($idPedidoReposicionDetalle==0){
              OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
              'cantidad'=>$cantidad,'costounitario'=>$costounitario,'descripcion'=>$descripcion]);
            } else {
              OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
              'idPedidoReposicion'=>$idPedidoReposicionDetalle,'cantidad'=>$cantidad,'costounitario'=>$costounitario,'descripcion'=>$descripcion]);
            }
          }


          //Modificamos el stock actual del sombrero
          //Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$cantidad+$sombrero->stock_actual]);

          Session::flash('save','Se ha guardado correctamente');
        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
      } else {//guardar solo en la tabla orden compra detalle
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $ordenes = OrdenCompra::all()->last();//ultimo registro de la tabla orden _compra

        if ($descripcion=="0") {
          # code...
          if($idPedidoReposicionDetalle==0){
            OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
            'cantidad'=>$cantidad,'costounitario'=>$costounitario]);
          } else {
            OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
            'idPedidoReposicion'=>$idPedidoReposicionDetalle,'cantidad'=>$cantidad,'costounitario'=>$costounitario]);
          }
        } else {
          if($idPedidoReposicionDetalle==0){
            OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
            'cantidad'=>$cantidad,'costounitario'=>$costounitario,'descripcion'=>$descripcion]);
          } else {
            OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idProveedorPrecio'=>$proveedorprecio_id,
            'idPedidoReposicion'=>$idPedidoReposicionDetalle,'cantidad'=>$cantidad,'costounitario'=>$costounitario,'descripcion'=>$descripcion]);
          }
        }

        //Modificamos el stock actual del sombrero
        //Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$cantidad+$sombrero->stock_actual]);

        Session::flash('save','Se ha guardado correctamente');
      }

      if($idPedidoReposicionDetalle!=0){
        $pedidoreposiciondetalle = PedidoReposicion::select('cantidadorden')->where('id',$idPedidoReposicionDetalle)->first();
        PedidoReposicion::where('id',$idPedidoReposicionDetalle)->update(['cantidadorden'=>($pedidoreposiciondetalle->cantidadorden + $cantidad)]);
      }

      $ordenesCompra = OrdenCompra::all()->last();
      //estod datos pasan a la TABLA
      $datos = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$ordenesCompra->id)->get();
      /*if($idPedidoReposicionDetalle==0){
        
        //->where('orden_compra_detalle.idOrdenCompra','=',$ordenesCompra->id)->get();//--->hay que igual con $idProveedor
      } else {
        $datos = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa","pedidoreposicion.numero_reposicion")
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('pedidoreposiciondetalle','pedidoreposiciondetalle.id','=','orden_compra_detalle.idPedidoReposicionDetalle')
        ->join('pedidoreposicion','pedidoreposicion.id','=','pedidoreposiciondetalle.idPedidoReposicion')
        ->where('orden_compra.id','=',$ordenesCompra->id)->get();
        //->where('orden_compra_detalle.idOrdenCompra','=',$ordenesCompra->id)->get();//--->hay que igual con $idProveedor
      }*/
      

      return response()->json($datos);
    }

    public function ver($id)
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->first();

      /*
      //Sin proveedor
      $detalles = OrdenCompraDetalle::select("sombrero.codigo", "orden_compra_detalle.cantidad",
        "orden_compra_detalle.costounitario", "orden_compra_detalle.descripcion")
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->where('orden_compra_detalle.idOrdenCompra','=',$id)->get();*/

      /*$detallespr = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa","pedidoreposicion.numero_reposicion")
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('pedidoreposiciondetalle','pedidoreposiciondetalle.id','=','orden_compra_detalle.idPedidoReposicionDetalle')
        ->join('pedidoreposicion','pedidoreposicion.id','=','pedidoreposiciondetalle.idPedidoReposicion')
        ->where('orden_compra.id','=',$id)->get();*/

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$id,'and','orden_compra_detalle.idPedidoReposicionDetalle','=','Null')->get();
        //->where('orden_compra_detalle.idOrdenCompra','=',$id)->get();

      return View('gastronomica.sombreros.ordencompra.ver',array('orden'=>$ordenes,'detalles'=>$detalles));
    }

    public function reporte($id)
    {
      # code...
      $ordenes = OrdenCompra::select("orden_compra.id","orden_compra.numero_orden","orden_compra.fecha",
        DB::raw('SUM(orden_compra_detalle.costounitario * orden_compra_detalle.cantidad) as precio_total'),
        DB::raw('SUM(orden_compra_detalle.cantidad) as cantidad'))
        ->join('orden_compra_detalle','orden_compra_detalle.idOrdenCompra','=','orden_compra.id')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$id)
        ->groupBy('orden_compra.id','orden_compra.numero_orden', 'orden_compra.fecha')->first();

      $detalles = OrdenCompraDetalle::select("sombrero.codigo","sombrero.photo","orden_compra_detalle.idOrdenCompra",
        "orden_compra_detalle.cantidad","orden_compra_detalle.costounitario",
        "orden_compra_detalle.descripcion","proveedor.empresa")
        ->join('orden_compra','orden_compra.id','=','orden_compra_detalle.idOrdenCompra')
        ->join('proveedor_precio','proveedor_precio.id','=','orden_compra_detalle.idProveedorPrecio')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->where('orden_compra.id','=',$id)->get();

      $pdf = PDF::loadView('reportes/ordencompra',['orden'=>$ordenes,'detalles'=>$detalles]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdenCompraCreateRequest $request)
    {
        //
        $cantidad = OrdenCompra::count();
        $n = ((int)$cantidad)+1;
        $now = new \DateTime();
        $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
        $anio = substr($año,2,2);
        $fecha_anio = ($now->format('Y-m-d'))."";
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();
        if ($cantidad<10000) {
          # code...
          if ($n>0 && $n<10) {
            OrdenCompra::insert(['numero_orden'=>'OC-000'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);//la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            OrdenCompra::insert(['numero_orden'=>'OC-00'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=100 && $n<1000){
            OrdenCompra::insert(['numero_orden'=>'OC-0'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          } else if($n>=1000 && $n<10000){
            OrdenCompra::insert(['numero_orden'=>'OC-'.$n.'-'.$anio,
            'fecha'=>$fecha_anio]);
          }
          $ordenes = OrdenCompra::all()->last();//ultimo registro de la tabla orden _compra
          OrdenCompraDetalle::insert(['idOrdenCompra'=>$ordenes->id,'idSombrero'=>$sombrero->id,
          'cantidad'=>$request->cantidad,'costounitario'=>$request->costounitario,
          'descripcion'=>$request->descripcion]);
          Session::flash('save','Se ha guardado correctamente');
        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
        return redirect()->action('Compras\OrdenCompraController@index');
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
