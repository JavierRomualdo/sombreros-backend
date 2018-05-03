<?php

namespace App\Http\Controllers\Pedidos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sombrero;
use App\Models\Materiales;
use App\Models\Tejidos;
use App\Models\PublicoDirigido;
use App\Models\Modelos;
use App\Models\Tallas;
use App\Models\Proveedor;
use App\Models\ProveedorPrecio;
use App\Models\PedidoReposicion;
use App\Models\PedidoReposicionDetalle;
use App\Models\Atributos;
use DB;

class PedidoReposicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidoscab = PedidoReposicion::select(
        DB::raw('SUM(proveedor_precio.precio * pedidoreposicion.cantidad) as costoreposicion'),
        DB::raw('SUM(pedidoreposicion.cantidad) as cantidadtotal'))
        ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposicion.idProveedorPrecio')
        ->where('pedidoreposicion.estado','=','A')->first();
        
        //echo($pedidoscab->costoreposicion);
        //return response()->json($pedidos);
        $pedidosreposicion = PedidoReposicion::select('cantidad','cantidadorden','sombrero.photo','sombrero.codigo',
        'sombrero.stock_actual','sombrero.stock_minimo','proveedor.empresa','proveedor_precio.precio')
        ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposicion.idProveedorPrecio')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->where('pedidoreposicion.estado','=','A')->get();

        
        //$pedidosreposicion = PedidoReposicion::where('estado','=','A')->get();
        $parametros = Atributos::select('costorepmaximo','costoserviciorep')->first();
        return view ('gastronomica/sombreros/pedidosreposicion/pedidoreposicion',
        array('pedido'=>$pedidoscab,'pedidosreposicion'=>$pedidosreposicion,'parametros'=>$parametros));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ver($id){
        $pedidosreposicion = PedidoReposicion::where('id','=',$id)->first();

        $pedidosreposiciondetalle = PedidoReposicionDetalle::select('cantidad','cantidadorden','sombrero.photo','sombrero.codigo',
        'sombrero.stock_actual','sombrero.stock_minimo','proveedor.empresa','proveedor_precio.precio')
        ->join('pedidoreposicion','pedidoreposicion.id','=','pedidoreposiciondetalle.idPedidoReposicion')
        ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposiciondetalle.idProveedorPrecio')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->where('pedidoreposiciondetalle.estado','=','A')->get();

        return View('gastronomica.sombreros.pedidosreposicion.ver',array('pedido'=>$pedidosreposicion,'detalles'=>$pedidosreposiciondetalle));
    }

    public function mostrarPedidoReposicionDetalle()
    {
        # code...
        $datos = PedidoReposicion::select('pedidoreposicion.id','cantidad','cantidadorden','sombrero.photo','sombrero.codigo',
        'sombrero.stock_actual','sombrero.stock_minimo','proveedor.empresa','proveedor_precio.precio')
        ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposicion.idProveedorPrecio')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->where('pedidoreposicion.estado','=','A')->get();

        return response()->json($datos);
    }

    public function mostrarDatosSombreroOC($idPedidoReposicion)
    {
        # code...
        $datos = PedidoReposicion::select('cantidad','cantidadorden','sombrero.codigo','sombrero.idModelo','sombrero.idTejido','sombrero.idMaterial',
        'sombrero.idPublicoDirigido','sombrero.idTalla','sombrero.stock_actual','proveedor_precio.idProveedor','proveedor_precio.precio')
        ->join('proveedor_precio','proveedor_precio.id','=','pedidoreposicion.idProveedorPrecio')
        ->join('proveedor','proveedor.id','=','proveedor_precio.idProveedor')
        ->join('sombrero','sombrero.id','=','proveedor_precio.idSombrero')
        ->where('pedidoreposicion.id','=',$idPedidoReposicion)->get();
        return response()->json($datos);
    }

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
