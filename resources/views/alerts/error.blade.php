<div >
    @if(count($errors) > 0)
    <br/>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close text-center" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif
</div>
