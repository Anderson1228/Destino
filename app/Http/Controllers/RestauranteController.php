<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7;
use App\Models\Restaurante;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MOSTRAR TODOS LOS RESTAURANTES
        //link del api
        try {

            
           

            $restaurantes = HTTP::get('https://api.destinofusagasuga.gov.co/api/restaurante');
            //pasamos los datos a un arreglo
    
            $restaurantesArray = $restaurantes->json();
                 
            //pasamos el arreglo a la vista
                return view('restaurante.index', compact('restaurantesArray'));
     
            
            
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información '.$th);
            return view('restaurante.index');
        }
       
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {

        //MOSTRAR TODOS LOS TIPOS DE RESTAURANTE
        //link del api
        try {
       
               $types = HTTP::get('https://api.destinofusagasuga.gov.co/api/tipo_restaurante');
            //pasamos los datos a un arreglo
            $restaurantTypeArray = $types->json();
    
            //pasamos el arreglo a la vista
            return view('restaurante.form', compact('restaurantTypeArray'));
        } catch (\Throwable $th) {

            return view('restaurante.form');
        }
       
    }




    //REGISTRA TIPOS DE RESTAURANTE
    public function createTypeRestaurante(Request $request){

        $request->validate([
         
            'nameTypeRestaurant' => ['required', 'string', 'max:50',],
            'tipo_res'=> ['required',  'unique:tiporestaurante'],
            
        ]);
        $client = new Client([
            


            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/registrar'
        ]);
        try {
           

                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/registrar', [


                    "headers" =>[
                            "Authorization" => "Bearer 2eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2NTQyMzIyMTksImV4cCI6MTY1NDIzNTgxOSwibmJmIjoxNjU0MjMyMjE5LCJqdGkiOiJZaGFwRG5uRzhhNk5MSzJ0Iiwic3ViIjoiMzIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.X__ayccv8JhNzo7iGHVZHI48IvSYsvbqbYd527rFHsw"

                    ],

                'json' => [
                    
                        'nombre' =>  $request->nameTypeRestaurant,
                        'tipo_res' =>  $request->tipo_res,
                    
                    
                    
                ]
            ]);
            $body = $response->getBody();
            $arr_body = json_decode($body);
        } catch (Exception $e) {
            Session::flash('mensajee', 'Error al registrar el tipo! '. $e->getMessage());
            return redirect(url('/rest/registrar/tipo'));
       
        }

        Session::flash('mensaje', 'Registrado correctamente!');
        return redirect(url('/rest/registrar/tipo'));


    }


public function typeRestaurant(){
    //MUESTRA TIPOS DE RESTAURANTES PARA EDITAR
//MOSTRAR TODOS LOS TIPOS DE RESTAURANTE
        //link del api
        $restaurantTypeArray = [];
        try {
            
            

            $types = HTTP::get('https://api.destinofusagasuga.gov.co/api/tipo_restaurante');
        //pasamos los datos a un arreglo
        $restaurantTypeArray = $types->json();

        //pasamos el arreglo a la vista
        return view('restaurante.form_restaurant_type', compact('restaurantTypeArray')); 
        } 
       
        catch (\Throwable $th) {
            Session::flash('mensajee', ''. $th->getMessage());
            return view('restaurante.form_restaurant_type', compact('restaurantTypeArray'));
        }
}
// public function editar_tipo($id_tipo_Res){
    

//     $tipo = HTTP::get('https://api.destinofusagasuga.gov.co/api/tipo_restaurante/tipo/'.$id_tipo_Res);
//     //pasamos los datos a un arreglo
//     $responseTipo = $tipo->json();

//     //pasamos el arreglo a la vista
   

//     return view('restaurante.edit_tipo_restaurant', compact('responseTipo'));
// }
// public function actualizar_tipo(Request $request,$id_tipo_res){
// //$datos = request()->except(['_token','_method']);
// $client = new Client([


//     'base_uri' => 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/actualizar'
// ]);
// try {
   

//         $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/actualizar/'.$id_tipo_res, [
//         'json' => [
            
//                 'nombre' =>  $request->nameTypeRestaurant,
//                 'tipo_res' =>  $request->TypeRestaurant,
            
            
            
//         ]
//     ]);
//     $body = $response->getBody();
//     $arr_body = json_decode($body);
// } catch (Exception $e) {

//     return 'No se actualizó' . $e->getMessage();
// }

// return redirect(url('/rest/registrar/tipo'));
// }

// public function eliminar_tipo($id_tipo_Res){
//     $client = new Client([

    
//         'base_uri' => 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/eliminar/'
//     ]);

//     try {

//         //SEND A NEW RESTAURANT
   
//         $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/tipo_restaurante/eliminar/'.$id_tipo_Res);

//         //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
//     } catch (Exception $e) {

//         Session::flash('mensajee', 'Error al eliminar el tipo! '. $e->getMessage());
//         return redirect(url('/rest/registrar/tipo'));
//     }
//     Session::flash('mensaje', 'Tipo eliminado! ');
//     return redirect(url('/rest/registrar/tipo'));




// }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->file('imagen'));
        $rutaRestaurant = $request->file('imagenRestaurant');
        //$nombreArchivo = uniqid() . $request->file('imagen')->getClientOriginalName();
        //return $request->file('imagen');
        //return $request->all();
        
        if ($rutaRestaurant == '') {
            Session::flash('mensaje', 'Revise los campos!');
        }
        //return redirect()->route('restaurante.index');

        //validacion del formulario
        $request->validate([

            'nameRestaurant' => 'required|max:50',
            'inputOwner' => 'required|max:50',
            'inputPhone' => 'required|max:10',
            'inputAddress' => 'required|max:70',
            'inputHorario' => 'required|max:70',
            //'typeRestaurant' => 'required',
            'inputNameRoute' => 'required|max:50',
            'inputRoute' => 'required|max:350',
            'inputPlate' => 'required|max:50',
            'inputDescription' => 'required|max:700',
            'imagenPlate[].*' => 'required|image',
            'imagenRestaurant[].*' => 'required|image',

        ]);

        //VARIABLES FORM REQUEST
        $nameRestaurant = $request->nameRestaurant;
        $inputOwner = $request->inputOwner;
        $inputPhone = $request->inputPhone;
        $inputAddress = $request->inputAddress;
        $inputHorario = $request->inputHorario;
        $inputNameRoute = $request->inputNameRoute;
        $restaurantType = $request->typeRestaurant;
        $inputRoute = $request->inputRoute;
        $inputPlate = $request->inputPlate;
        $inputDescription = $request->inputDescription;
        $imagenPlate = $request->imagenPlate;
        $imagenRestaurant = $request->imagenRestaurant;
        
        //$= $request->;

        //return $request->file('imagen');
        //$contador = 0;
       
        $urlImagenes = [];
        $urlImagesPlate = [];

       

        if ($request->hasFile('imagenRestaurant')) {

            $imagenesRestaurant = $request->file('imagenRestaurant');
            //IMAGEN PLATE
            $imagenesPlate = $request->file('imagenPlate');

            //dd($imagenes);
            //IMAGEN RESTAURANT

            $mascota = 0;
            if ($request->checkPets) {
                $mascota = 1;
            }else {
                $mascota = 2;
            }


            $client = new Client([

    
                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/restaurante'
            ]);

            try {

                //SEND A NEW RESTAURANT
    
                    $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/restaurante/regi', [
                    'json' => [

                        'nombre_restaurante' =>  $nameRestaurant,

                        'nombre_propietario' => $inputOwner,

                        'direccion' => $inputAddress,

                        'telefono' => $inputPhone,

                        'horario_atencion' => $inputHorario,

                        'fk_id_tipo_res' => $restaurantType,

                        'nombre_ruta' => $inputNameRoute,

                        'link_ruta' => $inputRoute,

                        'nombre_plato' => $inputPlate,

                        'descripcion' => $inputDescription,

                        'link_video' => '6',

                        'mascota' => $mascota

                    ]

                ]);

                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar '. $e->getMessage());
                return redirect()->route('restaurante.index');
                
            }


            if (200 == $response->getStatusCode()) {


                //GET  ID'S


                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/restaurante/last');
                //pasamos los datos a un arreglo
                $lastRestaurantID = $getLastID->json();



                //$lastRestaurantID['id_res'] ;


                //SEND MULTIMEDIA RESTAURANT
                foreach ($imagenesRestaurant as $itemRestaurant) {
                    $nombreArchivoRestaurant = uniqid() . $itemRestaurant->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivoRestaurant;
                    $client = new Client([

                       
                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                        $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_res3',
                                'contents' =>  $lastRestaurantID['id_res']
                            ],
                            [
                                'name' => 'fk_id_plato2',
                                'contents' => ''
                            ],
                            [
                                'name' => 'link_video',
                                'contents' => ''
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemRestaurant, 'r'),
                                'filename' => $nombreArchivoRestaurant,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }


                //SEND IMAGES PLATE

                foreach ($imagenesPlate as $itemPlate) {

                    $nombreArchivoPlate = uniqid() . $itemPlate->getClientOriginalName();
                    $urlImagesPlate[]['url'] = $nombreArchivoPlate;
                    $client = new Client([

                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                        $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_res3',
                                'contents' =>  ''
                            ],
                            [
                                'name' => 'fk_id_plato2',
                                'contents' => $lastRestaurantID['fk_id_plato']
                            ],
                            [
                                'name' => 'link_video',
                                'contents' => ''
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemPlate, 'r'),
                                'filename' => $nombreArchivoPlate,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }





            # code...
            // foreach ($imagenesRestaurant as $itemRestaurant) {


            //     $nombreArchivoRestaurant = uniqid() . $itemRestaurant->getClientOriginalName();
            //     $urlImagenes[]['url'] = $nombreArchivoRestaurant;
            //     //IMAGEN PLATE 
            //     //print('En restaurante : '.$contador);
            //     foreach ($imagenesPlate as $itemPlate) {

            //         # code..
            //         //$contador++;
            //         //print('En plato:'.$contador);
            //         $nombreArchivoPlate = uniqid() . $itemPlate->getClientOriginalName();
            //         $urlImagesPlate[]['url'] = $nombreArchivoPlate;

            //         //dd($urlImagenes) ;


            //         //Conection to the api
            //         $client = new Client([

            //             'base_uri' => 'https://api.destinofusagasuga.gov.co/api/restaurante'
            //         ]);


            //         $client->request ('POST', 'https://api.destinofusagasuga.gov.co/api/restaurante/registrar', [
            //             'multipart' => [
            //                 [
            //                     'name' => 'nombre_restaurante',
            //                     'contents' => $nameRestaurant
            //                 ],
            //                 [
            //                     'name' => 'direccion',
            //                     'contents' => $inputAddress
            //                 ],
            //                 [
            //                     'name' => 'telefono',
            //                     'contents' => $inputPhone
            //                 ],
            //                 [
            //                     'name' => 'horario_atencion',
            //                     'contents' => $inputHorario
            //                 ],
            //                 [
            //                     'name' => 'fk_id_tipo_res',
            //                     'contents' => '1'
            //                 ],
            //                 [
            //                     'name' => 'nombre_ruta',
            //                     'contents' => $inputNameRoute
            //                 ],
            //                 [
            //                     'name' => 'link_ruta',
            //                     'contents' => $inputRoute
            //                 ],
            //                 [
            //                     'name' => 'nombre_plato',
            //                     'contents' => $inputPlate
            //                 ],
            //                 [
            //                     'name' => 'descripcion',
            //                     'contents' => $inputDescription
            //                 ],
            //                 [
            //                     'name' => 'link_video',
            //                     'contents' => '6'
            //                 ],

            //                 // upload images to the api 
            //                 [
            //                     'name' => 'link_foto_restaurante', // name value requires by endpoint
            //                     'contents' => fopen($itemRestaurant, 'r'),
            //                     'filename' => $nombreArchivoRestaurant,
            //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
            //                 ],
            //                 [

            //                     'name' => 'link_foto_plato', // name value requires by endpoint
            //                     'contents' => fopen($itemPlate, 'r'),
            //                     'filename' => $nombreArchivoPlate,
            //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
            //                 ],
            //             ]
            //         ]);
            //     }
            // }



            //return $urlImagenes;
        } 






        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('restaurante.index');
    }
    public function editarRestaurante(){
        // return view('restaurante.edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
   
    public function show(Restaurante $restaurante)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
       
        
        $restaurante = HTTP::get('https://api.destinofusagasuga.gov.co/api/restaurante/rest/'.$id);
        //pasamos los datos a un arreglo
        $responseRestaurante = $restaurante->json();
        
        //pasamos el arreglo a la vista
        $response = $responseRestaurante['informacion'];

        $restaurantTypeArray = [];

         $types = HTTP::get('https://api.destinofusagasuga.gov.co/api/tipo_restaurante');
        //pasamos los datos a un arreglo
        $restaurantTypeArray = $types->json();

        $foto_rests = DB::table('multimedia')->where('fk_id_res3', $id)->get();
        
        $foto_plates = DB::table('multimedia')->where('fk_id_plato2', $id)->get();
    //  dd($foto_plates);
    //     dd($id);
    // dd($response);
        return view('restaurante.edit', compact('response','restaurantTypeArray','foto_rests', 'foto_plates'));
        } catch (\Throwable $th) {
            Session::flash('mensajee', ''. $th->getMessage());
            return view('restaurante.edit', compact('response','restaurantTypeArray', 'foto_rests', 'foto_plates'));
        }
        

    
        
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        

    }
    public function actualizar(Request $request, $id_res,$id_ruta,$id_plato)
    {

        
            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/restaurante'
            ]);
            try {
                $request->validate([
    
                    'nameRestaurant' => 'required|max:50',
                    'inputOwner' => 'required|max:50',
                    'inputPhone' => 'required|max:10',
                    'inputAddress' => 'required|max:70',
                    'inputHorario' => 'required|max:70',
                    'typeRestaurant' => 'required',
                    'inputNameRoute' => 'required|max:50',
                    'inputRoute' => 'required|max:350',
                    'inputPlate' => 'required|max:50',
                    'inputDescription' => 'required|max:700',
                    'imagenPlate.*' => 'required|image',
                    'imagenRestaurant.*' => 'required|image',
        
                ]);
                //1 PARA ACTIVO 2 PARA INACTIVO
                $mascota = 0;
                if ($request->checkPets) {
                    $mascota = 1;
                }else {
                    $mascota = 2;
                };
    
                    $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/restaurante/actualizar/'.$id_res.'/'.$id_ruta.'/'.$id_plato. [
                    'json' => [
                            'nombre' =>  $request->nameRestaurant,
                            'nombre_propietario' => $request->inputOwner,
                            'direccion' =>  $request->inputAddress,
                            'telefono' =>  $request->inputPhone,
                            'horario_atencion' =>  $request->inputHorario,
                            'link_ruta' =>  $request->inputRoute,
                            'nombre_plato' =>  $request->inputPlate,
                            'descripcion'=> $request->inputDescription,
                            'nombre_ruta' => $request->inputNameRoute,
                            'fk_id_tipo_res' => $request->typeRestaurant,
                            'mascota'=> $mascota,
                            
                    ]
                ]);
                $body = $response->getBody();
                $arr_body = json_decode($body);
            } catch (Exception $e) {
                Session::flash('mensaje', 'No se logró actualizar '. $e->getMessage());
                return redirect(url('/restaurante'));
                
            }
           
            return redirect('restaurante');
        
        //$datos = request()->except(['_token','_method']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurante  $restaurante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_res, $id_plato)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/restaurante'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/restaurante/eliminar/'.$id_res.'/'.$id_plato);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se carg[o' . $e->getMessage();
        }
        return redirect('restaurante');
    }
    
    public function eliminar($id_res, $id_plato)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/restaurante'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/restaurante/eliminar/'.$id_res.'/'.$id_plato);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se carg[o' . $e->getMessage();
        }
        return redirect('restaurante');
    }
}







// $client = new Client([

//     'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
// ]);


// $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
//     'multipart' => [
//         [
//             'name' => 'fk_id_res3',
//             'contents' => '46'
//         ],
//         [
//             'name' => 'fk_id_plato2',
//             'contents' => '1'
//         ],
//         [
//             'name' => 'link_video',
//             'contents' => '6'
//         ],
//         [
//             'name' => 'link_foto', // name value requires by endpoint
//             'contents' => fopen($request->file('imagen'), 'r'),
//             'filename' => '$nombreArchivo',
//             //'headers' => array('Content-Type' => mime_content_type($ruta))
//         ],
//     ]
// ]);
