<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Proveedor;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\ComisionEmpleado;
use App\Models\Precios;
use App\User;
use App\Models\Atributos;
use App\Models\Movimiento;
use App\Models\PedidoReposicion;
use App\Models\PedidoReposicionDetalle;
use App\Models\ProveedorPrecio;
use Session;
use DB;
use PDF;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$stock = Venta::whereBetween('fecha',['DATE_SUB(NOW(), INTERVAL 1 DAY)','NOW()'])
        ->orderBy('id','desc')->get();*/

        $stock2 = Venta::where('fecha','>=',DB::raw('DATE_SUB(NOW(), INTERVAL 1 DAY)'))->get();
        //echo($stock2."");
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")          
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')->get();
        
          /*$ventas2 = Venta::select("venta.id", "venta.numero_venta","venta.fecha","empleado.nombres","cliente.nombres as cliente")
          ->join("empleado","empleado.id","=","venta.idEmpleado")
            ->join("cliente","cliente.id","=","venta.idCliente")          
            ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha',"empleado.nombres","cliente.nombres")->get();*/

        //echo($ventas2);
        return view('gastronomica/sombreros/ventas/ventas')->with('ventas', $ventas);
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
        //Empleados
        $empleados = Empleado::select('empleado.id','encargo.nombre as encargo','empleado.nombres',
        'empleado.apellidos','empleado.dni','empleado.direccion','empleado.telefono','empleado.email')
        ->join('encargo','encargo.id','=','empleado.idEncargo')->get();

        $clientes = Cliente::select('cliente.id','cliente.nombres','cliente.dni','cliente.direccion','cliente.telefono')
        ->get();

        $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();

        $parametros = Atributos::first();
        return view('gastronomica/sombreros/ventas/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'empleados'=>$empleados,'clientes'=>$clientes,'imagenes'=>$imagenes, 'parametros'=>$parametros));
    }

    public function mostrarIdVenta($cod)
    {
      # code...
      $datos = Venta::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarVenta($tipo,$codigo,$cantidad,$precio_unitario,$porcentaje_descuento,
      $descuento,$sub_total,$nombreUsuario,$idEmpleado,$idCliente,$descripcion)
    {
      # code...
      $sombrero = Sombrero::where('codigo','=',$codigo)->first();
      $parametros = Atributos::first();

      $now = new \DateTime();
      $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
      $anio = substr($año,2,2);
      $fecha_actual = ($now->format('Y-m-d'))."";

      $stockactual = $sombrero->stock_actual - $cantidad;
      $valoranterior = $sombrero->costo_promedio * $sombrero->stock_actual;
      //$valor = $valoranterior - ($ventadetalle->precio_venta * $cantidad);
      $valor = $valoranterior - ($sombrero->costo_promedio * $cantidad);
      if($stockactual!=0){
        $costopromedio = $valor / $stockactual;
      } else {
        $costopromedio = 0;
      }
      

      $utilidad = ($sombrero->precio_lista * $cantidad) - (($sombrero->costo_promedio * $cantidad) + $descuento);
      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = Venta::count();
        $n = ((int)$cant)+1;
        
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        //$sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $usuario = User::where('name','=',$nombreUsuario)->first();
        //$empleado = ComisionEmpleado::select('porcentaje')->where('idEmpleado','=',$idEmpleado,'and','idSombrero','=',$sombrero->id)->first();
        if ($cant<10000) {
          # code...
          if ($n>0 && $n<10) {
            Venta::insert(['idEmpleado'=>$idEmpleado,'idCliente'=>$idCliente,'numero_venta'=>'OV-000'.$n.'-'.$anio,'fecha'=>$fecha_actual,
            'utilidad'=>$utilidad,'idUsuario'=>$usuario->id,'comision'=>$parametros->comision]);
            //la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            Venta::insert(['idEmpleado'=>$idEmpleado,'idCliente'=>$idCliente,'numero_venta'=>'OV-00'.$n.'-'.$anio,
            'fecha'=>$fecha_actual,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id,'comision'=>$parametros->comision]);
          } else if($n>=100 && $n<1000){
            Venta::insert(['idEmpleado'=>$idEmpleado,'idCliente'=>$idCliente,'numero_venta'=>'OV-0'.$n.'-'.$anio,
            'fecha'=>$fecha_actual,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id,'comision'=>$parametros->comision]);
          } else if($n>=1000 && $n<10000){
            Venta::insert(['idEmpleado'=>$idEmpleado,'idCliente'=>$idCliente,'numero_venta'=>'OV-'.$n.'-'.$anio,
            'fecha'=>$fecha_actual,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id,'comision'=>$parametros->comision]);
          }
          $ordenes = Venta::all()->last();//ultimo registro de la tabla venta
          if ($descripcion=="0") {
            # code...
            VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
            'cantidad'=>$cantidad,'costo_promedio'=>$sombrero->costo_promedio,'precio_venta'=>$sombrero->precio_lista,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
            'sub_total'=>$sub_total,'utilidad'=>$utilidad]);
          } else {
            VentaDetalle::insert(['idVenta'=>$ordenes->id,'precio_lista'=>$sombrero->id,
            'cantidad'=>$cantidad,'costo_promedio'=>$sombrero->costo_promedio,'precio_venta'=>$sombrero->precio_venta,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
            'sub_total'=>$sub_total,'utilidad'=>$utilidad,'descripcion'=>$descripcion]);
          }


          /*falta para modificar el stock_actual de Sombreros*/
          /*Sombrero::where('codigo',$codigo)->update(['utilidad'=>($sombrero->utilidad)+$utilidad,
          'stock_actual'=>($sombrero->stock_actual)-$cantidad]);*/
          Session::flash('save','Se ha guardado correctamente');

        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
      } else {//guardar solo en la tabla orden venta detalle
        //$sombrero = Sombrero::where('codigo','=',$codigo)->first();
        //$empleado = ComisionEmpleado::select('porcentaje')->where('idEmpleado','=',$idEmpleado,'and','idSombrero','=',$sombrero->id)->first();
        $ordenes = Venta::all()->last();//ultimo registro de la tabla orden _compra
        if($descripcion=="0"){
          VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
          'cantidad'=>$cantidad,'costo_promedio'=>$sombrero->costo_promedio,'precio_venta'=>$sombrero->precio_lista,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
          'sub_total'=>$sub_total,'utilidad'=>$utilidad]);
        } else {
          VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
          'cantidad'=>$cantidad,'costo_promedio'=>$sombrero->costo_promedio,'precio_venta'=>$sombrero->precio_lista,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
          'sub_total'=>$sub_total,'utilidad'=>$utilidad,'descripcion'=>$descripcion]);
        }
        
        /*falta para modificar el stock_actual de Sombreros*/
        Venta::where('numero_venta',$ordenes->numero_venta)->update(['utilidad'=>($ordenes->utilidad)+$utilidad]);
        /*Sombrero::where('codigo',$codigo)->update(['utilidad'=>($sombrero->utilidad)+$utilidad,
        'stock_actual'=>($sombrero->stock_actual)-$cantidad]);*/
        Session::flash('save','Se ha guardado correctamente');
      }
      /*tabla precios (aca se modific )*/
      $precios = Precios::select('id','stock')->where('idSombrero','=',$sombrero->id,'and','precio','=',$sombrero->precio_venta)->first();
      if($precios!=""){
        Precios::where('id',$precios->id)->update(['stock'=>($precios->stock - $cantidad)]); 
      }

      /**Ingresamos movimiento */
      
      $ventadetalle = VentaDetalle::all()->last();
      //Valores para el Movimiento
      

      Movimiento::insert(['idSombrero'=>$sombrero->id,'cantidadsalida'=>$cantidad,'preciounitario'=>$ventadetalle->precio_venta,
      'preciototal'=>$cantidad * $ventadetalle->precio_venta,'stock_actual'=>$stockactual,'valor'=>$valor,'costopromedio'=>$costopromedio,
      'margenganancia'=>$parametros->margenganancia,'preciosistema'=>($costopromedio / ($parametros->margenganancia/100.00)), 'fecha'=>$fecha_actual]);
      //Modificamos el stock actual del sombrero **
      if($costopromedio== 0){//cambia el precio lista tambien es cero
        Sombrero::where('codigo',$codigo)->update(['utilidad'=>(($sombrero->utilidad) + $utilidad),'stock_actual'=>$stockactual,'costo_promedio'=>$costopromedio,
        'precio_venta'=>($costopromedio / ($parametros->margenganancia/100.00)),'precio_lista'=>0.00]);
      } else {
        Sombrero::where('codigo',$codigo)->update(['utilidad'=>(($sombrero->utilidad) + $utilidad),'stock_actual'=>$stockactual,'costo_promedio'=>$costopromedio,
        'precio_venta'=>($costopromedio / ($parametros->margenganancia/100.00))]);
      }
      
      /** fin movimiento */

      /**-----------------Pedido reposicion---------------*/
      $sombrero = Sombrero::where('codigo','=',$codigo)->first();
      //ver si en verdad el sombrero necesita pedido reposicion
      if($sombrero->stock_actual <= $sombrero->stock_minimo){
        $pedidoreposicion = PedidoReposicion::where('estado','=','A')->get();
        if($pedidoreposicion == '') {//no hay pedido de reposicion$now = new \DateTime();
          $año =$now->format('Y');
          $fecha_actual = $now->format('Y-m-d'); //$now->format('d-m-Y H:i:s');

          $minimocosto = ProveedorPrecio::select(DB::raw('MIN(proveedor_precio.precio) as costominimo'))
          ->where('idSombrero','=',$idSombrero)->first();

          $proveedorprecio = ProveedorPrecio::select('id','idProveedor')
              ->where('idSombrero','=',$idSombrero,'and','precio','=',$minimocosto->costominimo)->first();
          
          PedidoReposicion::insert(['idProveedorPrecio'=>$proveedorprecio->id,
          'cantidad'=>$sombrero->stock_maximo,'estado'=>'A','fecha'=>$fecha_actual]);
        } else {// si hay pedidos de reposicion
          //hay que ver si el pedidoreposicion del sombrero esta activo o no
          $preciostodo = ProveedorPrecio::where('idSombrero','=',$sombrero->id)->get();
          $pedidoreposiciondetalle_id = 0;
          foreach($pedidoreposicion as $pd){
            foreach($preciostodo as $p){
              if($pd->idProveedorPrecio == $p->id){
                $pedidoreposiciondetalle_id =  $pd->id;
              }
            }
          }
          //echo("Pedidoreposiciondetalle_id: ".$pedidoreposiciondetalle_id);
          if($pedidoreposiciondetalle_id == 0){// no hay reposiciondetalle del sombrero
            //agregarle a pedidoreposiciondetalle
            //echo("| en la reposicion activado no hay el id del proveedorprecio");
            $count = ProveedorPrecio::select(DB::raw('COUNT(idSombrero) as cantidad'))
            ->where('idSombrero','=',$sombrero->id)->first();
            //echo("| cantidad: ".$count->cantidad);
            $now = new \DateTime();
            $año =$now->format('Y');
            $fecha_actual = $now->format('Y-m-d'); //$now->format('d-m-Y H:i:s');
            if($count->cantidad > 1) {//en tabla proveedorPrecio hay mas de uno del sombrero
              //hay que buscar el minimo costo que existe el sombrero en proveedorprecio
              //echo("| se busca proveedorprecio minimo para luego agregar en pedidoreposiciondetalle");

              $minimocosto = ProveedorPrecio::select(DB::raw('MIN(proveedor_precio.precio) as costominimo'))
              ->where('idSombrero','=',$sombrero->id)->first();
              $proveedorprecio_id = 0;
              foreach($preciostodo as $pp){
                if($pp->precio == $minimocosto->costominimo){
                  $proveedorprecio_id = $pp->id;
                }
              }
              //Modificamos pedidoreposicion
              $proveedorprecio = ProveedorPrecio::all()->last();
              PedidoReposicion::insert(['idProveedorPrecio'=>$proveedorprecio_id,
              'cantidad'=>$sombrero->stock_maximo,'estado'=>'A','fecha'=>$fecha_actual]);
            } else {
              //echo("| en la proveedorprecio solo hay un sombrero");
              $proveedorprecio = ProveedorPrecio::all()->last();
              PedidoReposicion::insert(['idProveedorPrecio'=>$proveedorprecio->id,
              'cantidad'=>$sombrero->stock_maximo,'estado'=>'A','fecha'=>$fecha_actual]);
            }// else siempre va hacer uno porque se ingreso al inicio de este metodo
          }
          
        }
      }
      
      /**------------------fin pedido reposicion------------*/

      $ordenesVenta = Venta::all()->last();

      //estod datos pasan a la TABLA
      $datos = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
      "venta_detalle.cantidad","venta_detalle.precio_venta", "venta_detalle.porcentaje_descuento",
      "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
      ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
      ->where("venta_detalle.idVenta","=",$ordenesVenta->id)->get();
      return response()->json($datos);
    }

    public function ver($id)
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha","empleado.nombres","cliente.nombres as cliente",
        "empleado.nombres", DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->join("cliente","cliente.id","=","venta.idCliente")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres',"cliente.nombres")->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      return View('gastronomica.sombreros.ventas.ver',array('venta'=>$ventas,'detalles'=>$detalles));
    }

    public function reporte($id)
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres",
      "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->join("cliente","cliente.id","=","venta.idCliente")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      $pdf = PDF::loadView('reportes/ventas',['venta'=>$ventas,'detalles'=>$detalles]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    public function reporteConComision($id){
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha","venta.utilidad",
      "venta.comision","empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->join("empleado","empleado.id","=","venta.idEmpleado")
        ->join("cliente","cliente.id","=","venta.idCliente")
        ->where('venta.id','=',$id)
        ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha',"venta.utilidad","venta.comision",
        'empleado.nombres','cliente.nombres')->first();

      $detalles = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$id)->get();

      $pdf = PDF::loadView('reportes/ventasporempleado',['venta'=>$ventas,'detalles'=>$detalles]);
      $pdf->setPaper('a4','landscape');//orientacion horizontal
      return $pdf->stream();
    }

    public function actualizarStock($id)
    {
      # code...
      //SELECT * FROM noticias WHERE Fecha BETWEEN DATE_SUB(NOW(), INTERVAL 2 MONTH) AND NOW() ORDER BY Id DESC;
      $now = new \DateTime();
      $fecha = ($now->format('Y-m-d'))."";
      $stock = Venta::select("venta.id")
      ->whereBetween('fecha',['DATE_SUB(NOW(), INTERVAL 2 MONTH)','NOW()'])
      ->orderBy('id','desc');
    }

    public function ventaDetalle($idVenta){
      $datos = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
        "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
        "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
        ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
        ->where("venta_detalle.idVenta","=",$idVenta)->get();

      return response()->json($datos);
    }

    public function ventasPorCodSombrero($codSombrero){
      $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          ->join("users","users.id","=","venta.idUsuario")
          ->where('sombrero.codigo', '=', $codSombrero)
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'users.name')->get();
      return response()->json($datos);
    }

    public function movVentas($id, $fecha_inicio,$fecha_fin){
      $datos = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "users.name", 
          DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
          DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
          ->join("users","users.id","=","venta.idUsuario")
          ->where('sombrero.id', '=', $id)
          ->whereBetween('fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'users.name')->get();
      
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
