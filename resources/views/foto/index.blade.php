<form action="{{ route('foto.update',$multimedia->id_multi) }}" method="post" enctype="multipart/form-data">
    @method("PATCH")
@csrf
    <div class="form-group">
        <label for="inputOwner">id</label>
        <input type="text" value="{{$multimedia->id_multi}}">
    </div>
    <div class="form-group">
        <label for="inputOwner">id</label>
        <input type="text" name="" value="{{$multimedia->link_foto}}">
    </div>
    {{-- <div class="form-group">
        <label for="inputOwner">id</label>
        <input type="text" value="{{$multimedia->fk_id_res3}}">
    </div> --}}
    <div>
        <input type="file" accept="image/*" name="link_foto" class="form-control"  >
        
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
