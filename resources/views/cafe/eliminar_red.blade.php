<!-- Formulario para editar un café-->

@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Eliminar Red Social</h1>






        @isset($redesSociales)

            <div class="form-group">

                <label for="social[]">Redes sociales</label>

                @foreach ($redesSociales as $red)
                 
             
                            <div id="row">
                                <div class="input-group m-3">
                                    <div class="input-group-prepend">

                                        <form action="{{ url('/cafe/borrar/red/' . $red->id . '/' . $red->fk_id_cafe) }}"
                                            method="post">

                                            @csrf
                                          
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btnBorrar" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                    <input id="social[]" name="social[]" type="text" value="{{ $red->link_red }}"
                                    placeholder="https://www.facebook.com/">
                                </div>
                            </div>
                @endforeach
                <div class="text-center">

                    <a href="{{ url('/cafe/' . $red->fk_id_cafe. '/edit') }}"
                        class="btn btn-primary btnEditar">Volver atrás</a>



                </div>
          
      
        @endisset

        </div>



        {{-- <form action="{{ route('restaurante.store') }}" method="POST" class="dropzone" enctype="multipart/form-data"
            id="my-great-dropzone">
            @csrf
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form> --}}

        </div>
    @endsection

@section('js')
@endsection
