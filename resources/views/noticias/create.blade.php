@extends('layouts.app')

@section('css')
<script src="{{ asset('back/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('noticias') }}">Administración de Noticias</a></li>
            <li class="active">Publicar Noticias</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Redactar nueva <strong>Noticia</strong>
                </header>

                <form action="{{ url('noticias') }}" method="POST" enctype="multipart/form-data">
                    <div class="panel-body">
                        <!-- MENSAJE DE ERROR-->
                        @include('alerts.error')
                        <!-- FIN MENSAJES DE ERRO -->

                        @include('noticias.form')
                    </div>
                
                    <div class="position-center">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-dot-circle-o"></i> Publicar
                            </button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-ban"></i> Limpiar
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>

    <script>
        function preview_image(event){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('mostrar-imagen');
                output.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection