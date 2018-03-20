<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Cargo;
use Image;
use File;
use Session;

class PerfilController extends Controller
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

    public function index($id)
    {
        //
    }

    public function indexPerfil($id){
        $usuarios = User::FindOrFail($id);
        $cargos = Cargo::FindOrFail($usuarios->idCargo);
        return View('gastronomica.perfil.perfil',array('usuario'=>$usuarios,'cargo'=>$cargos));
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

    public function editPerfil($id)
    {
        $usuarios = User::FindOrFail($id);
        $cargos = Cargo::select('cargo')->where('cargo.id','=',$usuarios->idCargo)->first();
        return View('gastronomica/perfil/edit', array('cargo'=>$cargos,'usuario'=>$usuarios));
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
       $usuario = User::find($id);
       return view ('gastronomica.perfil.foto')->with('usuario',$usuario);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(400,400)->save(public_path('images/usuarios/'.$filename));
       $usuarios = User::find($request->get('id'));
       if ($usuarios->photo!="nouser.jpg") {
         # code...
         File::delete('images/usuarios/'.$usuarios->photo);
       }
       $usuarios->photo = $filename;
       $usuarios->save();
       return redirect()->action('Usuarios\PerfilController@indexPerfil',$request->get('id'));
     }

     public function updatePerfil(Request $request, $id){
        $validar = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'required|string|min:6|confirmed',
          ]);
  
          User::where('id',$id)->update(['name'=>$request->name,
          'email'=>$request->email,'password'=>bcrypt($request->password)]);
  
          Session::flash('update','Se ha actualizado correctamente');
          return redirect()->action('Usuarios\PerfilController@indexPerfil',$id);
     }

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
