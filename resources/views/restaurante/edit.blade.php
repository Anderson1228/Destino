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



        <h1> Editar Restaurante</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
        @isset($response)
            
       

        @foreach ($response as $item)
            @foreach ($item['ruta'] as $ruta)
                @foreach ($item['plato'] as $plato)

                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/rest/actualizar/' . $item['restaurante']['id_res'] . '/' . $ruta['id_ruta'] . '/' . $plato['id_plato']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                        {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}



                        <div class="form-group">
                            <label for="nameRestaurant">Nombre restaurante</label>
                            <input type="text" name="nameRestaurant" maxlength="50"
                                value="{{ $item['restaurante']['nombre'] }}" class="input" id="nameRestaurant"
                                placeholder="Nombre Restaurante">
                        </div>
                        <div class="form-group">
                            <label for="inputOwner">Propietario</label>
                            <input type="text" name="inputOwner" maxlength="50"
                                value="{{ $item['restaurante']['nombre_propietario'] }}" class="input"
                                id="inputOwner" placeholder="Nombre Propietario">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" name="inputAddress" value="{{ $item['restaurante']['direccion'] }}"
                                maxlength="50" class="input" id="inputAddress" placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Teléfono</label>
                            <input type="number" name="inputPhone" value="{{ $item['restaurante']['telefono'] }}"
                                maxlength="10" id="inputPhone" placeholder="Telefono">
                        </div>
                        
                        <div class="form-group">
                            <label for="inputHorario">Horario de atención</label>
                            <input type="text" name="inputHorario" value="{{ $item['restaurante']['horario_atencion'] }}"
                                maxlength="30" id="inputHorario" placeholder="Horario De Atención">
                        </div>

{{-- 
                            TIPOS DE RESTAURANTE --}}
                        <div class="form-group">
               

                            @isset($restaurantTypeArray)
                                
                            <label for="typeRestaurant">Tipo de restaurante</label>
                            
                            <select id="typeRestaurant" name="typeRestaurant" onchange="selectionType();">
                            @foreach ($restaurantTypeArray as $type)
                                @if ($item['restaurante']['fk_id_tipo_res'] == $type['id_tipo_res'])
                                <option value="{{ $type['id_tipo_res'] }}" selected>{{ $type['nombre'] }}</option>
                                @else
                                <option value="{{ $type['id_tipo_res'] }}">{{ $type['nombre'] }}</option>
                                @endif
                            @endforeach
                            @endisset
        
                        </select>
                    {{-- <span id="pruebaid"></span> --}}
                    {{-- <a href="{{url('/rest/registrar/tipo')}}">Editar tipo de restaurante</a> --}}
                    </div>
                        {{-- MASCOTAS --}}
                        <div class="form-group form-check">
                                @if ($item['restaurante']['mascota'] == 1)
                                <input type="checkbox" checked name="checkPets"class="form-check-input" id="checkPets">
                                @else
                                <input type="checkbox"  name="checkPets"class="form-check-input" id="checkPets">
                                @endif
                            <label class="form-che ck-label" for="checkPets">Admite mascotas</label>
                        </div>





                        <div class="form-group">
                            {{-- <label for="inputRoute">Link ruta</label> --}}
                            <label for="inputNameRoute" class="form-label">Nombre ruta</label>
                            <input type="text" name="inputNameRoute" maxlength="50" value="{{ $ruta['nombre'] }}"
                                id="inputNameRoute" placeholder="Nombre Ruta">
                        </div>
                        <div class="form-group">
                            <label for="inputRoute" class="form-label">Link ruta</label>
                            {{-- <label for="inputRoute">Link ruta</label> --}}
                            <input type="text" name="inputRoute" maxlength="250" value="{{ $ruta['link_ruta'] }}"
                                id="inputRoute" placeholder="Link ubicación">
                        </div>
                @endforeach
                <em class="colorSections">Plato principal</em>





                <div class="form-group">
                    <label for="inputPlate" class="form-label">Nombre del plato</label>
                    {{-- <label for="inputPlate">Plato principal</label> --}}
                    <input type="text" value="{{ $plato['nombre'] }}" name="inputPlate" id="inputPlate" maxlength="50"
                        placeholder="Nombre Plato">
                </div>
                <div class="mb-3">
                    <label for="inputDescription" class="form-label">Descripción</label>
                    <textarea name="inputDescription" maxlength="700" cols="10" rows="5" class="form-control" id="inputDescription"
                        placeholder="Describe el plato">{{ $plato['descripcion'] }}</textarea>

                </div>


                <div class="form-group">
                </div>
            @endforeach
            <div class="divCenter">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="center btn btn-primary">Enviar</button>
    </div>
    @endforeach
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
    <script>
        function selectionType() {

            let restaurantType = document.getElementById('typeRestaurant');
            let selection = restaurantType.value;
            document.getElementById('pruebaid').innerText = `siuu ${selection}`;

        }
    </script>
@endsection


{{-- Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "imagen", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    dictDefaultMessage: "Arrastre las imagenes del restaurante aquí",
    maxFiles: 3,
    acceptedFiles: "image/*",

}; --}}