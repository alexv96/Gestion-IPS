<?php

namespace App\Http\Controllers;

use DB;
use App\Rol;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\RolRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }

        $roles = Rol::all();
        return view('roles.index',compact('roles'));
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
    public function store(RolRequest $request)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }
        
        try {
            DB::beginTransaction();

            $nuevoRol = new Rol;
            $nuevoRol->descripcion_rol = $request->descripcion;
            $nuevoRol->save();

            DB::commit();
            notify()->success('Rol agregado exitosamente','Exito!!.',  ['timeOut' => 10000]);

            return redirect('/roles');

        } catch (QueryException $e) {
            
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/roles');

        } catch (ModelNotFoundException $ex){
            notify()->warning('Error en el modelo');
            DB::rollback();
            return redirect('/roles');
        }
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        $roles = Rol::all();
        return view('roles.index',compact('roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        $roles = Rol::all();
        try {
            DB::beginTransaction();

            $idRol = Crypt::decrypt($id);
            $rol = Rol::FindOrFail($idRol);

            $rol->descripcion_rol = $request->descripcion;
            $rol->save();

            DB::commit();
            notify()->success('Rol modificado exitosamente','Exito!', ['timeOut' => 10000]);

            return redirect('/roles');
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            DB::rollback();
            return redirect('/roles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }

        try {
            $idRol = Crypt::decrypt($id);
            DB::beginTransaction();
            $eliminar = Rol::where('id_rol','=',$idRol);
            $eliminar->delete();
            DB::commit();

            notify()->success('Rol eliminado exitosamente','Exito!', ['timeOut' => 10000]);
            return redirect('/roles');
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al eliminar rol');
            DB::rollback();
            return redirect('/roles');
        }
    }
}
