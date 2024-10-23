<!-- Formulario para registrar un cafe-->

@extends('theme.base')


@section('css')


    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

   <link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    @endsection


@section('content')
    <div class="container body cardF " style="width: 48rem;">



        <h1> Registrar Café</h1>
        <form action="{{ route('cafe.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf



            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group">

                <input type="text"
                    
                    name="nameCafe" id="nameCafe" maxlength="50" placeholder="Nombre Café">
            </div>


            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="inputAddress" maxlength="70" class="input" id="inputAddress" placeholder="Dirección">
            </div>

            <div class="form-group">
                {{-- <label for="inputHorario">Horario de atención</label> --}}
                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="inputHorario" maxlength="70" id="inputHorario" placeholder="Horario De Atención">
            </div>



            <div class="mb-3">
                <label for="historia" class="form-label">Historia</label>
                <textarea name="historia" maxlength="700" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="historia" placeholder="Historia"></textarea>

            </div>

            <div>
                <br>
                <label>Servicios Adicionales</label><br><br>

                <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="banio">Baño</label>
                <label style="color: #000000" color: #FF0000;><input type="checkbox" name="servicio_adicional[]"
                        value="pagos_digitales">Pagos Digitales</label>
                <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="musica_vivo">Musica
                    en vivo</label>
                <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="zona_wifi">Zona
                    Wifi</label>
                <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]"
                        value="ninguno">Ninguno</label>
                <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="otro">Otro</label>


            </div>

            <div class="form-group">
                <br>
                <span class="spanhide" >Recuerda copiar la url completa,ejp: https://www.facebook.com/</span>

                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    name="pagina_web" maxlength="350" id="pagina_web" placeholder="pagina_web">
            </div>
            {{-- <div class="form-group">

                <input type="text"
                    class="shadow-md bg-gray-200 appearance-none border-2 border-gray-200 rounded  py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="red_social" name="red_social" maxlength="350" id="red_social" placeholder="red_social">
            </div> --}}
            <div class="mb-3">
                <label for="origen_cafe" class="form-label">Origen</label>
                <textarea name="origen_cafe" maxlength="500"
                     id="origen_cafe" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Origen del café"></textarea>

            </div>
            {{-- MOSTRAMOS EL MENU SELECCIONADO --}}
            <div>
                <label for="menu">Menú</label>
                <br><br>
                {{-- VALIDAMOS SI EL CAMPO RECIBIDO ES DIFERENTE A 2, ESTO QUIERE DECIR QUE ES EL VALOR REGISTRado el cual
                                SE PÓNDRÁ COMO PREDETERMINADO] --}}
                <label style="color: #000000"><input type="radio" name="menu" value="pasteleria">Pasteleria</label>
                <label style="color: #000000"><input type="radio" name="menu" value="licores">Licores</label>
                <label style="color: #000000"><input type="radio" name="menu" value="comidas_rapidas">Comidas
                    Rapidas</label>
                <label style="color: #000000"><input type="radio" name="menu" value="helados">Helados</label>
                <label style="color: #000000"><input type="radio" name="menu" value="otro">Otro</label>

                {{-- <option value="{{ $menu['pasteleria'] }}"
                        @if (!is_null($menu['pasteleria'])) selected="selected" @endif>Pasteleria</option>
                    <option value="{{ $menu['licores'] }}"
                        @if (!is_null($menu['licores'])) selected="selected" @endif>Licores</option>
                    <option value="{{ $menu['comidas_rapidas'] }}"
                        @if (!is_null($menu['comidas_rapidas'])) selected="selected" @endif>Comidas Rapidas</option>
                    <option value="{{ $menu['helados'] }}"
                        @if (!is_null($menu['helados'])) selected="selected" @endif>Helados</option>

                    <option value="{{ $menu['otro'] }}"
                        @if (!is_null($menu['otro'])) selected="selected" @endif>Otro</option> --}}

            </div>
        
    <div class="form-group">
 
        <label for="social[]">Redes sociales</label>
        <br>
        <span class="spanhide" >Recuerda copiar la url completa,ejp: https://www.facebook.com/</span><br>
        <span class="spanhide" >*Si no tiene red social, elimina la casilla*</span>
       
            <div class="">
                <div class="col-lg-12">
                    <div id="row">
                        <div class="input-group m-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-danger"
                                    id="DeleteRow" type="button">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </div>
                            <input  id="social[]" name="social[]" type="text"
                                class="form-control m-input">
                        </div>
                    </div>
 
                    <div id="newinput"></div>
                    <button id="rowAdder" type="button"
                        class="btn btn-primary">
                        <span class="bi bi-plus-square-dotted">
                        </span> Agregar
                    </button>
                </div>
            </div>
      
    </div>
            <div id="container"/>
            {{-- IMAGENES CAFE --}}
            <em class="colorSections">Imagenes Café</em>
            <div>
                <small >*Debe seleccionar minimo 2 imagenes</small>
                <input type="file" accept="image/*" name="imagenCafe[]"
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
                    id="imagenCafe[]" multiple>
                <br>
                @error('imagenCafe')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            @error('imagenCafe')
                <small class="text-danger">{{ $message }} </small>
            @enderror


            <div class="divCenter">
                <button type="submit"
                    class=" shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Enviar</button>
    </div>

    </form>


    </div>
    
@endsection
{{-- ADD DROPZONE JS  !OPTIONAL! --}}
@section('js')

@endsection
