<!-- Formulario para editar  senderismo-->

@extends('theme.base')



@section('css')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')

    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar senderismo</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}

        @isset($response)
             
        @foreach ($response as $item)
       
 

                {{-- FORMULARIO EDITAR RESTAURANTE --}}
                <form action="{{ url('/senderismo/actualizar/' . $item['senderismo']['id_senderismo']) }}" method="post">
                    <!--  Para evitar problemas de expiración de pagina -->

                    @csrf




                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" maxlength="80" value="{{ $item['senderismo']['nombre'] }}"
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
                            id="descripcion" placeholder="Descripcion">{{ $item['senderismo']['descripcion'] }}</textarea>

                        @error('descripcion')
                            <small class="text-danger">{{ $message }} </small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="caracteristica">Caracteristica</label>
                        <input type="text" name="caracteristica" maxlength="50"
                            value="{{ $item['senderismo']['caracteristica'] }}" class="input" id="caracteristica"
                            placeholder="Caracteristica senderismo">
                        <br>
                        @error('caracteristica')
                            <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="link_ubicacion">Link Ubicacion</label>

                        <textarea name="link_ubicacion" maxlength="300" cols="10" rows="5"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            id="link_ubicacion" placeholder="Ubicacion">{{ $item['senderismo']['link_ubicacion'] }}</textarea>

                        @error('link_ubicacion')
                            <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>


                    <div>
                        <br>
                     
                     
                        <label>Formas de acceso</label><br><br>

                        <label style="color: #000000" color: #FF0000;><input type="checkbox" name="acceso[]" value="caminando"
                                @if ($item['senderismo']['caminando'] != 2) checked @endif>Caminando</label>
                        <label style="color: #000000"><input type="checkbox" name="acceso[]" value="cicla"
                                @if ($item['senderismo']['cicla'] != 2) checked @endif>Bicicleta</label>


                        <label style="color: #000000"><input type="checkbox" name="acceso[]" value="moto"
                                @if ($item['senderismo']['moto'] != 2) checked @endif>Moto</label>
                        <label style="color: #000000"><input type="checkbox" name="acceso[]" value="carro"
                                @if ($item['senderismo']['carro'] != 2) checked @endif>Carro</label>

                               


                    </div>

                <div  class="form-group">

                    @isset($typesArray)
                    <label for="typeTurismo">Tipo de Turismo</label>
               
                <select name="typeTurismo" id="typeTurismo">


                        @foreach ($typesArray as $key => $itemT )
                            @if ($item['senderismo']['tipo_turismo'] == $key)
                            <option value="{{$key}}" selected>{{$itemT}}</option>
                            @else
                            <option value="{{$key}}">{{$itemT}}</option>
                            @endif
                           
                        @endforeach

                </select>
                            
                @endisset

            </div>
            @foreach ($foto_senderismos as $foto)
                        <div class="form-group">

                            <input type="text" name="foto" value="{{ $foto->link_foto}}">
                            <a class="btn btn-info"  href="{{ route('foto.edit', $foto->id_multi) }}">Editar</a>
                        </div>
                        @endforeach 





                    <br><br>
                    <div class="divCenter">
                        <input type="hidden" name="_method" value="PUT">
                        <button type="submit" class="center btn btn-primary">Enviar</button>
                        <br><br><br>
                    </div>
            @endforeach
        @endisset
        </form>


    </div>
@endsection

@section('js')
@endsection
