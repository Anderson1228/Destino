<!-- Formulario para registrar un nuevo logo-->

@extends('theme.base')


@section('css')
    <link rel="stylesheet" href="{{ asset('/css/form.css') }}">
@endsection


@section('content')
    <div class="container body cardF" style="width: 48rem;">



        <h1> Registrar Logo nuevo</h1>
        <form action="{{ route('general.store') }}" method="POST" enctype="multipart/form-data">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf






            
       

            {{-- IMAGENES CAFE --}}
            <em class="colorSections">Logo</em>
            <div>
                <input type="file" accept="image/*" name="imagenLogo" class="form-control" id="imagenLogo"
                    multiple>
                <br>
                @error('imagenLogo')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

           
                @error('imagenLogo')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            
           
            <divt class="divCenter">
                <button type="submit" class="center btn btn-primary">Enviar</button>
    </div>

    </form>
   

    </div>
@endsection
{{-- ADD DROPZONE JS  !OPTIONAL! --}}
@section('js')
 
@endsection


