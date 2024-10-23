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
        <h1> Registrar Otro servicio</h1>
        <form action="{{ route('otrosservicios.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf

       

            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="nombre" value="{{old('nombre')}}" maxlength="50" class="input" id="nombre"
                    placeholder="nombre">
                    <br>
                    @error('nombre')
                        <small class="text-danger">*{{$message}}</small>
                        <br>
                    @enderror
            </div>
            
            <div class="form-group">
                {{-- <label for="inputPhone">Teléfono</label> --}}
                <input type="text" name="telefono" maxlength="10" value="{{old('telefono')}}" id="telefono" placeholder="telefono">
            </div>
             @error('telefono')
                        <small class="text-danger">*{{$message}}</small>
                        <br>
                    @enderror
                    <div class="form-group">
                        {{-- <label for="inputHorario">Horario de atención</label> --}}
                        <input type="text" name="horario" value="{{old('horario')}}" maxlength="70" id="horario" placeholder="horario">
                        <br>
                        @error('horario')
                        <small class="text-danger">*{{$message}}</small>
                       
                    @enderror
                    </div>
                    <div class="form-group">
                        {{-- <label for="inputAddress" >Dirección</label> --}}
                        <input type="text" name="link" maxlength="70" value="{{old('link')}}" class="input" id="link"
                            placeholder="link">
                            <br>
                            @error('link')
                            <small class="text-danger">*{{$message}}</small>
                           
                        @enderror
                    </div>
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="direccion" maxlength="70" value="{{old('direccion')}}" class="input" id="direccion"
                    placeholder="direccion">
                    <br>
                    @error('inputAddress')
                    <small class="text-danger">*{{$message}}</small>
                   
                @enderror
            </div>

            



            <div class="form-group">
               

                    @isset($otrosTypeArray)
                        
                    <label for="tiposservicio">Tipo de servicio</label>
                    <select id="tiposservicio" name="tiposservicio" onchange="selectionType();">
                    @foreach ($otrosTypeArray as $type)
                        <option value="{{ $type['id'] }}">{{ $type['nombre'] }}</option>
                    @endforeach
                    @endisset

                </select>
            {{-- <span id="pruebaid"></span> --}}
            {{-- {{-- <a href="{{url('/rest/registrar/tipo')}}">Editar tipo de restaurante</a> --}}
            </div>
            
            

            
            
            
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" value="{{old('descripcion')}}" maxlength="700" cols="10" rows="5" class="form-control" id="descripcion"
                    placeholder="descripcion"></textarea>
                    <br>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }} </small>
                    @enderror
            </div>
            <em class="colorSections">Imagenes del servicio</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagenOtro[]" class="form-control" id="imagenOtro[]" multiple>
                <br>
                @error('imagenOtro[]')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
            </div>
            <div class="divCenter">
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
