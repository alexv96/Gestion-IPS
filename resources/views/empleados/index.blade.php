@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('DataTables-1.10.20/css/jquery.dataTables.min.css') }}">

@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="active">Administración de Empleados</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Administración de <strong>Empleados</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                    <div class="tools pull-right">
                        <a href="{{ url('empleados/create') }}" class="btn btn-primary"><i
                                class="fas fa-plus-circle"></i> Agregar</a>
                    </div>
                
                <!-- Fin boton agregar -->

                <table id="tabla-dtbl" class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Cargo</th>
                            <th>Estado</th>
                            <th class="pull-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->nombre}} {{$empleado->apellido_paterno}} {{ $empleado->apellido_materno}}
                            </td>
                            <td>{{ $empleado->descripcion_rol}} </td>
                            <td>{{ $empleado->descripcion_estado}} </td>
                            <td>
                                <div class=" pull-right">
                                    <a href="empleados/{{ Crypt::encrypt($empleado->id_empleado) }}/edit"
                                        data-toggle="tooltip" data-placement="top" title="Editar Empleado"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal"
                                        data-target="#eliminarModal-{{ $empleado->id_empleado }}" data-placement="top"
                                        title="Eliminar Empleado"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </section>
        </div>
    </div>
</div>

@endsection

@section('modal')

@foreach($empleados as $empleado)
<div class="modal fade" id="eliminarModal-{{$empleado->id_empleado}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Desactivar/Activar Usuario</h4>
            </div>

            {!! Form::open(['route' => ['empleados.destroy', Crypt::encrypt($empleado->id_empleado)],'method' => 'DELETE']) !!}
            @csrf
            <div class="modal-body">
                <p>¿Estas seguro que quieres activar/desactivar al empleado: <strong>{{ $empleado->nombre}}
                        {{$empleado->apellido_paterno}} {{ $empleado->apellido_materno}}</strong></p>
                <div class="form-group mt-2">

                    <select name="estado" id="estado" class="form-control">
                        @foreach ($estados as $estado)
                        <option value="{{ $estado->id_estado}}"> {{ $estado->descripcion_estado }} </option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Modificar Estado</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
@endsection

@section('js')
<script src="{{ asset('DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('back/js/main.js') }}"></script>
@endsection