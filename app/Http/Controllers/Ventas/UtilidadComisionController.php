<?php

namespace App\Http\Controllers\Ventas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\VentaDetalle;
use DB;

class UtilidadComisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ventas = Venta::select("venta.id", "venta.numero_venta","venta.fecha","venta.comision", 
        "empleado.nombres", "cliente.nombres as cliente",
        DB::raw('SUM(venta_detalle.precio_venta * venta_detalle.cantidad) as precio_total'),
        DB::raw('SUM(venta_detalle.costo_promedio * venta_detalle.cantidad) as costo_total'),
        DB::raw('SUM(venta_detalle.utilidad) as utilidad_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->join("cliente","cliente.id","=","venta.idCliente")
          ->groupBy('venta.id','venta.numero_venta', 'venta.fecha',"venta.comision", 
          'empleado.nombres','cliente.nombres')->get();
        
        return view('gastronomica/sombreros/ventas/utilidades/utilidadcomision')->with('ventas',$ventas);
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

      return View('gastronomica.sombreros.ventas.utilidades.ver',array('venta'=>$ventas,'detalles'=>$detalles));
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
