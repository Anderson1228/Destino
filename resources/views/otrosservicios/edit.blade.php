<!-- Formulario para editar un restaurante-->

@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('/css/form.css') }}">
  
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Editar servicio</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
        @isset($response)
            
       

        @foreach ($response as $item)
           
                    {{-- @foreach ($item['multimedia'] as $multimedia ) --}}
                        
                    

                                {{-- FORMULARIO EDITAR RESTAURANTE --}}
                                <form
                                    action="{{ url('/otrosservicios/actualizar/' . $item['otrosservicios']['id']) }}"
                                    method="post">
                                    <!--  Para evitar problemas de expiración de pagina -->

                                    @csrf

                                    {{-- <div class="form-group">
                
                            @error('inputName')
                                <p class="form-text text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}



                        <div class="form-group">
                            <label for="nombre">Nombre </label>
                            <input type="text" name="nombre" maxlength="50"
                                value="{{ $item['otrosservicios']['nombre'] }}" class="input" id="nombre"
                                placeholder="Nombre">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="number" name="telefono" value="{{ $item['otrosservicios']['telefono'] }}"
                                maxlength="10" id="telefono" placeholder="telefono">
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" value="{{ $item['otrosservicios']['direccion'] }}"
                                maxlength="50" class="input" id="direccion" placeholder="direccion">
                        </div>

                        <div class="form-group">
                            <label for="horario">Horario de atención</label>
                            <input type="text" name="horario" value="{{ $item['otrosservicios']['horario'] }}"
                                maxlength="30" id="horario" placeholder="horario">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">descripcion</label>
                            <input type="text" name="descripcion" value="{{ $item['otrosservicios']['descripcion'] }}"
                                maxlength="700" id="descripcion" placeholder="descripcion">
                        </div>
                        @foreach ($foto_otros as $foto)
                        <div class="form-group">
                            <input type="text" name="foto" value="{{ $foto->link_foto}}">
                            <a class="btn btn-info"  href="{{ route('foto.edit', $foto->id_multi) }}">Editar</a>
                        </div>
                        @endforeach



                            {{-- 
                                                        TIPOS DE RESTAURANTE --}}
                                <div class="form-group">
                                                
                                    @isset($otrosTypeArray)
                                
                            <label for="tiposservicio">Tipo de servicio</label>
                            
                            <select id="tiposservicio" name="tiposservicio" onchange="selectionType();">
                            @foreach ($otrosTypeArray as $type)
                                @if ($item['otrosservicios']['tiposservicio'] == $type['id'])
                                <option value="{{ $type['id'] }}" selected>{{ $type['nombre'] }}</option>
                                @else
                                <option value="{{ $type['id'] }}">{{ $type['nombre'] }}</option>
                                @endif
                            @endforeach
                            @endisset
        
                        </select>
                                        
                                       
                                        
                                </div>                                                
                <div class="form-group">
                </div>
            
                <div class="divCenter">
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="center btn btn-primary">Enviar</button>
                </div>
    @endforeach
    {{-- @endforeach --}}
    @endisset
    </form>
    {{-- <form action="{{ route('restaurante.store') }}" method="POST" class="dropzone" enctype="multipart/form-data"
            id="my-great-dropzone">
            @csrf
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form> --}}

    </div>
@endsection
{{-- ADD DROPZONE JS  !OPTIONAL! --}}
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"
        integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        Dropzone.options.myGreatDropzone = { // camelized version of the `id`
            paramName: "imagen", // The name that will be used to transfer the file
            maxFilesize: 10, // MB
            dictDefaultMessage: "Arrastre las imagenes del restaurante aquí",
            maxFiles: 3,
            acceptedFiles: "image/*",

        };
    </script>

@endsection


{{-- Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "imagen", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    dictDefaultMessage: "Arrastre las imagenes del restaurante aquí",
    maxFiles: 3,
    acceptedFiles: "image/*",

}; --}}
