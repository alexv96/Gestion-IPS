@csrf
<div class="form-group">
    <label for="titulo">Titulo</label>
    @if(!isset( $noticia->titulo))
        <input type="text" name="titulo" id="titulo" class="form-control"/>
    @else
        <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $noticia->titulo }}"/>
    @endif
</div>

<div class="form-group">
    @if(!isset ($noticia->cuerpo))
        <textarea name="cuerpo" id="editor1" rows="10" cols="80" class="form-control"></textarea>
    @else
        <textarea name="cuerpo" id="editor1" rows="10" cols="80" class="form-control">{{ $noticia->cuerpo}}</textarea>
    @endif
</div>

<div class="form-group">
    <label for="imagen">Imagen Principal</label>
    <input type="file" name="imagenPrincipal" id="imagenPrincipal" class="form-control" accept="image/*" onchange="preview_image(event)">
</div>

<div class="form-group">
    <img class="preview-image" id="mostrar-imagen">
</div>