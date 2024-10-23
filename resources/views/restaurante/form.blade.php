<!-- Formulario para registrar un restaurante-->

@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('/css/form.css') }}">


@endsection


@section('content')
    <div class="container body cardF" style="width: 48rem;">


<!-- mensaje de error -->
@if (Session::has('mensajee'))
<div class="alert alert-info my-5">

    {{ Session::get('mensajee') }}

</div>
@endif
<!-- mensaje de confirmacion -->
@if (Session::has('mensaje'))
  <div class="alert alert-info my-5">

      {{ Session::get('mensaje') }}

  </div>
@endif
        <h1> Registrar Restaurante</h1>
        <form action="{{ route('restaurante.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf

       

            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="nameRestaurant" value="{{old('nameRestaurant')}}" maxlength="50" class="input" id="nameRestaurant"
                    placeholder="Nombre Restaurante">
                    <br>
                    @error('nameRestaurant')
                        <small class="text-danger">*{{$message}}</small>
                        <br>
                    @enderror
            </div>
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="inputOwner" maxlength="50" value="{{old('inputOwner')}}" class="input" id="inputOwner"
                    placeholder="Nombre Propietario">
                    <br>
                    @error('inputOwner')
                    <small class="text-danger">*{{$message}}</small>
                   
                @enderror
            </div>
            <div class="form-group">
                {{-- <label for="inputPhone">Teléfono</label> --}}
                <input type="number" name="inputPhone" maxlength="10" value="{{old('inputPhone')}}" id="inputPhone" placeholder="Telefono">
            </div>
             @error('inputPhone')
                        <small class="text-danger">*{{$message}}</small>
                        <br>
                    @enderror
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="inputAddress" maxlength="70" value="{{old('inputAddress')}}" class="input" id="inputAddress"
                    placeholder="Dirección">
                    <br>
                    @error('inputAddress')
                    <small class="text-danger">*{{$message}}</small>
                   
                @enderror
            </div>

            <div class="form-group">
                {{-- <label for="inputHorario">Horario de atención</label> --}}
                <input type="text" name="inputHorario" value="{{old('inputHorario')}}" maxlength="70" id="inputHorario" placeholder="Horario De Atención">
                <br>
                @error('inputHorario')
                <small class="text-danger">*{{$message}}</small>
               
            @enderror
            </div>



            <div class="form-group">
               

                    @isset($restaurantTypeArray)
                        
                    <label for="typeRestaurant">Tipo de restaurante</label>
                    <select id="typeRestaurant" name="typeRestaurant" onchange="selectionType();">
                    @foreach ($restaurantTypeArray as $type)
                        <option value="{{ $type['id_tipo_res'] }}">{{ $type['nombre'] }}</option>
                    @endforeach
                    @endisset

                </select>
            {{-- <span id="pruebaid"></span> --}}
            {{-- <a href="{{url('/rest/registrar/tipo')}}">Editar tipo de restaurante</a> --}}
            </div>
            {{-- MASCOTAS --}}
            <div class="form-group form-check">
                <input type="checkbox" name="checkPets" class="form-check-input" id="checkPets">
                <label class="form-che ck-label" value="{{old('checkPets')}}" for="checkPets">Admite mascotas</label>
            </div>

            <div class="form-group">
                {{-- <label for="inputRoute">Link ruta</label> --}}
                <input type="text" name="inputNameRoute" value="{{old('inputNameRoute')}}" maxlength="50" id="inputNameRoute" placeholder="Nombre Ruta">
                <br>
                @error('inputNameRoute')
                <small class="text-danger">*{{$message}}</small>
               
            @enderror
            </div>
            <div class="form-group">
                {{-- <label for="inputRoute">Link ruta</label> --}}
                <input type="text" name="inputRoute" value="{{old('inputRoute')}}" maxlength="350" id="inputRoute" placeholder="Link ubicación">
                <br>
                @error('inputRoute')
                <small class="text-danger" >*{{$message}}</small>
               
            @enderror
            </div>
                    {{-- IMAGENES RESTAURANTE --}}
                    <em class="colorSections">Imagenes Restaurante</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagenRestaurant[]" class="form-control" id="imagenRestaurant[]" multiple>
                <br>
                @error('imagenRestaurant[]')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

                <em class="colorSections">Descripcion del restaurante</em>

            
            
            
            <div class="form-group">
                {{-- <label for="inputPlate">Plato principal</label> --}}
                <input type="text" name="inputPlate" value="{{old('inputPlate')}}" id="inputPlate" maxlength="50" placeholder="Nombre restaurante">
                <br>
                @error('inputPlate')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="inputDescription" class="form-label">Descripción de la carta</label>
                <textarea name="inputDescription" value="{{old('inputDescription')}}" maxlength="700" cols="10" rows="5" class="form-control" id="inputDescription"
                    placeholder="Describe el restaurante o carta"></textarea>
                    <br>
                    @error('inputDescription')
                        <small class="text-danger">{{ $message }} </small>
                    @enderror
            </div>
            <em class="colorSections">Imagenes restaurante/carta</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagenPlate[]" class="form-control" id="imagenPlate[]" multiple>
                <br>
                @error('imagenPlate[]')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
            </div>
            <divt class="divCenter">
                <button type="submit" class="center btn btn-primary">Enviar</button>
    </div>

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
