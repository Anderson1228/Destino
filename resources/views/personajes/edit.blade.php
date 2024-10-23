<!-- Formulario para editar un personaje-->

@extends('theme.base')



@section('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')

    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar Personaje Historico</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
       
        @isset($response)
            
       
        @foreach ($response['personaje'] as $item)

        

                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/personaje/actualizar/' . $item['id_personaje']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                  


                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input  type="text" name="nombre" maxlength="80" value="{{ $item['nombre'] }}"
                                class="input" id="nombre" placeholder="Nombre Personaje">
                                <br>
                    @error('nombre')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>

                     
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha nacimiento</label><br>
                            <em class="spanhide">La estructura de la fecha es: año-mes-dia</em>
                            <input type="text" name="fecha_nacimiento" value="{{ $item['fecha_nacimiento'] }}" maxlength="15"
                                class="input" id="fecha_nacimiento" placeholder="1998-02-17">
                                <br>
                    @error('fecha_nacimiento')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            {{-- <input type="text" name="descripcion" maxlength="550" value="{{ $item['descripcion'] }}"
                                class="input" id="descripcion" placeholder="Descripción"> --}}

                                <textarea value="ñññ" name="descripcion" maxlength="550" cols="10" rows="5"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="descripcion" placeholder="Descripción">{{ $item['descripcion'] }}</textarea>
                                <br>
                    @error('descripcion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>
                        @foreach ($foto_personajes as $foto)
                        <div class="form-group">

                            <input type="text" name="foto" value="{{ $foto->link_foto}}">
                            <a class="btn btn-info"  href="{{ route('foto.edit', $foto->id_multi) }}">Editar</a>
                        </div>
                        @endforeach
                       

            <br><br>
            <div class="divCenter">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="center btn btn-primary">Enviar</button>
                <br><br><br>
            </div>
        @endforeach
        @endisset
        </form>
       

    </div>
@endsection
{{-- ADD DROPZONE JS  !OPTIONAL! --}}
@section('js')
@endsection


{{-- Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "imagen", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    dictDefaultMessage: "Arrastre las imagenes del restaurante aquí",
    maxFiles: 3,
    acceptedFiles: "image/*",

}; --}}
