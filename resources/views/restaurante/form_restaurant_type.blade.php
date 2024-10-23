<!-- Formulario para registrar un tipo de restaurante-->

@extends('theme.base')


@section('css')

        <link rel="stylesheet" href="{{ asset('/css/form.css') }}">
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@endsection


@section('content')
    <div class="container body cardF animate__animated animate__zoomInDown" style="width: 48rem;">
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

            <br>
        <h1> Registrar tipo de restaurante</h1>
        <form action="{{ url('/rest/registrar/nuevo_tipo') }}" method="POST">
            <!--  Para evitar problemas de expiración de pagina -->
            @csrf

       

            {{-- <div class="form-group">
       
                @error('inputName')
                    <p class="form-text text-danger">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="form-group ">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text" name="nameTypeRestaurant" maxlength="50" class="input" id="nameTypeRestaurant"
                    placeholder="Nombre tipo de restaurante">
            </div>
            <div class="form-group">
                {{-- <label for="inputAddress" >Dirección</label> --}}
                <input type="text"  name="tipo_res" maxlength="50" class="input" id="tipo_res"
                    placeholder="Tipo restaurante">
                    
                    <button   type="submit" class="center btn btn-primary">Registrar</button>
            </div>
            <div class="divCenter">
           </form>    

                
    </div>
 

  
    <em class="colorSections">Importante, siempre tener el tipo 1 y 2</em>

            <div class="table-responsive text-center ">

                <table class="table table-bordered">
    
                    <thead class="p-3 mb-2 bg-light text-dark">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                          
                        </tr>
    
                    </thead>
    
                    <tbody>
                        @foreach ($restaurantTypeArray as $type)
                            <tr>
    
                                <th scope="row">{{ $type['id_tipo_res'] }}</th>
                                <td>{{ $type['nombre'] }}</td>
                                <td>{{ $type['tipo_res'] }}</td>
                                
                          
                                <td>
    
                                    <div class="text-center">
    
                                        <a href="{{url('/rest/editar_tipo/'.$type['id_tipo_res'])}}" class="btn btn-primary btnEditar">Editar</a>
                                        
    
    
                                    </div>
    
                                </td>
                                <td>
                             
                                
                                  {{-- <form action="{{route('/restaurante/'.$restaurante['id_res'].'/'.$restaurante['fk_id_plato'])}}" method="post">
                                     --}}
                                   
                                  {{-- ELIMINAR UNR ESTAURANTE POR MEDIO DEL ID --}}
                                  <br>
                                  <form action="{{url('/restaurante_tipo/elim/'.$type['id_tipo_res'])}}" method="post">
                                    
                                       @csrf
                                       {{-- {{ method_filed('DELETE') }}
                                       <input  type="submit" onclick="return confirm('Quieres borrar?')" > --}}
                                       <input  type="hidden" name="_method"  value="DELETE">
                                      <button id="a" onclick="return confirm('Quieres borrar?')"class="btn btn-danger btnBorrar" type="submit">Borrar</button>
                                      </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
            </div>
    











           

    </form>


    </div>
@endsection

@section('js')
   
@endsection


