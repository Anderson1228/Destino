<!-- Formulario para editar  hamburguesas-->

@extends('theme.base')



@section('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')

    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar hamburguesas</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
       
        @isset($response)
            
       
        @foreach ($response as $item)

        

                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/hamburguesas/actualizar/' . $item['hamburguesas']['id']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                  


                        <div class="form-group">
                            <label for="restaurante">restaurante</label>
                            <input  type="text" name="restaurante" maxlength="80" value="{{ $item['hamburguesas']['restaurante'] }}"
                                class="input" id="restaurante" placeholder="restaurante">
                                <br>
                                @error('restaurante')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="direccion">direccion</label>
                            <input  type="text" name="direccion" maxlength="80" value="{{ $item['hamburguesas']['direccion'] }}"
                                class="input" id="direccion" placeholder="direccion">
                                <br>
                                @error('direccion')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telefono">telefono</label>
                            <input  type="text" name="telefono" maxlength="80" value="{{ $item['hamburguesas']['telefono'] }}"
                                class="input" id="telefono" placeholder="telefono">
                                <br>
                                @error('telefono')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="horario">horario</label>
                            <input  type="text" name="horario" maxlength="80" value="{{ $item['hamburguesas']['horario'] }}"
                                class="input" id="horario" placeholder="horario">
                                <br>
                                @error('horario')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre_hamburguesa">nombre_hamburguesa</label>
                            <input  type="text" name="nombre_hamburguesa" maxlength="80" value="{{ $item['hamburguesas']['nombre_hamburguesa'] }}"
                                class="input" id="nombre_hamburguesa" placeholder="Titulo hamburguesas">
                                <br>
                                @error('nombre_hamburguesa')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>
                        @foreach ($foto_hamburguesas as $foto)
                        <div class="form-group">

                            <input type="text" name="foto" value="{{ $foto->link_foto}}">
                            <a class="btn btn-info"  href="{{ route('foto.edit', $foto->id_multi) }}">Editar</a>
                        </div>
                        @endforeach     
                        <div class="form-group">
                            <label for="ingredientes">Descripción</label>
                            <textarea name="ingredientes" maxlength="1200" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="ingredientes" placeholder="ingredientes">{{$item['hamburguesas']['ingredientes']}}</textarea> 
                                
                                @error('ingredientes')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                                
                        </div>
                        <div class="form-group">
                            <label for="linkruta">Link Ubicacion</label>
                        
                                <textarea name="linkruta" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="linkruta" placeholder="Ubicacion">{{ $item['hamburguesas']['linkruta'] }}</textarea>
                    
                    @error('linkruta')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>

                          
                        

                       

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


