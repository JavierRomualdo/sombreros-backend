<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cancelacion;
use App\Models\CancelacionDetalle;
use App\Models\Venta;
use DB;

class CancelacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cancelaciones = Cancelacion::select('cancelacion.id','reciboprovicional','banco','numerocuenta','cancelacion.fecha',
        DB::raw('COUNT(cancelaciondetalle.id) as cantidad'), DB::raw('SUM(venta_detalle.cantidad) as cantidaditems'),
        DB::raw('SUM(venta_detalle.sub_total) as preciototal'))
        ->join('cancelaciondetalle','cancelaciondetalle.idCancelacion','=','cancelacion.id')
        ->join('venta','venta.id','=','cancelaciondetalle.idVenta')
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->groupBy('cancelacion.id','reciboprovicional','banco','numerocuenta','cancelacion.fecha')
        ->get();
        return view('gastronomica/sombreros/ventas/cancelaciones/cancelacion')->with('cancelaciones',$cancelaciones);
    }

    public function ver($idCancelacion)
    {
        # code...
        $cancelacion = Cancelacion::select('cancelacion.id','reciboprovicional','banco','numerocuenta','cancelacion.fecha',
        DB::raw('COUNT(cancelaciondetalle.id) as cantidad'), DB::raw('SUM(venta_detalle.sub_total) as preciototal'))
        ->join('cancelaciondetalle','cancelaciondetalle.idCancelacion','=','cancelacion.id')
        ->join('venta','venta.id','=','cancelaciondetalle.idVenta')
        ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
        ->groupBy('cancelacion.id','reciboprovicional','banco','numerocuenta','cancelacion.fecha')
        ->where('cancelaciondetalle.idCancelacion','=',$idCancelacion)->first();

        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")   
          ->join('cancelaciondetalle','cancelaciondetalle.idVenta','=','venta.id')       
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')
          ->where('cancelaciondetalle.idCancelacion','=',$idCancelacion)->get();

          return view('gastronomica/sombreros/ventas/cancelaciones/ver',array('cancelacion'=>$cancelacion,'ventas'=>$ventas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha", "empleado.nombres","cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")          
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha', 'venta.fecha', 'empleado.nombres','cliente.nombres')
          ->where('estadocancelado','=','N')->get();
        
        return view('gastronomica/sombreros/ventas/cancelaciones/create')->with('ventas', $ventas);
    }

    public function nuevaCancelacion($reciboprovicional,$banco,$numerocuenta,$fecha,$idVenta)
    {
        # code...
        if($reciboprovicional=="0"){
            Cancelacion::insert(['banco'=>$banco,'numerocuenta'=>$numerocuenta,'fecha'=>$fecha]);
        } else {
            Cancelacion::insert(['reciboprovicional'=>$reciboprovicional,'fecha'=>$fecha]);
        }
        $cancelacion = Cancelacion::all()->last();
        CancelacionDetalle::insert(['idCancelacion'=> $cancelacion->id,'idVenta'=>$idVenta]);

        Venta::where('id',$idVenta)->update(['estadocancelado'=>'S']);

        $datos = Cancelacion::where('id',$cancelacion->id)->get();
        return response()->json($datos);
    }

    public function cancelarVenta($idCancelacion,$idVenta)
    {
        # code...
        CancelacionDetalle::insert(['idCancelacion'=>$idCancelacion,'idVenta'=>$idVenta]);
        Venta::where('id',$idVenta)->update(['estadocancelado'=>'S']);
        
        $datos = Cancelacion::where('id',$idCancelacion)->get();
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
