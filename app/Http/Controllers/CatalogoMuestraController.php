<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use App\TipoAnalisis;
use App\AnalisisMuestra;
use App\Particular;
use App\Empresa;
use App\ResultadoAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CatalogoMuestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            return redirect('/login');
        }

        $tipoAnalisis = TipoAnalisis::orderby('nombre_analisis','asc')->get();
        
        return view('recepcion.create',compact('tipoAnalisis'));
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
            return redirect('/login');
        }

        try {
            $esEmpresa = Empresa::select('empresas.codigo_empresa')->where('empresas.codigo_empresa','=',$request->codigoCliente)->first();
            
            $muestra = new AnalisisMuestra;
            $muestra->fechaRecepcion = Carbon::parse($request->fecha_recepcion);
            $muestra->temperatura_muestra = $request->temperatura_muestra;
            $muestra->cantidad_muestra= $request->cantidad_muestra;
            $muestra->empleado_id = Session('idEmpleado');
            
            if ($esEmpresa !=null) {
                $muestra->empresa_codigoEmpresa = $request->codigoCliente;
            }else{
                $muestra->cliente_codigoCliente = $request->codigoCliente;
            }

            $muestra->save();

            // Registrar arreglo de los analisis a realizar (OBTENIDOS DEL SELECT2)
            foreach ($request->analisis as $examen) {
                $analisisMuestra = new ResultadoAnalisis;
                $analisisMuestra->muestra_id = $muestra->id_analisisMuestra;
                $analisisMuestra->tipoAnalisis_id = $examen;
                $analisisMuestra->estado_id = 1;
                $analisisMuestra->save();
            }

            notify()->success('Muestra recepcionada con exito','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/recepcion/create');

        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al ingresar');
            return redirect('/recepcion/create');
        } catch (QueryException $ex){
            notify()->error('Error al realizar la consulta en la BD');
            return redirect('/recepcion/create');
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
            return redirect('/login');
        }

        try {
            $tipoAnalisis = TipoAnalisis::orderby('nombre_analisis','asc')->get();
            DB::beginTransaction();

            $muestraID =Crypt::decrypt($id);
            $validarEmpresa = AnalisisMuestra::select('empresa_codigoEmpresa')->where('id_analisisMuestra','=', $muestraID)->firstOrFail();

            if ($validarEmpresa->empresa_codigoEmpresa == null) {
                $muestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','analisis_muestra.fechaRecepcion',
                                                'analisis_muestra.temperatura_muestra','analisis_muestra.cantidad_muestra',
                                                'analisis_muestra.empresa_codigoEmpresa','analisis_muestra.cliente_codigoCliente',
                                                'particular.rut_particular','particular.nombre_particular','particular.apellido_paterno',
                                                'particular.apellido_materno')
                                        ->join('particular','particular.id_particular','=','analisis_muestra.cliente_codigoCliente')
                                        ->where('id_analisisMuestra','=', $muestraID)->firstOrFail();

            }else{
                $muestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','analisis_muestra.fechaRecepcion',
                                                'analisis_muestra.temperatura_muestra','analisis_muestra.cantidad_muestra',
                                                'analisis_muestra.empresa_codigoEmpresa','analisis_muestra.cliente_codigoCliente',
                                                'empresas.rut_empresa','empresas.nombre_empresa')
                                        ->join('empresas','empresas.codigo_empresa','=','analisis_muestra.empresa_codigoEmpresa')
                                        ->where('id_analisisMuestra','=', $muestraID)->firstOrFail();
            }

            $analisisHacer = ResultadoAnalisis::where('resultado_analisis.muestra_id','=',$muestra->id_analisisMuestra)->get();
            
            DB::commit();
            return view('recepcion.show',compact('tipoAnalisis','muestra','analisisHacer'));
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            return redirect('/recepcion');
        } catch (QueryException $ex){
            notify()->danger('Error al realizar la consulta en la BD');
            return redirect('/recepcion');
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
            return redirect('/login');
        }

        try {
            $tipoAnalisis = TipoAnalisis::orderby('nombre_analisis','asc')->get();

            $muestraID =Crypt::decrypt($id);
            $validarEmpresa = AnalisisMuestra::select('empresa_codigoEmpresa')->where('id_analisisMuestra','=', $muestraID)->firstOrFail();

            if ($validarEmpresa->empresa_codigoEmpresa == null) {
                $muestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','analisis_muestra.fechaRecepcion',
                                                'analisis_muestra.temperatura_muestra','analisis_muestra.cantidad_muestra',
                                                'analisis_muestra.empresa_codigoEmpresa','analisis_muestra.cliente_codigoCliente',
                                                'particular.rut_particular','particular.nombre_particular','particular.apellido_paterno',
                                                'particular.apellido_materno')
                                        ->join('particular','particular.id_particular','=','analisis_muestra.cliente_codigoCliente')
                                        ->where('id_analisisMuestra','=', $muestraID)->firstOrFail();
            }else{
                $muestra = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','analisis_muestra.fechaRecepcion',
                                                'analisis_muestra.temperatura_muestra','analisis_muestra.cantidad_muestra',
                                                'analisis_muestra.empresa_codigoEmpresa','analisis_muestra.cliente_codigoCliente',
                                                'empresas.rut_empresa','empresas.nombre_empresa')
                                        ->join('empresas','empresas.codigo_empresa','=','analisis_muestra.empresa_codigoEmpresa')
                                        ->where('id_analisisMuestra','=', $muestraID)->firstOrFail();
            }
            
            return view('recepcion.edit',compact('tipoAnalisis','muestra'));

        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            DB::rollback();
            return redirect('/recepcion');
        } catch (QueryException $ex){
            notify()->danger('Error al realizar la consulta en la BD');
            DB::rollback();
            return redirect('/recepcion');
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
            return redirect('/login');
        }
        
        try {
            $tipoAnalisis = TipoAnalisis::orderby('nombre_analisis','asc')->get();

            DB::beginTransaction();

            $muestraID =Crypt::decrypt($id);
            $muestra = AnalisisMuestra::findOrFail($muestraID);

            
            $muestra->fechaRecepcion = \Carbon\Carbon::parse($request->fecha_recepcion);
            $muestra->empleado_id = Session('idEmpleado');
            $muestra->save();

            // Registrar arreglo de los analisis a realizar (OBTENIDOS DEL SELECT2)
            foreach ($request->analisis as $examen) {
                $analisisMuestra = new ResultadoAnalisis;
                $analisisMuestra->muestra_id = $muestra->id_analisisMuestra;
                $analisisMuestra->tipoAnalisis_id = $examen;
                $analisisMuestra->estado_id = 1;
                $analisisMuestra->save();
            }
            
            DB::commit();
            
            notify()->success('Muestra recepcionada con exito','Exito!!.',  ['timeOut' => 10000]);
            return redirect('/dashboard');

        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            DB::rollback();
            return redirect('/dashboard');
        } catch (QueryException $ex){
            notify()->error('Error al realizar la consulta en la BD');
            DB::rollback();
            return $ex;
            return redirect('/dashboard');
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

    public function buscarUsuario(Request $request,$id){
        if ($request->ajax()) {

            $esEmpresa = Empresa::select('empresas.codigo_empresa')->where('empresas.codigo_empresa','=',$id)->first();
            
            if ($esEmpresa !=null) {
                return Empresa::select('empresas.rut_empresa','empresas.nombre_empresa')->where('empresas.codigo_empresa','=',$id)->get();
            } else {
                return Particular::select('rut_particular','nombre_particular','apellido_paterno','apellido_materno')->where('particular.id_particular','=',$id)->get();
            }
            
        }else{
            return response()->json(['status' => false, 'message' => 'Sin permiso de acceso'], 401);
        }
    }
}
