<!-- Formulario para registrar un tipo de restaurante-->

@extends('theme.base')


@section('css')

        <link rel="stylesheet" href="{{ asset('/css/form.css') }}">


@endsection


@section('content')
    <div class="container body cardF" style="width: 48rem;">



        <h1> Editar tipo de restaurante</h1>

        @foreach ($responseTipo as $tipo )

        <form action="{{ url('/rest/actualizar_tipo/'. $tipo['id_tipo_res'] ) }}" method="post">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf
            
                

            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" value="{{$tipo['nombre']}}" name="nameTypeRestaurant" maxlength="50" class="input" id="nameTypeRestaurant"
                    placeholder="">
            </div>

            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" value="{{$tipo['tipo_res']}}" name="TypeRestaurant" maxlength="50" class="input" id="TypeRestaurant"
                    placeholder="">
            </div>

            @endforeach
       

            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
          
          
 


            <div class="divCenter">
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="center btn btn-primary">Enviar</button>
    </div>

    </form>


    </div>
@endsection

@section('js')
   
@endsection


