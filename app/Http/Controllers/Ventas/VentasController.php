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
use App\Models\ComisionEmpleado;
use App\User;
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
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres", 
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres')->paginate(4);
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
        return view('gastronomica/sombreros/ventas/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'empleados'=>$empleados));
    }

    public function mostrarIdVenta($cod)
    {
      # code...
      $datos = Venta::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarVenta($tipo,$codigo,$idProveedor,$cantidad,$precio_unitario,$porcentaje_descuento,
      $descuento,$sub_total,$nombreUsuario,$utilidad,$idEmpleado,$descripcion)
    {
      # code...

      if ($tipo==1) {//guardar el primer orden de compra y orden compra detalle
        # code...
        $cant = Venta::count();
        $n = ((int)$cant)+1;
        $now = new \DateTime();
        $año =$now->format('Y'); //$now->format('d-m-Y H:i:s');
        $anio = substr($año,2,2);
        $fecha_anio = ($now->format('Y-m-d'))."";
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $usuario = User::where('name','=',$nombreUsuario)->first();
        $empleado = ComisionEmpleado::select('porcentaje')->where('idEmpleado','=',$idEmpleado,'and','idSombrero','=',$sombrero->id)->first();
        if ($cant<10000) {
          # code...
          if ($n>0 && $n<10) {
            Venta::insert(['idEmpleado'=>$idEmpleado,'numero_venta'=>'OV-000'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id]);//la variable $ordenes retorna (1 si se guardo y 0 no se guardo)
          } else if($n>=10 && $n<100){
            Venta::insert(['idEmpleado'=>$idEmpleado,'numero_venta'=>'OV-00'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id]);
          } else if($n>=100 && $n<1000){
            Venta::insert(['idEmpleado'=>$idEmpleado,'numero_venta'=>'OV-0'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id]);
          } else if($n>=1000 && $n<10000){
            Venta::insert(['idEmpleado'=>$idEmpleado,'numero_venta'=>'OV-'.$n.'-'.$anio,
            'fecha'=>$fecha_anio,'utilidad'=>$utilidad,'idUsuario'=>$usuario->id]);
          }
          $ordenes = Venta::all()->last();//ultimo registro de la tabla venta
          if ($descripcion=="0") {
            # code...
            VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
            'cantidad'=>$cantidad,'precio_venta'=>$sombrero->precio_venta,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
            'sub_total'=>$sub_total,'utilidad'=>$utilidad,'comisionempleado'=>$empleado->porcentaje]);
          } else {
            VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
            'cantidad'=>$cantidad,'precio_venta'=>$sombrero->precio_venta,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
            'sub_total'=>$sub_total,'utilidad'=>$utilidad,'comisionempleado'=>$empleado->porcentaje,'descripcion'=>$descripcion]);
          }


          /*falta para modificar el stock_actual de Sombreros*/
          Sombrero::where('codigo',$codigo)->update(['utilidad'=>($sombrero->utilidad)+$utilidad,
          'stock_actual'=>($sombrero->stock_actual)-$cantidad]);
          Session::flash('save','Se ha guardado correctamente');

        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
      } else {//guardar solo en la tabla orden venta detalle
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $empleado = ComisionEmpleado::select('porcentaje')->where('idEmpleado','=',$idEmpleado,'and','idSombrero','=',$sombrero->id)->first();
        $ordenes = Venta::all()->last();//ultimo registro de la tabla orden _compra
        VentaDetalle::insert(['idVenta'=>$ordenes->id,'idSombrero'=>$sombrero->id,
        'cantidad'=>$cantidad,'precio_venta'=>$sombrero->precio_venta,'porcentaje_descuento'=>$porcentaje_descuento,'descuento'=>$descuento,
        'sub_total'=>$sub_total,'utilidad'=>$utilidad,'comisionempleado'=>$empleado->porcentaje,'descripcion'=>$descripcion]);
        /*falta para modificar el stock_actual de Sombreros*/
        Venta::where('numero_venta',$ordenes->numero_venta)->update(['utilidad'=>($ordenes->utilidad)+$utilidad]);
        Sombrero::where('codigo',$codigo)->update(['utilidad'=>($sombrero->utilidad)+$utilidad,
        'stock_actual'=>($sombrero->stock_actual)-$cantidad]);
        Session::flash('save','Se ha guardado correctamente');
      }
      $ordenesVenta = Venta::all()->last();
      //estod datos pasan a la TABLA
      $datos = VentaDetalle::select("venta_detalle.id","sombrero.codigo", "sombrero.photo",
      "venta_detalle.cantidad","sombrero.precio_venta", "venta_detalle.porcentaje_descuento",
      "venta_detalle.descuento","venta_detalle.sub_total", "venta_detalle.descripcion")
      ->join("sombrero", "sombrero.id","=","venta_detalle.idSombrero")
      ->where("venta_detalle.idVenta","=",$ordenesVenta->id)->get();
      return response()->json($datos);
    }

    public function ver($id)
    {
      # code...
      $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha",
        "empleado.nombres", DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
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

      return View('gastronomica.sombreros.ventas.ver',array('venta'=>$ventas,'detalles'=>$detalles));
    }

    public function reporte($id)
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

      $pdf = PDF::loadView('reportes/ventas',['venta'=>$ventas,'detalles'=>$detalles]);
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
