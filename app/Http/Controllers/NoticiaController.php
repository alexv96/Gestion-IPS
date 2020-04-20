<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Noticia;
use App\Imagen;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class NoticiaController extends Controller
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

        $noticias = Noticia::orderby('created_At','desc')->get();
        return view('noticias.index',compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }

        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }

        try {
            DB::beginTransaction();

            $noticia = new Noticia;
            $noticia->titulo = $request->titulo;
            $noticia->cuerpo = $request->cuerpo;
            $noticia->empleado_id = Session('idEmpleado');
            $noticia->save();

            if ($request->hasFile('imagenPrincipal')) {
                $nombreArchivo = '';
                $file = $request->imagenPrincipal;
                $nombreArchivo = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/back/img/noticias/', $nombreArchivo);

                $imagen = new Imagen;
                $imagen->ruta = $nombreArchivo;
                $imagen->noticia_id = $noticia->id_noticia;
                $imagen->save();
            }
            DB::commit();

            notify()->success('Noticia publicada exitosamente','Exito!');
            return redirect('/noticias');

        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/noticias');
        } catch (ModelNotFoundException $e){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return view('noticias.create');
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return view('/login');
        }
        
        try {
            DB::beginTransaction();

            $noticiaID = Crypt::decrypt($id);
            $noticia = Noticia::select('noticias.id_noticia','noticias.titulo','noticias.cuerpo','noticias.created_at',
                                        'imagenes.ruta','imagenes.noticia_id','empleados.nombre','empleados.apellido_paterno',
                                        'empleados.apellido_materno')
                        ->join('empleados','empleados.id_empleado','=','noticias.empleado_id')
                        ->join('imagenes','imagenes.noticia_id','=','noticias.id_noticia')
                        ->where('id_noticia','=', $noticiaID)->firstOrFail();
            DB::commit();
            return view('noticias.show',compact("noticia"));
        } catch (QueryException $e) {
            notify()->warning('Ops!! a ocurrido un problema','Error.',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/noticias');
        } catch (ModelNotFoundException $e){
            notify()->warning('Error en el modelo',  ['timeOut' => 10000]);
            DB::rollback();
            return redirect('/noticias');
        }
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
            return redirect('/login');
        }

        try {
            DB::beginTransaction();

            $noticiaID = Crypt::decrypt($id);
            $noticia = Noticia::select('noticias.id_noticia','noticias.titulo','noticias.cuerpo','noticias.created_at','noticias.updated_at',
                                        'imagenes.ruta','imagenes.noticia_id')
                        ->join('imagenes','imagenes.noticia_id','=','noticias.id_noticia')
                        ->where('id_noticia','=', $noticiaID)->firstOrFail();

            DB::commit();

            return view('noticias.edit',compact('noticia'));
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            return view('noticias.edit',compact('noticia'));
        } catch (QueryException $ex){
            notify()->danger('Error al realizar la consulta en la BD');
            return redirect('/noticias');
        }
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            notify()->info('Debe loguearse para ingresar','Acceso Restringido');
            return redirect('/login');
        }

        try {
            DB::beginTransaction();

            $noticiaID = Crypt::decrypt($id);
            $noticia = Noticia::FindOrFail($noticiaID);

            $noticia->titulo = $request->titulo;
            $noticia->cuerpo = $request->cuerpo;
            $noticia->save();

            DB::commit();
            notify()->success('Noticia modificada exitosamente','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/noticias');
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            return redirect('/noticias');
        } catch (QueryException $ex){
            notify()->danger('Error al realizar la consulta en la BD');
            return redirect('/noticias');
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
        //
    }
}
