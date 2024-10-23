<!-- Formulario para registrar un senderismo-->

@extends('theme.base')


@section('css')
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar senderismo</h1>
        <form action="{{ route('senderismo.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input   type="text" name="nombre" maxlength="80" 
                    class="input" id="nombre" placeholder="Nombre senderismo">
                    <br>
                    @error('nombre')
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
                <label for="caracteristica">Caracteristica</label>
                <input  type="text" name="caracteristica" maxlength="50" 
                    class="input" id="caracteristica" placeholder="Caracteristica senderismo">
                    <br>
                    @error('caracteristica')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="link_ubicacion">Link Ubicacion</label>
            
                    <textarea name="link_ubicacion" maxlength="300" cols="10" rows="5"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        id="link_ubicacion" placeholder="Ubicacion"></textarea>
        
        @error('link_ubicacion')
        <small class="text-danger">{{ $message }} </small>
    @enderror
            </div>

            <div>
                <br>
                <label>Formas de acceso</label><br><br>

                <label style="color: #000000"><input type="checkbox" name="acceso[]" value="caminando">Caminando</label>
                <label style="color: #000000" color: #FF0000;><input type="checkbox" name="acceso[]"
                        value="cicla">Bicicleta</label>
                <label style="color: #000000"><input type="checkbox" name="acceso[]" value="moto">Moto
                    </label>
                <label style="color: #000000"><input type="checkbox" name="acceso[]" value="carro">Carro
                    </label>
                


            </div>


                <div  class="form-group">

                        @isset($typesArray)
                        <label for="typeTurismo">Tipo de Turismo</label>
                   
                    <select name="typeTurismo" id="typeTurismo">


                            @foreach ($typesArray as $key => $item )
                              
                                <option value="{{$key}}">{{$item}}</option>
                            @endforeach

                    </select>
                                
                    @endisset

                </div>




            <em class="colorSections">Imagenes senderismo</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagensenderismo[]"
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
                    id="imagensenderismo[]" multiple>
                <br>
                @error('imagensenderismo')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>



            <divt class="divCenter">
                <button type="submit"
                    class=" shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>
    </div>

    </form>


    </div>
@endsection

@section('js')
@endsection
