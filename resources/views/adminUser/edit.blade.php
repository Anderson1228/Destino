<!-- Formulario para editar un café-->

@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    < <div class="container body cardF" style="width: 48rem;">



        <h1> Editar usuario</h1>

        @foreach ($responseu as $user)
            <form action="{{ url('/user/actualizar/' . $user['id_user']) }}" method="post">
                <!--  Para evitar problemas de expiración de pagina -->
                @csrf


                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Nombre')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="($user['nombre'])" required
                        autofocus />
                </div>


                <!-- Birthday -->
                <div>
                    <x-label for="birthday" :value="__('Fecha de nacimiento')" />

                    <x-input id="birthday" class="block mt-1 w-full" type="text" name="birthday" :value="($user['fecha_nacimiento'])" required
                        autofocus />
                </div>

                <!-- Birthday -->
                <div>
                    <x-label for="documento" :value="__('Documento')" />

                    <x-input id="documento" class="block mt-1 w-full" type="number" name="documento" :value="($user['documento'])"
                        required autofocus />
                </div>

                <!-- Birthday -->
                <div>
                    <x-label for="city" :value="__('Ciudad de residencia')" />

                    <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="($user['ciudad_residencia'])" required
                        autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Correo electronico')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="($user['email'])" required />
                </div>

            
        @endforeach


        {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}





        <div class="divCenter">
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="center btn btn-primary">Enviar</button>
        </div>

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
