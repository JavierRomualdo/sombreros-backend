<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sombrero;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Proveedor;
use App\Models\TipoMovimiento;
use App\Models\Movimientos;
use App\Models\GuiaIngreso;
use App\Models\Venta;
use App\http\Requests\Movimiento\MovimientoCreateRequest;
use App\http\Requests\Movimiento\MovimientoUpdateRequest;
use DB;
use Auth;
use PDF;
use Session;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Para los diferentes combos
        /*$modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');*/

        /**************PARA LA TABLA***************/
        /*$movimientosCompra = Movimientos::select("sombrero.codigo","sombrero.precio_compra", DB::raw('SUM(movimientos.cantidad) as cantidad'),
          DB::raw('COUNT(*) as total'),"movimientos.idTipoMovimiento","sombrero.precio_venta","sombrero.stock_actual","sombrero.id")
          ->join('sombrero','sombrero.id','=','movimientos.idProducto')->groupBy('sombrero.codigo','movimientos.idTipoMovimiento','sombrero.precio_compra',
          'sombrero.precio_venta','sombrero.stock_actual','sombrero.id')->paginate(5);//get()
*/
          //echo($movimientosCompra);
        /*$movimientosVenta = Movimientos::select("sombrero.codigo","sombrero.precio_venta", DB::raw('SUM(movimientos.cantidad) as cantidad'),
          DB::raw('COUNT(*) as total'))->join('sombrero','sombrero.id','=','movimientos.idProducto')->where('idTipoMovimiento',
          '=',2)->groupBy('sombrero.codigo','sombrero.precio_venta')->get();*/

        //$mm = array_merge($movimientosCompra,$movimientosVenta);

        //Seleccion todas las "Entradas" (cuando es una compra)
        /*$movimientos = Movimientos::select('tipomovimiento.tipo_movimiento','sombrero.codigo','sombrero.precio_compra',
          'users.name','movimientos.cantidad','movimientos.fecha')->join('tipomovimiento','tipomovimiento.id',
          '=','movimientos.idTipoMovimiento')->join('sombrero','sombrero.id','=','movimientos.idProducto')->join('users',
          'users.id','=','movimientos.idUsuario')->where('idTipoMovimiento','=',1)->get();*/

        //echo("compras: ".$movimientosCompra." | ventas: ".$movimientosVenta);
        //return view ('gastronomica/sombreros/movimientos/movimiento', array('movimientoscompra'=>$movimientosCompra));
        return view ('gastronomica/sombreros/movimientos/movimientogeneral');
      }

      public function indexMovimientoPorArticulo(){
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');

        return view ('gastronomica/sombreros/movimientos/movimientoporarticulo', array('modelo'=>$modelos, 'tejido'=>$tejidos,
        'material'=>$materiales,'publicodirigido'=>$publicosdirigido, 'talla'=>$tallas));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $tipomovimiento = TipoMovimiento::pluck('tipo_movimiento', 'id')->prepend('Seleccione Tipo Movimiento...');
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return View('gastronomica.sombreros.movimientos.create', array('tipomovimiento'=>$tipomovimiento,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'proveedor'=>$proveedores));

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
        $operacion = $request->idTipoMovimiento;
        $codigo = $request->codigo;
        $sombrero = Sombrero::where('codigo',$codigo)->first();
        if ($operacion==1) {//Realizando Una Compra
          # code...
          //Agregando Stock a tabla Sombrero
          //
          if ($sombrero->precio_compra==0.0) {
            # code...
            //Al inicio cuando el precio_compra = 0, stock_actual = 0
            Sombrero::where('codigo',$codigo)->update(['precio_compra'=>$request->precio,'stock_actual'=>$request->cantidad]);
          } else {
            Sombrero::where('codigo',$codigo)->update(['stock_actual'=>($sombrero->stock_actual + $request->cantidad)]);
          }
          //$sombreros = DB::update("update sombreros set (stock_actual)");
        } else {//Realizando una Venta
          if ($sombrero->precio_venta==0.0) {
            # code...
            Sombrero::where('codigo',$codigo)->update(['precio_venta'=>$request->precio,'stock_actual'=>$request->cantidad]);
          } else {
            Sombrero::where('codigo',$codigo)->update(['stock_actual'=>($request->stock_actual - $request->cantidad)]);
          }
        }
        //Insertar movimientos
        Movimientos::insert(
          ['idTipoMovimiento'=>$operacion,'idProducto'=>$sombrero->id,'idUsuario'=>Auth::user()->id,
            'cantidad'=>$request->cantidad,'fecha'=>$request->fecha,'descripcion'=>$request->descripcion]);
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\MovimientoController@index');
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
    /**Reporte por movimiento por articulo */
    public function reporteMovimientoArticulo($idSombrero, $fecha_inicio, $fecha_fin){
      $sombrero = Sombrero::select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
        'publicodirigido.publico','tallas.talla','sombrero.precio_venta','sombrero.utilidad',
        'sombrero.stock_actual','sombrero.pedido_reposicion','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->where('sombrero.id','=',$idSombrero)->first();

      $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia", "guia_ingreso.fecha",
        DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad_guia'), 
        DB::raw('SUM(guia_ingreso_detalle.cantidad * proveedor_precio.precio) as precio_total'))
        ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
        ->join('orden_compra_detalle','orden_compra_detalle.id','=','guia_ingreso_detalle.idOrdenCompraDetalle')
        ->join('sombrero','sombrero.id','=','orden_compra_detalle.idSombrero')
        ->join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        ->where('sombrero.id','=',$idSombrero)
        ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
        ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia','guia_ingreso.fecha')->get(); 
      
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->where('sombrero.id', '=', $idSombrero)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->get();

      $pdf = PDF::loadView('reportes/movimientoarticulo',['fecha_inicio'=>$fecha_inicio,
      'fecha_fin'=>$fecha_fin,'sombrero'=>$sombrero,'guias'=>$guias,'ventas'=>$ventas]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
     }
     public function reporte($id)
     {
       # code...
       $sombreros = Sombrero::FindOrFail($id);
       $modelos = Modelos::FindOrFail($sombreros->idModelo);
       $tejidos = Tejidos::FindOrFail($sombreros->idTejido);
       $materiales = Materiales::FindOrFail($sombreros->idMaterial);
       $publicosdirigido = PublicoDirigido::FindOrFail($sombreros->idPublicoDirigido);
       $tallas = Tallas::FindOrFail($sombreros->idTalla);
       $proveedores = Proveedor::FindOrFail($sombreros->idProveedor);

       $movimientosCompra = Movimientos::select('tipomovimiento.tipo_movimiento','sombrero.codigo','sombrero.precio_compra',
         'users.name','movimientos.id','movimientos.cantidad','movimientos.fecha','movimientos.descripcion')->join('tipomovimiento','tipomovimiento.id',
         '=','movimientos.idTipoMovimiento')->join('sombrero','sombrero.id','=','movimientos.idProducto')->join('users',
         'users.id','=','movimientos.idUsuario')->where('idTipoMovimiento','=',1,'and','sombrero.id','=',$id)->get();

      $movimientosVenta = Movimientos::select('tipomovimiento.tipo_movimiento','sombrero.codigo','sombrero.precio_venta',
         'users.name','movimientos.id','movimientos.cantidad','movimientos.fecha','movimientos.descripcion')->join('tipomovimiento','tipomovimiento.id',
         '=','movimientos.idTipoMovimiento')->join('sombrero','sombrero.id','=','movimientos.idProducto')->join('users',
         'users.id','=','movimientos.idUsuario')->where('idTipoMovimiento','=',2,'and','sombrero.id','=',$id)->get();
       $pdf = PDF::loadView('vista',['sombrero'=>$sombreros,'modelo'=>$modelos,'tejido'=>$tejidos,'material'=>$materiales,
       'publicodirigido'=>$publicosdirigido,'talla'=>$tallas,'movimientoscompra'=>$movimientosCompra,'proveedor'=>$proveedores,
       'movimientosventa'=>$movimientosVenta]);
       //return $pdf->download('archivo.pdf');
       return $pdf->stream();
     }
     public function ver($id)
     {
       # code...
       $sombreros = Sombrero::FindOrFail($id);
       $modelos = Modelos::FindOrFail($sombreros->idModelo);
       $tejidos = Tejidos::FindOrFail($sombreros->idTejido);
       $materiales = Materiales::FindOrFail($sombreros->idMaterial);
       $publicosdirigido = PublicoDirigido::FindOrFail($sombreros->idPublicoDirigido);
       $tallas = Tallas::FindOrFail($sombreros->idTalla);
       $proveedores = Proveedor::FindOrFail($sombreros->idProveedor);

       //Seleccion todas las "Entradas" (cuando es una compra)
       $movimientosCompra = Movimientos::select('tipomovimiento.tipo_movimiento','sombrero.codigo','sombrero.precio_compra',
         'users.name','movimientos.id','movimientos.cantidad','movimientos.fecha','movimientos.descripcion')->join('tipomovimiento','tipomovimiento.id',
         '=','movimientos.idTipoMovimiento')->join('sombrero','sombrero.id','=','movimientos.idProducto')->join('users',
         'users.id','=','movimientos.idUsuario')->where('idTipoMovimiento','=',1,'and','idProducto','=',$sombreros->id)->get();

      $movimientosVenta = Movimientos::select('tipomovimiento.tipo_movimiento','sombrero.codigo','sombrero.precio_venta',
          'users.name','movimientos.id','movimientos.cantidad','movimientos.fecha','movimientos.descripcion')->join('tipomovimiento','tipomovimiento.id',
          '=','movimientos.idTipoMovimiento')->join('sombrero','sombrero.id','=','movimientos.idProducto')->join('users',
          'users.id','=','movimientos.idUsuario')->where('idTipoMovimiento','=',2,'and','idProducto','=',$sombreros->id)->get();

       return View('gastronomica.sombreros.movimientos.ver', array('sombrero'=>$sombreros,'modelo'=>$modelos->modelo, 'tejido'=>$tejidos->tejido,
           'material'=>$materiales->material,'publicodirigido'=>$publicosdirigido->publico,'talla'=>$tallas->talla,'proveedor'=>$proveedores,
         'movimientoscompra'=>$movimientosCompra,'movimientosventa'=>$movimientosVenta));
     }

    public function update(MovimientoUpdateRequest $request, $id)
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

    public function ajax($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code...
      $datos = Sombrero::where('idModelo','=', $modelo_id, 'and', 'idTejido','=',$tejido_id,
            'and','idMaterial','=',$material_id,'and','idPublicoDirigido','=',$publico_id,
            'and','idTalla','=',$talla_id)->get();
      return response()->json($datos);
      /*$datos = DB::select("call pa_ingresarStockSombreros($idProveedor,$idModelo,$idTejido,$idPublico,
               $idMaterial,$idTalla,$idProveedor)");*/
    }

    public function ajaxSombrero($codSombrero)
    {
      # code...
      $datos = Sombrero::where('codigo','=',$codSombrero)->get();
      return response()->json($datos);
    }
}
