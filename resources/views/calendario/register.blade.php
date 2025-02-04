<!-- Formulario para registrar un patrimonio-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar calendario</h1>
        <form action="{{ route('calendario.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf



            <div class="form-group">
                <label for="titulo">titulo</label>
                <input type="text" name="titulo" maxlength="80"  class="input"
                    id="titulo" placeholder="Titulo calendario">
                    
                <br>
                @error('titulo')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            <div class="form-group">
                <label for="descripcion">Descripción</label>
               
                    <textarea name="descripcion" maxlength="1200" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="descripcion" placeholder="Descripcion"></textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>
            <div class="form-group">
                <label for="direccion">direccion</label>

                <textarea name="direccion" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="direccion" placeholder="direccion"></textarea>

                @error('direccion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
             <div class="form-group">
                <label for="ruta">ruta</label>

                <textarea name="ruta" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="ruta" placeholder="ruta"></textarea>

                @error('ruta')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <em class="colorSections">Imagenes calendario</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagencalendario[]"
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
                    id="imagencalendario[]" multiple>
                <br>
                @error('imagencalendario')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>



            <div class="divCenter">
                <button type="submit"
                    class=" shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>
    </div>

    </form>


    </div>
@endsection

@section('js')
@endsection
