<?php

namespace App\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Cargo;
use Image;
use File;
use Session;

class UsuarioController extends Controller
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
        $usuarios = User::select('users.id','name','email','photo','cargo')
        ->join('cargo','cargo.id','=','users.idCargo')->get();
        return view ('gastronomica/configuracion/usuarios/usuario')->with('usuario', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cargos = Cargo::pluck('cargo','id')->prepend('Seleccione el Cargo...');
        return View('gastronomica/configuracion/usuarios/create')->with('cargos', $cargos);
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
        $validar = $request->validate([
          'idCargo'=>'required|not_in:0',
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'idCargo'=>$request->idCargo,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        Session::flash('save','Se ha creado correctamente');
        return redirect()->action('Usuarios\UsuarioController@index');
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
        $usuarios = User::FindOrFail($id);
        $cargos = Cargo::FindOrFail($usuarios->idCargo);
        return View('gastronomica.configuracion.usuarios.show',array('usuario'=>$usuarios,'cargo'=>$cargos));
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
        $usuarios = User::FindOrFail($id);
        $cargos = Cargo::pluck('cargo','id')->prepend('Seleccione el Cargo...');
        return View('gastronomica/configuracion/usuarios/edit', array('cargos'=>$cargos,'usuario'=>$usuarios));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*public function foto($id)
     {
       # code...
       $usuarios = User::find($id);
       return view ('gastronomica.usuarios.foto')->with('usuario',$usuarios);
     }

     public function update_photo(Request $request)
     {
       # code...
       $foto = $request->file('photo');
       $filename = time().'.'.$foto->getClientOriginalExtension();
       Image::make($foto)->resize(320,240)->save(public_path('images/usuarios/'.$filename));
       $usuarios = User::find($request->get('id'));
       if ($usuarios->photo!="hombre.png" and $usuarios->photo!="mujer.png") {
         # code...
         File::delete('images/usuarios/'.$sombreros->photo);
       }
       $usuarios->photo = $filename;
       $usuarios->save();
       return redirect()->action('Usuarios\UsuarioController@index');
     }*/
     public function foto($id)
     {
       # code...
       $usuario = User::find($id);
       return view ('gastronomica.configuracion.usuarios.foto')->with('usuario',$usuario);
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
       return redirect()->action('Usuarios\UsuarioController@index');
     }

    public function update(Request $request, $id)
    {
        //
        $validar = $request->validate([
          'idCargo'=>'required|not_in:0',
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users,email,'.$id,
          'password' => 'required|string|min:6|confirmed',
        ]);

        User::where('id',$id)->update(['idCargo'=>$request->idCargo,'name'=>$request->name,
        'email'=>$request->email,'password'=>bcrypt($request->password)]);

        Session::flash('update','Se ha actualizado correctamente');
        return redirect()->action('Usuarios\UsuarioController@index');
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
        $usuarios = User::FindOrFail($id);
        $usuarios->delete();
        Session::flash('delete','Se ha eliminado correctamente');
        return redirect()->action('Usuarios\UsuarioController@index');
    }
}
