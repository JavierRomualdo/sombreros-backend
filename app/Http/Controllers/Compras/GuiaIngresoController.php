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
        //
        $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia","guia_ingreso.fecha",
          DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad'),'proveedor.empresa')
          ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
          ->join('proveedor','proveedor.id','=','guia_ingreso.idProveedor')
          ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia', 'guia_ingreso.fecha',
          'proveedor.empresa')->get();
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
        Session::flash('save','Eliga el modelo de sombrero, el proveedor e ingresar la cantidad.');
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return view('gastronomica/sombreros/guiaingreso/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas));
    }

    public function mostrarNumeroGuia($cod)
    {
      # code...
      $datos = GuiaIngreso::all()->last()->get();
      return response()->json($datos);
    }

    public function guardarGuia($tipo,$codigo,$idProveedor,$cantidad,$descripcion)
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
        //echo($año." - ".$cantidad.'..'.substr($año,2,2));
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
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
          if ($descripcion=="0") {
            # code...
            GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idSombrero'=>$sombrero->id,
            'cantidad'=>$cantidad]);
          } else {
            GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idSombrero'=>$sombrero->id,
            'cantidad'=>$cantidad, 'descripcion'=>$descripcion]);
          }


          //Modificamos el stock actual del sombrero
          Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$cantidad+$sombrero->stock_actual]);

          Session::flash('save','Se ha guardado correctamente');
        } else {
          //se ha excedido
          Session::flash('save','Se ha excedido el numero de ordenes de compra');
        }
      } else {//guardar solo en la tabla orden compra detalle
        $sombrero = Sombrero::where('codigo','=',$codigo)->first();
        $guias = GuiaIngreso::all()->last();//ultimo registro de la tabla orden _compra
        if ($descripcion=="0") {
          # code...
          GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idSombrero'=>$sombrero->id,
          'cantidad'=>$cantidad]);
        } else {
          GuiaIngresoDetalle::insert(['idGuiaIngreso'=>$guias->id,'idSombrero'=>$sombrero->id,
          'cantidad'=>$cantidad, 'descripcion'=>$descripcion]);
        }
        //Modificamos el stock actual del sombrero
        Sombrero::where('codigo',$codigo)->update(['stock_actual'=>$cantidad+$sombrero->stock_actual]);

        Session::flash('save','Se ha guardado correctamente');
      }
      $guiasIngreso = GuiaIngreso::all()->last();
      //estod datos pasan a la TABLA
      $datos = GuiaIngresoDetalle::select("sombrero.codigo","sombrero.photo","guia_ingreso_detalle.idGuiaIngreso",
        "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.descripcion")
        ->join('sombrero','sombrero.id','=','guia_ingreso_detalle.idSombrero')
        ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
        ->where('guia_ingreso_detalle.idGuiaIngreso','=',$guiasIngreso->id)->get();

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
       $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia","guia_ingreso.fecha",
         DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad'),'proveedor.empresa')
         ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
         ->join('proveedor','proveedor.id','=','guia_ingreso.idProveedor')
         ->where('guia_ingreso.id','=',$id)
         ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia', 'guia_ingreso.fecha',
         'proveedor.empresa')->first();

         $detalles = GuiaIngresoDetalle::select("sombrero.codigo","sombrero.photo","guia_ingreso_detalle.idGuiaIngreso",
           "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.descripcion")
           ->join('sombrero','sombrero.id','=','guia_ingreso_detalle.idSombrero')
           ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
           ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();

       return View('gastronomica.sombreros.guiaingreso.ver',array('guia'=>$guias,'detalles'=>$detalles));
     }

     public function reporte($id)
     {
       # code...
       $guias = GuiaIngreso::select("guia_ingreso.id","guia_ingreso.numero_guia","guia_ingreso.fecha",
         DB::raw('SUM(guia_ingreso_detalle.cantidad) as cantidad'),'proveedor.empresa')
         ->join('guia_ingreso_detalle','guia_ingreso_detalle.idGuiaIngreso','=','guia_ingreso.id')
         ->join('proveedor','proveedor.id','=','guia_ingreso.idProveedor')
         ->where('guia_ingreso.id','=',$id)
         ->groupBy('guia_ingreso.id','guia_ingreso.numero_guia', 'guia_ingreso.fecha',
         'proveedor.empresa')->first();

         $detalles = GuiaIngresoDetalle::select("sombrero.codigo","sombrero.photo","guia_ingreso_detalle.idGuiaIngreso",
           "guia_ingreso_detalle.cantidad", "guia_ingreso_detalle.descripcion")
           ->join('sombrero','sombrero.id','=','guia_ingreso_detalle.idSombrero')
           ->join('guia_ingreso','guia_ingreso.id','=','guia_ingreso_detalle.idGuiaIngreso')
           ->where('guia_ingreso_detalle.idGuiaIngreso','=',$id)->get();

       $pdf = PDF::loadView('reportes/guiaingreso',['guia'=>$guias,'detalles'=>$detalles]);
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
