<?php

namespace App\Http\Controllers\Temporada;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Temporada;
use App\Models\Sombrero;
use App\http\Requests\Temporada\TemporadaCreateRequest;
use Image;
use File;
use Session;

class TemporadaController extends Controller
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
        $temporadas = Temporada::all();//all()
        return view ('gastronomica/configuracion/temporadas/temporada')->with('temporadas', $temporadas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/configuracion/temporadas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemporadaCreateRequest $request)
    {
        //
        Temporada::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Temporada\TemporadaController@index');
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
        $temporadas = Temporada::FindOrFail($id);
        return View('gastronomica\configuracion\temporadas\edit', array('temporada'=>$temporadas));
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
       $temporadas = Temporada::find($id);
       return view ('gastronomica.configuracion.temporadas.foto')->with('temporada',$temporadas);
     }

    public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(1200,800)->save(public_path('images/temporadas/'.$filename));
       $temporadas = Temporada::find($request->get('id'));
       if ($temporadas->photo!="nofoto.png") {
         # code...
         File::delete('images/temporadas/'.$temporadas->photo);
       }
       $temporadas->photo = $filename;
       $temporadas->save();
       return redirect()->action('Temporada\TemporadaController@index');
     }

     public function ver($id)
     {
       # code...
       $temporadas = Temporada::find($id);
       return View('gastronomica.configuracion.temporadas.ver')->with('temporada',$temporadas);
     }

    public function update(Request $request, $id)
    {
        //
        $validar = $request->validate([
            'temporada'=>'required|max:50|unique:temporada,temporada,'.$id,
            'photo'=>'max:50',
            'fecha_inicio'=>'required',
            'fecha_fin'=>'required',
            'descripcion'=>'max:100',
        ]);
        //
        $temporadas = Temporada::FindOrFail($id);
        $input = $request->all();
        $temporadas->fill($input)->save();

        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Temporada\TemporadaController@index');
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
