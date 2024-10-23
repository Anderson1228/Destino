<!-- Formulario para editar  HISTORIA-->

@extends('theme.base')



@section('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection


@section('content')

    <div class="container body cardF" style="width: 48rem;">


        <br><br><br>
        <h1> Editar Historia</h1>
        {{-- RECORREMOS LA INFORMACION OBTENIDA DESDE LA API LA CUAL RECORREMOS PARA ENVIAR EN EL ACTION DEL FORMULARIO EL ID DE LO QUE SE EDITARAá --}}
       
        @isset($response)
            
       
        @foreach ($response as $item)

        

                    {{-- FORMULARIO EDITAR RESTAURANTE --}}
                    <form
                        action="{{ url('/historia/actualizar/' . $item['historia']['id_historia']) }}"
                        method="post">
                        <!--  Para evitar problemas de expiración de pagina -->

                        @csrf

                  


                        <div class="form-group">
                            <label for="title">Title</label>
                            <input  type="text" name="title" maxlength="80" value="{{ $item['historia']['title'] }}"
                                class="input" id="title" placeholder="Titulo historia">
                                <br>
                                @error('title')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                        </div>

                     
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" maxlength="1200" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="descripcion" placeholder="Descripcion">{{$item['historia']['descripcion']}}</textarea> 
                                
                                @error('descripcion')
                                <small class="text-danger">{{ $message }} </small>
                            @enderror
                                
                        </div>
                        <div class="form-group">
                            <label for="link_ubicacion">Link Ubicacion</label>
                        
                                <textarea name="link_ubicacion" maxlength="300" cols="10" rows="5"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="link_ubicacion" placeholder="Ubicacion">{{ $item['historia']['link_ubicacion'] }}</textarea>
                    
                    @error('link_ubicacion')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
                        </div>

                        @foreach ($foto_historias as $foto)
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


