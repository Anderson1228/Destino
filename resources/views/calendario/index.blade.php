{{-- Historia --}}
@extends('theme.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
@endsection
@section('nav')
    <nav class="navbar navbar-expand-lg navbar-light  bg-dark navbar-dark animate__animated animate__slideInDown"
        style="background-color: #5C5CCB ;">
        <div class="container-fluid ">
            Calendario
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
                        <a class="nav-link" href="{{route ('cafe.index')}}">Cafés</a>
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
                <a class="nav-link active" href="{{ route('calendario.index') }}">Calendario</a>
              </li>
              {{-- <li class="nav-item ">
                <a class="nav-link" href="{{ route('hamburguesas.index') }}">Hamburguesas</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="{{ route('registros.index') }}">Votaciones</a>
              </li> --}}
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('users_admin.index') }}">Usuarios</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('general.create') }}">Logo Aplicación</a>
                    </li>

                </ul>


            </div>
            <ul class="navbar-nav ">
                <li>
                    <div class="button">


                        <a href="{{ route('calendario.create') }}">Registrar Calendario</a>
                    </div>
                </li>


            </ul>
            <ul class="navbar-nav ">


                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="buttonLogout">
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

        <!-- mensaje de confirmacion -->
        @if (Session::has('mensaje'))
            <div class="alert alert-info my-5">

                {{ Session::get('mensaje') }}

            </div>
        @endif
        @isset($calendarioArray)
        <H1>Recuerde que solamante será visible la ultimo evento agregado o editado.</H1>
        <br><br>
            <div class="table-responsive text-center  cardIndex border animate__animated  animate__zoomInUp ">

                <table class="table table-bordered  ">

                    <thead class="p-3 mb-2 bg-light text-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Direccion</th>
                            <th scope="col">Ruta</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>

                    </thead>

                    <tbody>



                        @foreach ($calendarioArray as $calendario)
                            <tr>

                                <th scope="row">{{ $calendario['id'] }}</th>
                                <td >{{ $calendario['titulo'] }}</td>
                                <td >{{ $calendario['descripcion'] }}</td>
                                <td>{{ $calendario['direccion'] }}</td>
                                <td>{{ $calendario['ruta'] }}</td>


                                <td>

                                    <div class="text-center">

                                        <a href="{{ url('/calendario/editar_calendario/' . $calendario['id']) }}"
                                            class="btn btn-primary btnEditar">Editar</a>

                                    </div>

                                </td>
                                <td>


                                    {{-- <form action="{{route('/restaurante/'.$restaurante['id_res'].'/'.$restaurante['fk_id_plato'])}}" method="post"> --}}

                                    {{-- ELIMINAR UNR ESTAURANTE POR MEDIO DEL ID --}}
                                    <form action="{{ url('/calendario/elim/' . $calendario['id']) }}" method="post">

                                        @csrf
                                        {{-- {{ method_filed('DELETE') }}
                                   <input  type="submit" onclick="return confirm('Quieres borrar?')" > --}}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button onclick="return confirm('Quieres borrar?')"class="btn btn-danger btnBorrar"
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
