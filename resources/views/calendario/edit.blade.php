<!-- Formulario para editar  HISTORIA-->

@extends('theme.base')



@section('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')

    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar Calendario</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
       
        @isset($response)
            
       
        @foreach ($response as $item)

        

                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/calendario/actualizar/' . $item['calendario']['id']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                  


                        <div class="form-group">
                            <label for="titulo">titulo</label>
                            <input  type="text" name="titulo" maxlength="80" value="{{ $item['calendario']['titulo'] }}"
                                class="input" id="titulo" placeholder="Titulo calendario">
                                <br>
                                @error('titulo')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>

                     
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" maxlength="1200" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="descripcion" placeholder="Descripcion">{{$item['calendario']['descripcion']}}</textarea> 
                                
                                @error('descripcion')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                                
                        </div>
                        <div class="form-group">
                            <label for="direccion"> direccion</label>
                        
                                <textarea name="direccion" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="direccion" placeholder="Ubicacion">{{ $item['calendario']['direccion'] }}</textarea>
                    
                    @error('direccion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>
                        <div class="form-group">
                            <label for="ruta"> ruta</label>
                        
                                <textarea name="ruta" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="ruta" placeholder="Ubicacion">{{ $item['calendario']['ruta'] }}</textarea>
                    
                    @error('ruta')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>

                        @foreach ($foto_calendario as $foto)
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


