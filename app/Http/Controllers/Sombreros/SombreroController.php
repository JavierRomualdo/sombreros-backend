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
use App\Models\ProveedorPrecio;
use App\Models\Movimientos;
use App\http\Requests\Sombreros\SombreroCreateRequest;
use App\http\Requests\Sombreros\SombreroUpdateRequest;
use DB;
use Image;
use File;
use Session;

class SombreroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
       # code...
       $this->middleware('auth');
     }

    public function index()
    {
        //
        //$sombreros = Sombrero::all();
        $sombreros = Sombrero::
                select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material',
                  'publicodirigido.publico','tallas.talla','sombrero.precio_venta',
                  'sombrero.stock_actual','sombrero.pedido_reposicion','sombrero.photo')->join('modelos','modelos.id','=','sombrero.idModelo')->join('tejidos',
                  'tejidos.id','=','sombrero.idTejido')->join('materiales','materiales.id','=','sombrero.idMaterial')->join('publicodirigido',
                  'publicodirigido.id','=','sombrero.idPublicoDirigido')->join('tallas','tallas.id','=',
                  'sombrero.idTalla')->get();//->get() ->take(10)
        //'proveedor_precio.precio'
        //join('proveedor_precio','proveedor_precio.idSombrero','=','sombrero.id')
        return view ('gastronomica/sombreros/sombreros/sombrero')->with('sombreros', $sombreros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function verSombrero()
     {
       # code...
       return view ('gastronomica/sombreros/sombreros/verSombrero');
     }
    public function create()
    {
        //
        Session::flash('save','Recuerde: Para generar el código del sombrero debe seleccionar (modelo,
        tejido, material, publico dirigido y talla).');
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        //$proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return View('gastronomica.sombreros.sombreros.create', array('modelo'=>$modelos, 'tejido'=>$tejidos,
            'material'=>$materiales,'publicodirigido'=>$publicosdirigido,'talla'=>$tallas));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SombreroCreateRequest $request)
    {
        //Para guardar foto
        /*$foto = $request->file('photo');
        $filename = time().'.'.$foto->getClientOriginalExtension();
        Image::make($foto)->resize(320,240)->save(public_path('images/sombreros/'.$filename));*/
        //
        /*//este esta bien el codigo de la consulta insertar
        $sombreros =
        DB::insert('insert into sombrero (idProveedor, idModelo, idTejido, idPublicoDirigido, idMaterial,
          idTalla, codigo, stock_minimo, stock_maximo) values(?,?,?,?,?,?,?,?,?)',[$request->idProveedor,
          $request->idModelo,$request->idTejido,$request->idPublicoDirigido,$request->idMaterial,
          $request->idTalla,$request->codigo,$request->stock_minimo,$request->stock_maximo]);*/

        /*$request->precio_compra=0;
        $request->precio_venta=0;
        $request->stock_actual=0;
        $request->stock_maximo=0;
        $request->stock_minimo=0;
        Sombrero::create($request->all());*/
        Sombrero::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\SombreroController@index');
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
        $sombreros = Sombrero::FindOrFail($id);
        $modelos = Modelos::FindOrFail($sombreros->idModelo);
        $tejidos = Tejidos::FindOrFail($sombreros->idTejido);
        $materiales = Materiales::FindOrFail($sombreros->idMaterial);
        $publicosdirigido = PublicoDirigido::FindOrFail($sombreros->idPublicoDirigido);
        $tallas = Tallas::FindOrFail($sombreros->idTalla);
        //$proveedor_precio = ProveedorPrecio::select("proveedor.idProveedor")
        //->where("proveedor_precio.idSombrero","=",$id)->first();
        //$proveedores = Proveedor::FindOrFail($proveedor_precio->idProveedor);

        return View('gastronomica.sombreros.sombreros.show', array('sombrero'=>$sombreros,'modelo'=>$modelos, 'tejido'=>$tejidos,
            'material'=>$materiales,'publicodirigido'=>$publicosdirigido,'talla'=>$tallas));
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
        $sombreros = Sombrero::FindOrFail($id);
        $modelos = Modelos::pluck('modelo','id')->prepend('Seleccione el Modelo...');
        $tejidos = Tejidos::pluck('tejido','id')->prepend('Seleccione el Tejido...');
        $materiales = Materiales::pluck('material','id')->prepend('Seleccione el Material...');
        $publicosdirigido = PublicoDirigido::pluck('publico','id')->prepend('Seleccione Publico...');
        $tallas = Tallas::pluck('talla','id')->prepend('Seleccione la Talla...');
        $proveedores = Proveedor::pluck('empresa','id')->prepend('Seleccione Proveedor...');
        return View('gastronomica.sombreros.sombreros.edit', array('sombrero'=>$sombreros,'modelo'=>$modelos, 'tejido'=>$tejidos,
            'material'=>$materiales,'publicodirigido'=>$publicosdirigido,'talla'=>$tallas,'proveedor'=>$proveedores));
    }

    public function ver($id)
    {
      # code...
      $sombreros = Sombrero::select('sombrero.id', 'sombrero.codigo', 'modelos.modelo', 'tejidos.tejido', 'materiales.material','sombrero.stock_minimo',
        'publicodirigido.publico','tallas.talla','sombrero.precio_venta', 'sombrero.utilidad', 'sombrero.stock_maximo',
        'sombrero.stock_actual','sombrero.pedido_reposicion','sombrero.photo')
        ->join('modelos','modelos.id','=','sombrero.idModelo')
        ->join('tejidos','tejidos.id','=','sombrero.idTejido')
        ->join('materiales','materiales.id','=','sombrero.idMaterial')
        ->join('publicodirigido','publicodirigido.id','=','sombrero.idPublicoDirigido')
        ->join('tallas','tallas.id','=','sombrero.idTalla')
        ->where('sombrero.id','=',$id)->first();
      return View('gastronomica.sombreros.sombreros.ver', array('sombrero'=>$sombreros));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function foto($id)
     {
       # code...
       $sombreros = Sombrero::find($id);
       return view ('gastronomica.sombreros.sombreros.foto')->with('sombrero',$sombreros);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(320,240)->save(public_path('images/sombreros/'.$filename));
       $sombreros = Sombrero::find($request->get('id'));
       if ($sombreros->photo!="nofoto.png") {
         # code...
         File::delete('images/sombreros/'.$sombreros->photo);
       }
       $sombreros->photo = $filename;
       $sombreros->save();
       return redirect()->action('Sombreros\SombreroController@index');
     }
    public function update(Request $request, $id)
    {
        //
        $validar = $request->validate([
          'idModelo'=>'required|not_in:0',
          'idTejido'=>'required|not_in:0',
          'idPublicoDirigido'=>'required|not_in:0',
          'idMaterial'=>'required|not_in:0',
          'idTalla'=>'required|not_in:0',
          'codigo'=>'required|min:13|max:13|unique:sombrero,codigo,'.$id,
          'stock_minimo'=>'required',
          'stock_maximo'=>'required',
          'precio_venta'=>'required',
        ]);
        //
        $sombreros = Sombrero::FindOrFail($id);
        //File::delete('images/sombreros/'.$sombreros->photo);//
        $input = $request->all();
        $sombreros->fill($input);
        //$sombreros->photo = $filename;//
        $sombreros->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\SombreroController@index');
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

        $sombreros = Sombrero::FindOrFail($id);
        $movimientos = Movimientos::select('id')->where('idProducto','=',$id)->first();
        if ($movimientos!=null) {
          # code...
          Session::flash('error','No se puede eliminar');
          return redirect()->action('Sombreros\SombreroController@index');
        } else {
          File::delete('images/sombreros/'.$sombreros->photo);
          $sombreros->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\SombreroController@index');
        }
    }
}
