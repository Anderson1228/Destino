<!-- Formulario para registrar un personaje-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar Personaje Historico</h1>
        <form action="{{ route('personajes.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf



            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="inputAddress" >Nombres</label>
                <input type="text"
                    
                    name="nombre" id="nombre" maxlength="50" placeholder="Nombre Personaje">
                    <br>
                    @error('nombre')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            <div class="form-group">
                <label for="fecha_nacimiento" >Fecha de nacimiento</label>
                <br>
                <em class="spanhide">La estructura de la fecha es: año-mes-dia</em>
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="fecha_nacimiento" maxlength="80" class="input" id="fecha_nacimiento" placeholder="1998-02-17">
                    <br>
                    @error('fecha_nacimiento')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

           



            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" maxlength="550" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="descripcion" placeholder="Descripción"></textarea>
                    <br>
                    @error('descripcion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>

           

            {{-- IMAGENES CAFE --}}
            <em class="colorSections">Imagen Personaje</em>
            <div>
                <input type="file" accept="image/*" name="imagenPersonaje"
                    class="form-control
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="imagenPersonaje>
                <br>
                @error('imagenPersonaje')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
        

            @error('imagenPersonaje')
                <small class="text-danger">{{ $message }} </small>
            @enderror


            <divt class="divCenter">
                <button type="submit"
                    class=" shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>
    </div>

    </form>


    </div>
@endsection

@section('js')
@endsection
