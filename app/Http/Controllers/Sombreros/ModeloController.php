<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Modelos;
use App\Models\Sombrero;
use App\http\Requests\Modelo\ModeloCreateRequest;
use App\http\Requests\Modelo\ModeloUpdateRequest;
use Image;
use File;
use Session;

class ModeloController extends Controller
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
        $modelos = Modelos::paginate(5);//all()
        return view ('gastronomica/sombreros/modelos/modelo')->with('modelos', $modelos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/modelos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloCreateRequest $request)
    {
        //
        Modelos::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\ModeloController@index');
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
        $modelos = Modelos::FindOrFail($id);
        return View('gastronomica\sombreros\modelos\show')->With('modelo', $modelos);
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
        $modelos = Modelos::FindOrFail($id);
        return View('gastronomica\sombreros\modelos\edit', array('modelo'=>$modelos));
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
       $modelos = Modelos::find($id);
       return view ('gastronomica.sombreros.modelos.foto')->with('modelo',$modelos);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(320,240)->save(public_path('images/modelos/'.$filename));
       $modelos = Modelos::find($request->get('id'));
       if ($modelos->photo!="nofoto.png") {
         # code...
         File::delete('images/modelos/'.$modelos->photo);
       }
       $modelos->photo = $filename;
       $modelos->save();
       return redirect()->action('Sombreros\ModeloController@index');
     }

     public function ver($id)
     {
       # code...
       $modelos = Modelos::find($id);
       return View('gastronomica.sombreros.modelos.ver')->with('modelo',$modelos);
     }


    public function update(Request $request, $id)
    {
        //
        $validar = $request->validate([
          'modelo'=>'required|max:50|unique:modelos,modelo,'.$id,
          'photo'=>'max:50',
          'descripcion'=>'max:100',
        ]);
        //
        $modelos = Modelos::FindOrFail($id);
        $input = $request->all();
        $modelos->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\ModeloController@index');
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
        $modelos = Modelos::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idModelo','=',$modelos->id)->get();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-modelo','No se puede eliminar');
          return redirect()->action('Sombreros\ModeloController@index');
        } else {
          $modelos->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\ModeloController@index');
        }

        /*$modelos = Modelos::FindOrFail($id);
        $result = $modelos->delete();
        if ($result) {
          # code...
          return response()->json(['success'=>'true']);
        } else {
          return response()->json(['success'=>'false']);
        }*/
    }
}
