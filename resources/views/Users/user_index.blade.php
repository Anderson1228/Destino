
@extends('theme.base')


{{-- //agregamos DROPZONE CSS --}}
@section('css')
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="{{ asset('/css/form.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">

@endsection


@section('content')
    <div class="animate__animated animate__slideInDown " style="width: 48rem;">



        <h1 class="h1IndexUser"> ¡Bienvenido!</h1>
            <br><br><br>
        <body class="centerLogin">
            
            <img class="logoResponsive" src="{{ asset('/images/logo-index.png') }}" alt="Logo aplicacion">
              <br><br>
            <div class="wrap">
              
          
            <form method="POST" action="{{ route('logout') }}">
                @csrf
  
                <button type="submit" class="button">
                    {{ __('Salir') }}
                </button>
            </form>
        </div>  
        </body>
  

    </div>
@endsection

