{{-- INDEX CAFE --}}
@extends('theme.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
   
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection
@section('nav')
    <nav  class="navbar navbar-expand-lg  navbar-dark" style=" background-color: #24252A;">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#">
                Cafés
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-center " id="navbarNav">
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link" aria-current="page" href="{{ route('restaurante.index') }}">Restaurantes</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="{{route ('cafe.index')}}">Cafés</a>
                      </li>
                      <li class="nav-item ">
                        <a class="nav-link" href="{{ route('personajes.index') }}">Personajes</a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="{{ route('patrimonio.index') }}">Patrimonio</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link" href="{{ route('simbolo.index') }}">Simbolo</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="{{ route('historia.index') }}">Historia</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="{{ route('senderismo.index') }}">Senderismo</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('otrosservicios.index') }}">Otros servicios</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('calendario.index') }}">Calendario</a>
              </li>
              {{-- <li class="nav-item ">
                <a class="nav-link" href="{{ route('hamburguesas.index') }}">Hamburguesas</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="{{ route('registros.index') }}">Votaciones</a>
              </li> --}}
                    <li class="nav-item">
                        
                        <a class="nav-link" href="{{route ('users_admin.index')}}">Usuarios</a>
                      </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('general.create') }}">Logo Aplicación</a>
                    </li>

                </ul>


            </div>
            <ul class="navbar-nav ">
                <li>
                    <a class="button" href="{{ route('cafe.create') }}">Registrar Café</a>
                </li>
                 <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                  {{ __('Salir') }}
              </button>
          </form>
          </li>
            </ul>
            <img class="img-responsive" src="images/logo-gov.png" width="100" height="20">
        </div>
    </nav>
@endsection
@section('content')
    <div class="container py-5 ">
       
        @if (Session::has('mensajee'))
        <div class="alert alert-info my-5">

            {{ Session::get('mensajee') }}

        </div>
    @endif

        <!-- mensaje de confirmacion -->
        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5">

                {{ Session::get('mensaje') }}

            </div>
        @endif
        @isset($cafesArray)
        <div class="table-responsive text-center  cardIndex border animate__animated  animate__zoomInUp">

            <table class="table table-bordered">

                <thead class="p-3 mb-2 bg-light text-dark">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Origen Cafe</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>

                </thead>

                <tbody>
                  
                        
                   
                    @foreach ($cafesArray as $cafe)
                        <tr>

                            <th scope="row">{{ $cafe['id_cafe'] }}</th>
                            <td>{{ $cafe['nombre'] }}</td>
                            <td>{{ $cafe['direccion'] }}</td>
                            <td>{{ $cafe['origen_cafe'] }}</td>
                            <td>

                                <div class="text-center">

                                    <a href="{{ url('/cafe/' . $cafe['id_cafe'] . '/edit') }}"
                                        class="btn btn-primary btnEditar">Editar</a>



                                </div>

                            </td>
                            <td>


                                {{-- <form action="{{route('/restaurante/'.$restaurante['id_res'].'/'.$restaurante['fk_id_plato'])}}" method="post"> --}}

                                {{-- ELIMINAR UNR ESTAURANTE POR MEDIO DEL ID --}}
                                {{-- action="{{url('/rest/elim/'.$cafe['id_res'].'/'.$cafe['fk_id_plato'])}}" --}}
                                <form
                                    action="{{ url('/cafe/eliminar/' . $cafe['id_cafe'] . '/' . $cafe['fk_id_menu'] . '/' . $cafe['fk_id_servicio_adicional']) }}"
                                    method="post">

                                    @csrf
                                    {{-- {{ method_filed('DELETE') }}
                                   <input  type="submit" onclick="return confirm('Quieres borrar?')" > --}}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button onclick="return confirm('Quieres borrar?')" class="btn btn-danger btnBorrar"
                                        type="submit">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @endisset
                </tbody>
            </table>

        </div>


    </div>
@endsection
