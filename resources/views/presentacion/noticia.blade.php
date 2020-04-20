@include('presentacion.menu')

<!--contact-->
<div class="container">
    <div class="contact">
        <div class="contact-top">
            <h2>{{$noticia->titulo}}</h2>
        </div>
        <div class="fecha-noticia">
            <p><strong>Publicado:</strong> {{ $noticia->created_at->format('d-m-Y') }} <div class="autor-noticia"><strong>Autor: </strong>{{ $noticia->nombre }} {{$noticia->apellido_paterno}} {{$noticia->apellido_materno}}</div></p>
        </div>
    </div>
    <div class="text-center">
        <img src="{{ asset('back/img/noticias/'.$noticia->ruta) }}" alt="{{ $noticia->titulo }}"
            class="imagen-principal-noticia">
    </div>
    <div class="cuerpo-noticia">
        {!! $noticia->cuerpo !!}
    </div>

    <!-- OTRAS NOTICIAS SLIDE -->
    <div class="post-slider">
        <h1 class="slider-title">Otras noticias</h1>
        <i class="fas fa-chevron-left prev"></i>
        <i class="fas fa-chevron-right next"></i>
        
        <div class="post-wrapper">
            @foreach ($ultimosPost as $post)
            <div class="post">
                <img src="{{ asset('back/img/noticias/'.$post->ruta)}}" class="slider-image img-responsive" alt="">
                <div class="post-info">
                    <h4><a href="/noticia/{{$post->id_noticia}}">{{$post->titulo}} </a></h4>
                    <i class="far fa-calendar"> {{$post->created_at->format('d-m-Y')}}</i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- FIN OTRAS NOTICIAS -->
</div>
</div>

@include('presentacion.footer')