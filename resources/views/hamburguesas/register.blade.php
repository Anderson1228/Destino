<!-- Formulario para registrar un patrimonio-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar hamburguesas</h1>
        <form action="{{ route('hamburguesas.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf



            <div class="form-group">
                <label for="restaurante">restaurante</label>
                <input type="text" name="restaurante" maxlength="120"  class="input"
                    id="restaurante" placeholder="restaurante hamburguesas">
                    
                <br>
                @error('restaurante')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="direccion">direccion</label>
                <input type="text" name="direccion" maxlength="120"  class="input"
                    id="direccion" placeholder="direccion hamburguesas">
                    
                <br>
                @error('direccion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="telefono">telefono</label>
                <input type="text" name="telefono" maxlength="120"  class="input"
                    id="telefono" placeholder="telefono hamburguesas">
                    
                <br>
                @error('telefono')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="horario">horario</label>
                <input type="text" name="horario" maxlength="120"  class="input"
                    id="horario" placeholder="horario hamburguesas">
                    
                <br>
                @error('horario')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="nombre_hamburguesa">nombre_hamburguesa</label>
                <input type="text" name="nombre_hamburguesa" maxlength="120"  class="input"
                    id="nombre_hamburguesa" placeholder="nombre_hamburguesa">
                    
                <br>
                @error('nombre_hamburguesa')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            <div class="form-group">
                <label for="ingredientes">Descripción</label>
               
                    <textarea name="ingredientes" maxlength="1200" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="ingredientes" placeholder="ingredientes"></textarea>
                @error('ingredientes')
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>
             <div class="form-group">
                <label for="linkruta">linkruta</label>

                <textarea name="linkruta" maxlength="500" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="linkruta" placeholder="linkruta"></textarea>

                @error('linkruta')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <em class="colorSections">Imagenes hamburguesas</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagenhamburguesas[]"
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
                    id="imagenhamburguesas[]" multiple>
                <br>
                @error('imagenhamburguesas')
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
