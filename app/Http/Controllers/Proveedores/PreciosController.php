<?php

namespace App\Http\Controllers\Proveedores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Proveedor;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Sombrero;
use App\Models\ProveedorPrecio;
use App\Models\PedidoReposicion;
use App\Models\Precios;
use App\Models\Atributos;

use App\http\Requests\ProveedorPrecio\ProveedorPrecioCreateRequest;
use Session;
use DB;

class PreciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$proveedoresprecio = ProveedorPrecio::select('proveedor_precio.id','proveedor_precio.precio',
        'proveedor.empresa','sombrero.codigo', 'sombrero.photo')->join('proveedor','proveedor.id','=',
          'proveedor_precio.idProveedor')->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')->get();*/
        //cantidades
        $cantProveedor = Proveedor::count();
        $cantSombreros = Sombrero::count();
        //lista
        $proveedores = Proveedor::select('empresa','id')->get();
        $sombreros = Sombrero::select('codigo','id','photo')->get();
        /*$sombreros = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.precio_venta',
                  'sombrero.stock_actual','sombrero.pedido_reposicion','sombrero.photo')->join('modelos','modelos.id','=','sombrero.idModelo')->join('tejidos',
                  'tejidos.id','=','sombrero.idTejido')->join('materiales','materiales.id','=','sombrero.idMaterial')->join('publicodirigido',
                  'publicodirigido.id','=','sombrero.idPublicoDirigido')->join('tallas','tallas.id','=',
                  'sombrero.idTalla')->get();*/
        return view ('gastronomica/proveedores/costos/costos', array('proveedores'=>$proveedores,
        'sombreros'=>$sombreros, 'cantidadProveedores'=>$cantProveedor,'cantidadSombreros'=>$cantSombreros));
        //'proveedoresprecio'=>$proveedoresprecio,
        //->with('proveedoresprecio', $proveedoresprecio)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');

        $imagenes = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.photo')->join('modelos','modelos.id','=',
                  'sombrero.idModelo')->join('tejidos','tejidos.id','=','sombrero.idTejido')->join('materiales',
                  'materiales.id','=','sombrero.idMaterial')->join('publicodirigido','publicodirigido.id','=',
                  'sombrero.idPublicoDirigido')->join('tallas','tallas.id','=','sombrero.idTalla')->get();
        
        //atributo ----
        $atributo = Atributos::first();
        //---
        return view('gastronomica/proveedores/costos/create', array('proveedor'=>$proveedores,
        'modelo'=>$modelos, 'tejido'=>$tejidos, 'material'=>$materiales,'publicodirigido'=>$publicosdirigido,
        'talla'=>$tallas,'atributo'=>$atributo,'imagenes'=>$imagenes));
    }

    public function mostrarCodigo($modelo_id,$tejido_id,$material_id,$publico_id,$talla_id)
    {
      # code...
      $datos = Sombrero::where('idModelo','=', $modelo_id, 'and', 'idTejido','=',$tejido_id,
            'and','idMaterial','=',$material_id,'and','idPublicoDirigido','=',$publico_id,
            'and','idTalla','=',$talla_id)->get();
      return response()->json($datos);
      /*$datos = DB::select("call pa_ingresarStockSombreros($idProveedor,$idModelo,$idTejido,$idPublico,
               $idMaterial,$idTalla,$idProveedor)");*/
    }

    /**Usando la matriz de costos */
    public function mostrarCostos(){
        $datos = ProveedorPrecio::all();
        return response()->json($datos);
    }
    
    public function nuevoCosto($idSombrero, $idProveedor, $costo){
        ProveedorPrecio::insert(['idProveedor'=>$idProveedor,'idSombrero'=>$idSombrero,'precio'=>$costo]);
        //$datos = ProveedorPrecio::select('id')->where('idProveedor','=',$idProveedor,'and','idSombrero','=',$idSombrero)->first();
        
        $sombrero = Sombrero::select('stock_actual','stock_minimo','stock_maximo','costorepmaximo')->where('id','=',$idSombrero)->first();
        if($sombrero->stock_actual <= $sombrero->stock_minimo) { //no hay stock

            /**Pedido de reposicion */

            //verificamos si tiene o no pedidos de reposicion
            $pedidosreposicion = PedidoReposicion::where('estado','=','A')->get();
            if($pedidosreposicion == ''){//no hay pedidos de reposicion
                $now = new \DateTime();
                $año =$now->format('Y');
                $fecha_actual = $now->format('Y-m-d'); //$now->format('d-m-Y H:i:s');

                $minimocosto = ProveedorPrecio::select(DB::raw('MIN(proveedor_precio.precio) as costominimo'))
                ->where('idSombrero','=',$idSombrero)->first();

                $proveedorprecio = ProveedorPrecio::select('id','idProveedor')
                    ->where('idSombrero','=',$idSombrero,'and','precio','=',$minimocosto->costominimo)->first();
                
                PedidoReposicion::insert(['idProveedorPrecio'=>$proveedorprecio->id,
                'cantidad'=>$sombrero->stock_maximo,'estado'=>'A','fecha'=>$fecha_actual]);
            } else { //si hay pedido reposicion
                $count = ProveedorPrecio::select(DB::raw('COUNT(idSombrero) as cantidad'))
                ->where('idSombrero','=',$idSombrero)->first();
                //echo("| cantidad: ".$count->cantidad);
                if($count->cantidad > 1) {//en tabla proveedorPrecio hay mas de uno del sombrero
                    //hay que buscar el minimo costo que existe el sombrero en proveedorprecio
                    //echo("| se busca proveedorprecio minimo para luego agregar en pedidoreposiciondetalle");

                    $proveedorprecio = ProveedorPrecio::where('idSombrero','=',$idSombrero)->get();
                    $minimocosto = ProveedorPrecio::select(DB::raw('MIN(proveedor_precio.precio) as costominimo'))
                    ->where('idSombrero','=',$idSombrero)->first();
                    $proveedorprecio_id = 0;
                    foreach($proveedorprecio as $pp){
                        if($pp->precio == $minimocosto->costominimo){
                            $proveedorprecio_id = $pp->id;
                        }
                    }

                    $pedidoreposiciondetalle_id = 0;
                    foreach($pedidosreposicion as $pd){
                        foreach($proveedorprecio as $p){
                            if($pd->idProveedorPrecio == $p->id){
                                $pedidoreposiciondetalle_id =  $pd->id;
                            }
                        }
                    }

                    //Modificamos pedidoreposicion
                    PedidoReposicion::where('id',$pedidoreposiciondetalle_id)->update(['idProveedorPrecio'=>$proveedorprecio_id]);
                } else {
                    $now = new \DateTime();
                    $año =$now->format('Y');
                    $fecha_actual = $now->format('Y-m-d'); //$now->format('d-m-Y H:i:s');

                    $proveedorprecio = ProveedorPrecio::all()->last();
                    PedidoReposicion::insert(['idProveedorPrecio'=>$proveedorprecio->id,
                    'cantidad'=>$sombrero->stock_maximo,'estado'=>'A','fecha'=>$fecha_actual]);
                }
            }
            /**fin reposicion */
        }
                
        $costoultimo = ProveedorPrecio::all()->last();
        $datos = ProveedorPrecio::where('id',$costoultimo->id)->get();
        return response()->json($datos);
    }

    public function editarCosto($idSombrero, $idProveedor, $costo){
        
        $preciostodo = ProveedorPrecio::where('idSombrero','=',$idSombrero)->get();
        $proveedorprecio_id = 0;//este es el id del proveedor precio que se va a editar
        foreach($preciostodo as $pp){
            if($pp->idSombrero == $idSombrero && $pp->idProveedor == $idProveedor){
                $proveedorprecio_id = $pp->id;
            }
        }
        ProveedorPrecio::where('id',$proveedorprecio_id)->update(['precio'=>$costo]);

        $sombrero = Sombrero::select('stock_actual','stock_minimo')->where('id','=',$idSombrero)->first();
        //se verifica si realmente el sombrero necesita pedido reposicion
        if($sombrero->stock_actual <= $sombrero->stock_minimo){
            //echo('proveedorprecio_id: '.$proveedorprecio_id);
            $pedidoreposicion = PedidoReposicion::where('estado','=','A')->first();
            $pedidosreposicion = PedidoReposicion::where('estado','=','A')->get();//

            if($pedidosreposicion != ''){//si hay pedido de reposicion
                //echo('| si hay pedido reposicion');
                $pedidoreposiciondetalle_id = 0;
                $costoanterior = 0;
                foreach($pedidosreposicion as $pd){
                    foreach($preciostodo as $p){
                        if($pd->idProveedorPrecio == $p->id){
                            $pedidoreposiciondetalle_id =  $pd->id;
                            $costoanterior = $p->precio;
                        }
                    }
                }
                //echo('| hay pedido reposicion del sombrero con repososicion detalle id: '.$pedidoreposiciondetalle_id);
                //echo("| costo anterior: ".$costoanterior);
                if($pedidoreposiciondetalle_id != 0){//si esta el sombrero en el pedido de reposicion
                    $count = ProveedorPrecio::select(DB::raw('COUNT(idSombrero) as cantidad'))
                    ->where('idSombrero','=',$idSombrero)->first();
                    if($count->cantidad > 1){
                        // -----------Antes: restamos los calculos con el costo anterior-------------
                        $pedidodetalle = PedidoReposicion::where('id','=',$pedidoreposiciondetalle_id)->first();
                        //restarle el costo anterio del pedido reposicion detalle
                        //$costoreposicion = $pedidoreposicion->costoreposicion - ($costoanterior * $pedidodetalle->cantidad);
                        //---------------------------------
                        //se actualiza el costo
                        
                        //buscamos el minimo costo
                        //echo("| buscamos el minimo costo");
                        $minimocosto = ProveedorPrecio::select(DB::raw('MIN(proveedor_precio.precio) as costominimo'))
                            ->where('idSombrero','=',$idSombrero)->first();
                        //luego el id del proveedorprecio del costo minimo
                        //echo("| minimocosto: ".$minimocosto);
                        $proveedorprecio = ProveedorPrecio::where('idSombrero','=',$idSombrero)->get();
                        //echo("| proveedor precio con minimo costo: ".$proveedorprecio);
                        $proveedorprecioCM_id = 0;
                        foreach($proveedorprecio as $pp){
                            if($pp->precio == $minimocosto->costominimo){
                                $proveedorprecioCM_id = $pp->id;
                            }
                        }
                        //echo("| idproveedorprecioCM: ".$proveedorprecioCM_id);
                        //Modificamos pedidoreposicion y pedidoreposiciondetalle
                        PedidoReposicion::where('id',$pedidoreposiciondetalle_id)->update(['idProveedorPrecio'=>$proveedorprecioCM_id]);
                    }
                }
                
            }
        }
        
        /**fin reposicion */
        $datos = ProveedorPrecio::select('precio')->where('id','=',$proveedorprecio_id)->get();
        return response()->json($datos);
    }

    /** */

    public function ajaxSombrero($codSombrero)
    {
      # code...
      $datos = Sombrero::where('codigo','=',$codSombrero)->get();
      return response()->json($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorPrecioCreateRequest $request)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();
        ProveedorPrecio::insert(['idProveedor'=>$request->idProveedor,
          'idSombrero'=>$sombrero->id, 'precio'=>$request->precio_compra]);
        //actualizar el precio de venta del sombrero-----
        $atributo = Atributos::first();
        $precio_con_igv = $request->precio_compra * ($atributo->igv / 100.00);
        $precio_con_margenganancia = $request->precio_compra * ($atributo->margenganancia / 100.00);
        $precio_con_servicio = $request->precio_compra * ($atributo->gastosservicios / 100.00);
        $precio_venta = $request->precio_compra + $precio_con_igv + $precio_con_margenganancia +$precio_con_servicio;
        Sombrero::where('codigo',$request->codigo)->update(['precio_venta'=>$precio_venta]);
        //---

        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Proveedores\PreciosController@index');

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
        $proeveedoresprecio = ProveedorPrecio::FindOrFail($id);
        $sombreros = Sombrero::FindOrFail($proeveedoresprecio->idSombrero);
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return View('gastronomica.proveedores.costos.edit', array('proveedorprecio'=>$proeveedoresprecio,
        'modelo'=>$modelos,'sombrero'=>$sombreros,'tejido'=>$tejidos,'material'=>$materiales,
        'publicodirigido'=>$publicosdirigido,'talla'=>$tallas,'proveedor'=>$proveedores));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorPrecioCreateRequest $request, $id)
    {
        //
        $sombrero = Sombrero::where('codigo','=',$request->codigo)->first();

        ProveedorPrecio::where('id',$id)->update(['idProveedor'=>$request->idProveedor,
          'idSombrero'=>$sombrero->id, 'precio'=>$request->precio_compra]);
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Proveedores\PreciosController@index');
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
