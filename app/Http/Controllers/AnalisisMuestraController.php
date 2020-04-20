<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Carbon\Carbon;
use App\AnalisisMuestra;
use App\TipoAnalisis;
use App\EstadoResultado;
use App\ResultadoAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResultadosMuestraMail;

class AnalisisMuestraController extends Controller
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
        if (!Session::has('correo') && !Session::has('contrasena')) {
            return redirect('/login');
        }
        
        try {
            $muestraID = Crypt::decrypt($id);
            $resultado2 = ResultadoAnalisis::where('muestra_id','=',$muestraID)->count();
            $resultadoAnalisis = ResultadoAnalisis::select('resultado_analisis.muestra_id','tipo_analisis.nombre_analisis',
                                                        'resultado_analisis.estado_id','resultado_analisis.PPM')
                                                ->join('analisis_muestra','analisis_muestra.id_analisisMuestra','=','resultado_analisis.muestra_id')
                                                ->join('tipo_analisis','tipo_analisis.id_tipoAnalisis','=','resultado_analisis.tipoAnalisis_id')
                                                ->where('resultado_analisis.muestra_id','=',$muestraID)
                                                ->get();

            $muestraCliente = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','analisis_muestra.cliente_codigoCliente',
                                                    'analisis_muestra.empresa_codigoEmpresa','resultado_analisis.muestra_id')
                                                    ->join('resultado_analisis','resultado_analisis.muestra_id','=','analisis_muestra.id_analisisMuestra')
                                                    ->where('resultado_analisis.muestra_id','=',$muestraID)
                                                    ->groupBy('resultado_analisis.muestra_id')
                                                    ->first();
            $estados = EstadoResultado::where('id_estadoResultado','=',3)->get();

            return view('analisis.edit',compact('resultadoAnalisis','estados','muestraCliente','resultado2'));
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            DB::rollback();
            return redirect('/dashboard');
        } catch (QueryException $ex){
            notify()->error('Error al realizar la consulta en la BD');
            DB::rollback();
            return redirect('/dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (!Session::has('correo') && !Session::has('contrasena')) {
            return redirect('/login');
        }

        try{
            DB::beginTransaction();
            $muestraID = Crypt::decrypt($id);
            $resultadoEditar = ResultadoAnalisis::where('muestra_id','=',$muestraID)->get(); 
            
            //Tamño del request.
            $tamaño = count($request->ppm);

            //Agregar ID a un arreglo
            foreach ($resultadoEditar as $value) {
                $array[] = $value->ID;
            }

            //Obtener tamaño de Arreglo de objeto-
            $tamañoObjeto = count($array);
            
            //Recorrear arreglo de objeto y de request juntos.
            for ($i=0; $i < $tamaño ; $i++) { 
                for ($i=0; $i < $tamañoObjeto; $i++) { 
                    
                    if ($request->ppm[$i] == null) {
                        DB::update('update resultado_analisis set estado_id = ?, empleado_rut = ? where ID = ?', [2,Session('idEmpleado'),$array[$i]]);
                    }else{
                        DB::update('update resultado_analisis set PPM = ?, estado_id = ?,fecha_registro = ?, empleado_rut = ? where ID = ?', [$request->ppm[$i],3,Carbon::now(),Session('idEmpleado'),$array[$i]]);
                    }
                }
            }

            $esEmpresa = AnalisisMuestra::select('analisis_muestra.empresa_codigoEmpresa')
                            ->where('analisis_muestra.id_analisisMuestra','=',$muestraID)
                            ->where('analisis_muestra.empresa_codigoEmpresa','=',$request->codigo)->exists();
            if ($esEmpresa) {
                DB::commit();
                notify()->success('Muestra recepcionada con exito','Exito!!.',  ['timeOut' => 10000]);
                return redirect('/dashboard');
            }else{

                $enviarEmail = AnalisisMuestra::select('analisis_muestra.id_analisisMuestra','particular.email')
                                ->join('particular','particular.id_particular','=','analisis_muestra.cliente_codigoCliente')
                                ->where('analisis_muestra.id_analisisMuestra','=',$muestraID)->firstOrFail();            
                
                $data = new \stdClass();
                $data->codigo = $enviarEmail->id_analisisMuestra;
                Mail::to($enviarEmail->email)->send(new ResultadosMuestraMail($data));
                

            DB::commit();
                notify()->success('Muestra recepcionada con exito','Exito!!.',  ['timeOut' => 10000]);
                return redirect('/dashboard');
            }
        } catch (ModelNotFoundException $e) {
            notify()->warning('Error al modificar');
            DB::rollback();
            return redirect('/dashboard');
        } catch (QueryException $ex){
            notify()->error('Error al realizar la consulta en la BD');
            DB::rollback();
            return redirect('/dashboard');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}