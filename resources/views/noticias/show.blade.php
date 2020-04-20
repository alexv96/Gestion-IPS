@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="form-w3layouts">
    <!-- Navegacion -->
    <div class=" agileinfo">
        <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('noticias') }}">Administración de Noticias</a></li>
            <li class="active">Visualizar Noticia</li>
        </ol>
    </div>
    <!-- Fin Navegacion -->

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Visualizar <strong>Noticia</strong>
                </header>

                    <div class="panel-body">
                        <div class="titular-noticia">
                            <h1>{{ $noticia->titulo }}</h1>
                            
                            <div class="fecha-autor-noticia">
                            <p><strong>Publicado:</strong> {{ $noticia->created_at->format('l jS \\of F Y h:i:s A') }} <strong>Autor: </strong>{{ $noticia->nombre }} {{$noticia->apellido_paterno}} {{$noticia->apellido_materno}}</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="{{ asset('back/img/noticias/'.$noticia->ruta) }}" alt="{{ $noticia->titulo }}" class="imagen-principal-noticia">
                        </div>
                        <div class="cuerpo-noticia">
                            {!! $noticia->cuerpo !!}
                        </div>
                    </div>
                
                    <div class="position-center">
                        <div class="text-center">
                            <a href="{{ url('noticias') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a>
                        </div>
                    </div>
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