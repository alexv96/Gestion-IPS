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
            <li class="active">Administración de Noticias</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Administración de <strong>Noticias</strong>
                </header>

                <!-- Boton agregar -->
                <div class="panel-body">
                    <div class="tools pull-right">
                        <a href="{{ url('noticias/create') }}" class="btn btn-primary"><i
                                class="fas fa-plus-circle"></i> Publicar nueva Noticia</a>
                    </div>

                    <!-- Fin boton agregar -->

                    <table id="empleados" class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <th>Titular</th>
                                <th>Fecha Publicación</th>
                                <th class="pull-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($noticias as $noticia)
                            <tr>
                                <td>{{ $noticia->titulo}}</td>
                                <td>{{ $noticia->created_at}} </td>
                                <td>{{ $noticia->descripcion_estado}} </td>
                                <td>
                                    <div class=" pull-right">
                                        <a href="noticias/ {{ Crypt::encrypt($noticia->id_noticia) }}" data-toggle="tooltip" data-placement="top" title="Ver Noticia">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="noticias/{{ Crypt::encrypt($noticia->id_noticia) }}/edit" data-toggle="tooltip" data-placement="top" title="Editar Noticia">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#eliminarModal-{{ $noticia->id_noticia }}" data-placement="top" title="Eliminar Noticia">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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


@endsection

@section('js')
<script src="{{ asset('DataTables-1.10.20/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('back/js/main.js') }}"></script>
@endsection