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
            <li class="active">Administración de Roles</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Administración de <strong>Roles</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                    <div class="tools pull-right">
                        <a data-toggle="modal" data-target="#agregarModal" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Agregar</a>
                    </div>
                
                <!-- Fin boton agregar -->

                <table id="tabla-dtbl" class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th class="pull-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->id_rol }}</td>
                            <td>{{ $rol->descripcion_rol}}</td>
                            <td>
                                <div class="table-data-feature text-center pull-right">
                                    <a class="item" data-toggle="modal" data-placement="top" data-target="#editarModal-{{ $rol->id_rol }}" href="#"><i class="fas fa-edit" title="Editar"></i></a>
                                    <a class="item" data-toggle="modal" data-placement="top" data-target="#eliminarModal-{{ $rol->id_rol }}" href="#"><i class="fas fa-trash-alt" title="Eliminar"></i></a>
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

<!-- MODAL AGREGAR -->
<div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Agregar nuevo Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => 'roles','method' => 'POST']) !!}
            @csrf
            <div class="modal-body">
                {!! Form::label('descripcion', 'Descripción Rol', ['class' => 'form-control-label']) !!}
                {!! Form::text('descripcion', null, ['class' =>'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- FIN MODAL AGREGAR -->

<!-- MODAL ACTUALIZAR -->
@foreach ($roles as $rol)
    
<div class="modal fade" id="editarModal-{{$rol->id_rol}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Editar Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           {!! Form::model($roles, ['route' => ['roles.update', Crypt::encrypt($rol->id_rol)], 'method' => 'PUT']) !!}
            @csrf
            @method('PUT')
            <div class="modal-body">
                {!! Form::label('descripcion', 'Descripción Rol', ['class' => 'form-control-label']) !!}
                {!! Form::text('descripcion', $rol->descripcion_rol, ['class' =>'form-control']) !!}
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
<!-- FIN MODAL ACTUALIZAR -->

<!-- MODAL ELIMINAR -->
@foreach ($roles as $rol)
<div class="modal fade" id="eliminarModal-{{$rol->id_rol}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Eliminar Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['roles.destroy', Crypt::encrypt($rol->id_rol)],'method' => 'DELETE']) !!}
            @csrf
            <div class="modal-body">
                <p>¿Estas seguro que quieres eliminar <strong>{{$rol->descripcion_rol}}</strong></p>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
<!-- FIN MODAL ELIMINAR -->
@endsection

@section('js')
<script src="{{ asset('DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('back/js/main.js') }}"></script>
@endsection