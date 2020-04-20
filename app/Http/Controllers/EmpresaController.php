<?php

namespace App\Http\Controllers;

use DB;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroEmpresaMail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmpresaController extends Controller
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
        try {
            DB::beginTransaction();

            $empresa = new Empresa;
            $empresa->rut_empresa = $request->rut_empresa;
            $empresa->nombre_empresa = $request->nombre_empresa;
            $empresa->direccion_empresa = $request->direccion_empresa;
            $empresa->contrasena_empresa = $request->contrasena_empresa;
            $empresa->save();

            DB::commit();

            $mensaje = 'Su código de cliente es '. $empresa->codigo_empresa;
            
            return view('presentacion.registro',compact('mensaje'));

        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return view('presentacion.registro');
            DB::rollback();
        }catch (QueryException $ex){
            return view('presentacion.registro');
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
        //
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
