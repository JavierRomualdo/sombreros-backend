<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tejidos;
use App\Models\Sombrero;
use App\http\Requests\Tejido\TejidoCreateRequest;
use App\http\Requests\Tejido\TejidoUpdateRequest;
use Image;
use File;
use Session;

class TejidoController extends Controller
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
        $tejidos = Tejidos::all()->take(10);//all()
        return view ('gastronomica/sombreros/tejidos/tejido')->with('tejidos', $tejidos);
    }

    public function mostrarCodigo($id){
      $datos = Tejidos::select("tejidos.codigo")->where('tejidos.id','=',$id)->get();
      return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/tejidos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TejidoCreateRequest $request)
    {
        //
        Tejidos::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\TejidoController@index');
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
        $tejidos = Tejidos::FindOrFail($id);
        return View('gastronomica\sombreros\tejidos\show')->With('tejido', $tejidos);
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
        $tejidos = Tejidos::FindOrFail($id);
        return View('gastronomica\sombreros\tejidos\edit', array('tejido'=>$tejidos));
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
       $tejidos = Tejidos::find($id);
       return view ('gastronomica.sombreros.tejidos.foto')->with('tejido',$tejidos);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(320,240)->save(public_path('images/tejidos/'.$filename));
       $tejidos = Tejidos::find($request->get('id'));
       if ($tejidos->photo!="nofoto.png") {
         # code...
         File::delete('images/tejidos/'.$tejidos->photo);
       }
       $tejidos->photo = $filename;
       $tejidos->save();
       return redirect()->action('Sombreros\TejidoController@index');
     }

     public function ver($id)
     {
       # code...
       $tejidos = Tejidos::find($id);
       return View('gastronomica.sombreros.tejidos.ver')->with('tejido',$tejidos);
     }

    public function update(Request $request, $id)
    {
        //validar
        $validar = $request->validate([
          'tejido'=>'required|max:50|unique:tejidos,tejido,'.$id,
          'photo'=>'max:50',
          'descripcion'=>'max:100',
        ]);
        //
        $tejidos = Tejidos::FindOrFail($id);
        $input = $request->all();
        $tejidos->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\TejidoController@index');
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
        $tejidos = Tejidos::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idTejido','=',$tejidos->id)->first();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-tejido','No se puede eliminar');
          return redirect()->action('Sombreros\TejidoController@index');
        } else {
          $tejidos->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\TejidoController@index');
        }

    }
}
