<!-- Formulario para registrar un simbolo-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar simbolo</h1>
        <form action="{{ route('simbolo.store') }}" method="POST" enctype="multipart/form-data">
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
                    
                    name="nombre" id="nombre" maxlength="50" placeholder="Nombre simbolo">
                    <br>
                    @error('inputAddress')
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
          
         

           

            {{-- IMAGEN SIMBOLO --}}
            <em class="colorSections">Imagen simbolo</em>
            <div>
                <input type="file" accept="image/*" name="imagenSimbolo"
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
                    id="imagenSimbolo">
                <br>
                @error('imagenSimbolo')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            


            @error('imagenSimbolo')
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
