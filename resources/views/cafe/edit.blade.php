<!-- Formulario para editar un café-->

@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar Café</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
        @foreach ($response as $item)
            @foreach ($item['menu'] as $menu)
                @foreach ($item['servicio_adicional'] as $servicio)
                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/cafe/actualizar/' . $item['cafe']['id_cafe'] . '/' . $menu['id_menu'] . '/' . $servicio['id_servicio_adicional']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                        {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
                </div> --}}



                        <div class="form-group">
                            <label for="nameCafe">Nombre Cafe</label>
                            <input type="text" name="nameCafe" maxlength="50" value="{{ $item['cafe']['nombre'] }}"
                                class="input" id="nameCafe" placeholder="Nombre Cafe">
                        </div>

                        {{-- <div class="form-group">
                            <label for="inputPhone">Teléfono</label>
                            <input type="number" name="inputPhone" value="{{ $item['restaurante']['telefono'] }}"
                                maxlength="10" id="inputPhone" placeholder="Telefono">
                        </div> --}}
                        <div class="form-group">
                            <label for="inputAddress">Dirección</label>
                            <input type="text" name="inputAddress" value="{{ $item['cafe']['direccion'] }}"
                                maxlength="70" class="input" id="inputAddress" placeholder="Dirección">
                        </div>
                        <div class="form-group">
                            <label for="historyCafe">Historia cafe</label>
                            <input type="text" name="historyCafe" maxlength="700" value="{{ $item['cafe']['historia'] }}"
                                class="input" id="historyCafe" placeholder="Historia Cafe">
                        </div>

                        <div class="form-group">
                            <label for="inputHorario">Horario de atención</label>
                            <input type="text" name="inputHorario" value="{{ $item['cafe']['horario_atencion'] }}"
                                maxlength="70" id="inputHorario" placeholder="Horario De Atención">
                        </div>
                        <div class="form-group">
                            <label for="origenCafe">Origen del café</label>
                            <input type="text" name="origenCafe" value="{{ $item['cafe']['origen_cafe'] }}"
                                maxlength="500" id="origenCafe" placeholder="Origen Café">
                        </div>

                        @if (!is_null($item['cafe']['pagina_web']))
                            <div class="form-group">
                                <label for="paginaWeb">Pagina web</label>
                                <br>
                                <span class="spanhide" >Recuerda copiar la url completa,ejp: https://www.facebook.com/</span>
          
                                <input type="text" name="paginaWeb" value="{{ $item['cafe']['pagina_web'] }}"
                                    maxlength="350" class="input" id="paginaWeb" placeholder="Dirección">
                            </div>
                        @endif




                        {{-- MOSTRAMOS EL MENU SELECCIONADO --}}
                        <div>
                            <label for="menu">Menú</label>
                            <br><br>
                            {{-- VALIDAMOS SI EL CAMPO RECIBIDO ES DIFERENTE A 2, ESTO QUIERE DECIR QUE ES EL VALOR REGISTRado el cual
                                            SE PÓNDRÁ COMO PREDETERMINADO] --}}
                            <label style="color: #000000"><input type="radio" name="menu" value="pasteleria"
                                    @if ($menu['pasteleria'] != 2) checked @endif>Pasteleria</label>
                            <label style="color: #000000"><input type="radio" name="menu" value="licores"
                                    @if ($menu['licores'] != 2) checked @endif>Licores</label>
                            <label style="color: #000000"><input type="radio" name="menu"
                                    value="comidas_rapidas"@if ($menu['comidas_rapidas'] != 2) checked @endif>Comidas
                                Rapidas</label>
                            <label style="color: #000000"><input type="radio" name="menu" value="helados"
                                    @if ($menu['helados'] != 2) checked @endif>Helados</label>
                            <label style="color: #000000"><input type="radio" name="menu"
                                    value="otro"@if ($menu['otro'] != 2) checked @endif>Otro</label>

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
                @endforeach
                {{-- CHECK SERVICIOS ADICIONALES --}}

                {{-- se valida si el servicio es diferente a 2 ya que solo se manejan 1 para activado y 2 para desactivado --}}
                <div>
                    <br>
                    <label>Servicios Adicionales</label><br><br>

                    <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="banio"
                            @if ($servicio['banio'] != 2) checked @endif>Baño</label>
                    <label style="color: #000000" color: #FF0000;><input type="checkbox" name="servicio_adicional[]"
                            value="pagos_digitales" @if ($servicio['pagos_digitales'] != 2) checked @endif>Pagos Digitales</label>
                    <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="musica_vivo"
                            @if ($servicio['musica_vivo'] != 2) checked @endif>Musica en vivo</label>
                    <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="zona_wifi"
                            @if ($servicio['zona_wifi'] != 2) checked @endif>Zona Wifi</label>
                    <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="ninguno"
                            @if ($servicio['ninguno'] != 2) checked @endif>Ninguno</label>
                    <label style="color: #000000"><input type="checkbox" name="servicio_adicional[]" value="otro"
                            @if ($servicio['otro'] != 2) checked @endif>Otro</label>


                </div>
            @endforeach



            @isset($redesSociales)
                
            <div class="form-group">
 
                <label for="social[]">Redes sociales</label>
                <br>
                <span class="spanhide" >Recuerda copiar la url completa,ejp: https://www.facebook.com/</span>
          

                        @if ($redesSociales != null)
                            
                            
                            
                      
                        @foreach ($redesSociales as $red)
                            
                  
         
                            <div id="row">
                                <div class="input-group m-3">
                                    <div class="input-group-prepend">
                                        {{-- <button class="btn btn-danger"
                                            id="DeleteRow" type="button">
                                            <i class="bi bi-trash"></i>
                                            Eliminar
                                        </button> --}}
                                    </div>
                                    <input  id="social[]" name="social[]" type="text" value="{{$red->link_red}}"
                                       placeholder="https://www.facebook.com/" class="form-control m-input">
                                </div>
                            </div>


                            @endforeach

                            @foreach ($foto_cafes as $foto)
                            <div class="form-group">

                                <input type="text" name="foto" value="{{ $foto->link_foto}}">
                                <a class="btn btn-info"  href="{{ route('foto.edit', $foto->id_multi) }}">Editar</a>
                            </div>
                            @endforeach

                      
                            <a class="btn btn-danger" href="{{url('/cafe/eliminar_red/'.$item['cafe']['id_cafe'])}}">Eliminar red Social</a>
                            @endif
                            <div id="newinput"></div>
                            <button id="rowAdder" type="button"
                                class="btn btn-primary">
                                <span class="bi bi-plus-square-dotted">
                                </span> Agregar
                            </button>
                       
                    
          
            @endisset

            <br><br>
    <div class="divCenter">
        <input type="hidden" name="_method" value="PUT">
        <button type="submit" class="center btn btn-primary">Enviar</button>
        <br><br><br>
    </div>
    @endforeach
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
@endsection


{{-- Dropzone.options.myGreatDropzone = { // camelized version of the `id`
    paramName: "imagen", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    dictDefaultMessage: "Arrastre las imagenes del restaurante aquí",
    maxFiles: 3,
    acceptedFiles: "image/*",

}; --}}

