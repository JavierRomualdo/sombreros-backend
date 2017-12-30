<?php

namespace App\Http\Controllers\Sombreros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Materiales;
use App\Models\Sombrero;
use App\http\Requests\Material\MaterialCreateRequest;
use App\http\Requests\Material\MaterialUpdateRequest;
use Image;
use File;
use Session;

class MaterialController extends Controller
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
        $materiales = Materiales::paginate(5);//all()
        return view ('gastronomica/sombreros/materiales/material')->with('materiales', $materiales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('gastronomica/sombreros/materiales/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialCreateRequest $request)
    {
        //
        Materiales::create($request->all());
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Sombreros\MaterialController@index');
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
        $materiales = Materiales::FindOrFail($id);
        return View('gastronomica\sombreros\materiales\show')->With('material', $materiales);
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
        $materiales = Materiales::FindOrFail($id);
        return View('gastronomica\sombreros\materiales\edit', array('material'=>$materiales));
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
       $materiales = Materiales::find($id);
       return view ('gastronomica.sombreros.materiales.foto')->with('material',$materiales);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(320,240)->save(public_path('images/materiales/'.$filename));
       $materiales = Materiales::find($request->get('id'));
       if ($materiales->photo!="nofoto.png") {
         # code...
         File::delete('images/materiales/'.$materiales->photo);
       }
       $materiales->photo = $filename;
       $materiales->save();
       return redirect()->action('Sombreros\MaterialController@index');
     }

     public function ver($id)
     {
       # code...
       $materiales = Materiales::find($id);
       return View('gastronomica.sombreros.materiales.ver')->with('material',$materiales);
     }
    public function update(Request $request, $id)
    {
        //
        $validar = $request->validate([
          'material'=>'required|max:50|unique:materiales,material,'.$id,
          'photo'=>'max:50',
          'descripcion'=>'max:100',
        ]);
        //
        $materiales = Materiales::FindOrFail($id);
        $input = $request->all();
        $materiales->fill($input)->save();
        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Sombreros\MaterialController@index');
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
        $materiales = Materiales::FindOrFail($id);
        $sombreros = Sombrero::select('id')->where('idMaterial','=',$materiales->id)->get();
        if ($sombreros!=null) {
          # code...
          Session::flash('error-material','No se puede eliminar');
          return redirect()->action('Sombreros\MaterialController@index');
        } else {
          $materiales->delete();
          Session::flash('delete','Se ha eliminado correctamente');
          return redirect()->action('Sombreros\MaterialController@index');
        }

    }
}
