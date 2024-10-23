<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Destino Fusagasugá</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/base.css') }}">
 
    @yield('css')
  </head>


  <body >
    
    @yield('nav')


    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script type="text/javascript">
 
      $("#rowAdder").click(function () {
          newRowAdd =
          '<div id="row"> <div class="input-group m-3">' +
          '<div class="input-group-prepend">' +
          '<button class="btn btn-danger" id="DeleteRow" type="button">' +
          '<i class="bi bi-trash"></i> Eliminar</button> </div>' +
          '<input type="text" id="social[]" name="social[]" class="form-control m-input"> </div> </div>';

          $('#newinput').append(newRowAdd);
      });

      $("body").on("click", "#DeleteRow", function () {
          $(this).parents("#row").remove();
      })
  </script>
    @yield('js')
   
  </body>
</html>