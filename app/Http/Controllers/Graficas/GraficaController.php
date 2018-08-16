<?php

namespace App\Http\Controllers\Graficas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sombrero;
use App\Models\Venta;
use App\Models\Empleado;
use DB;

class GraficaController extends Controller
{
    //
    public function stockactual() {
        $datos = Sombrero::select('sombrero.id', 'sombrero.codigo','sombrero.stock_actual','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')->get();
        
        return view ('gastronomica/sombreros/estadistica/stockactual/stockactual')
        ->with('imagenes',$datos);
    }

    public function indexventasvendedor()
    {
        # code...
        // Encontrar fecha inicio y fin del mes actual
        $month = date('m');
        $year = date('Y');
        $fecha_inicio_mes = date('Y-m-d', mktime(0,0,0, $month, 1, $year));

        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        $fecha_fin_mes =  date('Y-m-d', mktime(0,0,0, $month, $day, $year));

        $vendedores = Empleado::select('id','nombres','apellidos','dni','direccion','telefono')->get();

        $datos = Venta::select("empleado.id", "empleado.nombres",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->whereBetween('venta.fecha',[$fecha_inicio_mes,$fecha_fin_mes])
          ->groupBy('empleado.id', "empleado.nombres")->get();
    
          return view ('gastronomica/sombreros/estadistica/ventas/vendedor', 
            array('vendedores'=>$vendedores,'ventasvendedor'=>$datos));
    }

    public function ventasporvendedores($fecha_inicio,$fecha_fin)
    {
        # code...
        $datos = Venta::select("empleado.id", "empleado.nombres",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('empleado.id', "empleado.nombres")->get();
        
         return response()->json($datos);
    }

    public function ventasporvendedor($idVendedor,$fecha_inicio,$fecha_fin)
    {
        # code...
        $datos = Venta::select("venta.fecha",
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
          ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
          ->join("empleado","empleado.id","=","venta.idEmpleado")
          ->whereBetween('venta.fecha',[$fecha_inicio,$fecha_fin])
          ->groupBy('venta.fecha')
          ->where('empleado.id','=',$idVendedor)->get();

        return response()->json($datos);
    }

    public function indexporarticulo()
    {
        # code...
        // encontrer la venta de todos los articulos del mes actual
        $month = date('m');
        $year = date('Y');
        $fecha_inicio_mes = date('Y-m-d', mktime(0,0,0, $month, 1, $year));

        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        $fecha_fin_mes =  date('Y-m-d', mktime(0,0,0, $month, $day, $year));

        $datos = Venta::select('sombrero.id','sombrero.codigo',
        DB::raw('SUM(venta_detalle.sub_total) as precio_total'),
        DB::raw('SUM(venta_detalle.cantidad) as cantidad'))
            ->join('venta_detalle','venta_detalle.idVenta','=','venta.id')
            ->join('sombrero','sombrero.id','=','venta_detalle.idSombrero')
            ->whereBetween('venta.fecha',[$fecha_inicio_mes,$fecha_fin_mes])
            ->groupBy('sombrero.id', "sombrero.codigo")->get();
        
        return view ('gastronomica/sombreros/estadistica/ventas/articulo', 
            array('ventasarticulo'=>$datos));
    }

    public function indexutilidadarticulo()
    {
        # code...
        $month = date('m');
        $year = date('Y');
        $fecha_inicio_mes = date('Y-m-d', mktime(0,0,0, $month, 1, $year));

        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        $fecha_fin_mes =  date('Y-m-d', mktime(0,0,0, $month, $day, $year));

        $datos = Sombrero::select('codigo','utilidad')->get();

        return view ('gastronomica/sombreros/estadistica/utilidades/utilidades', 
            array('utilidadesarticulo'=>$datos));
    }
}
