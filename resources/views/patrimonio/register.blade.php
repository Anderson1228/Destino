<!-- Formulario para registrar un patrimonio-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar patrimonio</h1>
        <form action="{{ route('patrimonio.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf



            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group">
                <label for="nombre" >Nombre</label>
                <input type="text"
                    
                    name="nombre" id="nombre" maxlength="80" placeholder="Nombre patrimonio">
                    <br>
                    @error('nombre')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            <div class="form-group">
                <label for="fecha_creacion" >Fecha de creación</label><br>
                <em class="spanhide">La estructura de la fecha es: año-mes-dia</em>
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="fecha_creacion" maxlength="80" class="input" id="fecha_creacion" placeholder="1998-02-17">
                    <br>
                    @error('fecha_creacion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" maxlength="550" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="descripcion" placeholder="direccion"></textarea>
                    <br>
                    @error('descripcion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="direccion" maxlength="200" class="input" id="direccion" placeholder="Centro Fusagasugá">
                    <br>
                    @error('direccion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="link_ruta" class="form-label">Link ruta</label>
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="link_ruta" maxlength="300" class="input" id="link_ruta" placeholder="www.googlemaps.com">
                    <br>
                    @error('link_ruta')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <div  class="form-group">

                @isset($typesArray)
                <label for="typePatrimonio">Tipo de Patrimonio</label>
           
            <select name="typePatrimonio" id="typePatrimonio">


                    @foreach ($typesArray as $key => $item )
                      
                        <option value="{{$key}}">{{$item}}</option>
                    @endforeach

            </select>
                        
            @endisset

        </div>

            {{-- IMAGENES CAFE --}}
            <em class="colorSections">Imagen patrimonio</em>
            <div>
                <input type="file" accept="image/*" name="imagenpatrimonio"
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
                    id="imagenpatrimonio">
                <br>
                @error('imagenpatrimonio')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            {{-- <div>
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
                    id="imagenPersonaje">
                <br>
                @error('imagenPersonaje')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div> --}}


            @error('imagenpatrimonio')
                <small class="text-danger">{{ $message }} </small>
            @enderror


            <div class="divCenter">
                <button type="submit"
                    class=" shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>
    </div>

    </form>


    </div>
@endsection

@section('js')
@endsection
