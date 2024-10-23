<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PersonajesHistoricosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $personajes = HTTP::get('https://api.destinofusagasuga.gov.co/api/personaje_historico/mostrar_personajes');
            //pasamos los datos a un arreglo

            $personajesArray = $personajes->json();

            //pasamos el arreglo a la vista
            return view('personajes.index', compact('personajesArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la informacion de los personajes');
            return view('personajes.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personajes.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'fecha_nacimiento' => ['required', 'string', 'max:10'],
            'descripcion' => ['required', 'string', 'max:550'],
            'imagenPersonaje.*' => ['required|image'],

        ]);

        
        if ($request->hasFile('imagenPersonaje')) {
            $imagenPersonaje = $request->file('imagenPersonaje');
            $personaje = new Client([
               

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/personaje_historico/registrar'
            ]);

            try {
                $nombreArchivo = uniqid() . $imagenPersonaje->getClientOriginalName();
                $urlImagenes['url'] = $nombreArchivo;
                //SEND A NEW RESTAURANT
                 $personaje->request('POST', 'https://api.destinofusagasuga.gov.co/api/personaje_historico/registrar', [
                    'multipart' => [

                    [
                        'name' => 'nombre' ,
                        'contents' =>  $request->nombre
                    ],

                    [
                        'name' => 'fecha_nacimiento' ,
                        'contents' =>  $request->fecha_nacimiento
                    ],
                    [
                        'name' => 'descripcion' ,
                        'contents' =>  $request->descripcion
                    ],

                    [
                        'name' => 'link_foto_personaje', // name value requires by endpoint
                        'contents' => fopen($imagenPersonaje, 'r'),
                        'filename' => $nombreArchivo,
                        //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                    ], 
                    ]

                ]);

                // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
                     
            } catch (\Throwable $th) {

                return 'NO se registro' . $th->getMessage();
            }

            // if ($response == null) {


            //     if ($response->getStatusCode == 200) {
            //         $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/personaje_historico/ultimo_personaje');
            //         //pasamos los datos a un arreglo
            //         $lastPersonajeID = $getLastID->json();

            //         $nombreArchivo = uniqid() . $imagenPersonaje->getClientOriginalName();
            //         $urlImagenes[]['url'] = $nombreArchivo;
            //         $client = new Client([

            //             'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
            //         ]);


            //         $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
            //             'multipart' => [
            //                 [
            //                     'name' => 'fk_id_res3',
            //                     'contents' =>  ''
            //                 ],
            //                 [
            //                     'name' => 'fk_id_plato2',
            //                     'contents' => ''
            //                 ],
            //                 [
            //                     'name' => 'link_video',
            //                     'contents' => ''
            //                 ],
            //                 [
            //                     'name' => 'fk_id_cafe',
            //                     'contents' => '',
            //                 ],
            //                 [
            //                     'name' => 'fk_id_personaje',
            //                     'contents' => $lastPersonajeID['id_personaje'],
            //                 ],
            //                 [
            //                     'name' => 'link_foto', // name value requires by endpoint
            //                     'contents' => fopen($imagenPersonaje, 'r'),
            //                     'filename' => $nombreArchivo,
            //                     //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
            //                 ],
            //             ]
            //         ]);
            //     }
            // }
        }else{
            return 'Debe seleccionar una imagen';
        }



        Session::flash('mensaje', 'Personaje registrado! ');
        return redirect('personajes');
    }
    public function registrar_personaje(Request $request)
    {

        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'fecha_nacimiento' => ['required', 'string', 'max:8'],
            'descripcion' => ['required', 'string', 'max:550'],
            'imagenPersonaje.*' => 'required|image',

        ]);
        if ($request->hasFile('imagenCafe')) {
            $imagenPersonaje = $request->file('imagenPersonaje');
            $personaje = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/personaje_historico/registrar'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $personaje->request('POST', 'https://api.destinofusagasuga.gov.co/api/personaje_historico/registrar', [
                    'json' => [


                        'nombre' => $request->nombre,

                        'fecha_nacimiento' => $request->fecha_nacimiento,

                        'descripcion' => $request->descripcion,
                    ]

                ]);

                // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API

            } catch (\Throwable $th) {

                return 'NO se registro' . $th->getMessage();
            }

            if ($response != null) {


                if ($response->getStatusCode == 200) {
                    $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/personaje_historico/ultimo_personaje');
                    //pasamos los datos a un arreglo
                    $lastPersonajeID = $getLastID->json();

                    $nombreArchivo = uniqid() . $imagenPersonaje->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivo;
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
                                'contents' => ''
                            ],
                            [
                                'name' => 'link_video',
                                'contents' => ''
                            ],
                            [
                                'name' => 'fk_id_cafe',
                                'contents' => '',
                            ],
                            [
                                'name' => 'fk_id_personaje',
                                'contents' => $lastPersonajeID['id_personaje'],
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($imagenPersonaje, 'r'),
                                'filename' => $nombreArchivo,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        }


        Session::flash('mensaje', 'Personaje registrado! ');
        return redirect('personajes');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_personaje)
    {
        $foto_personajes = DB::table('multimedia')->where('fk_id_personaje', $id_personaje)->get();

                try {
                    
            $personaje = HTTP::get('https://api.destinofusagasuga.gov.co/api/personaje_historico/mostrar_personaje/'.$id_personaje);
    //pasamos los datos a un arreglo
    $responsePersonaje = $personaje->json();
    $response = $responsePersonaje['informacion'];
    
    //pasamos el arreglo a la vista
                  // return $response;
    return view('personajes.edit', compact('response','foto_personajes'));


                } catch (\Throwable $th) {
                  
                }

 

        return view('personajes.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_personaje)
    {

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/personaje_historico'
        ]);
        try {
            $user = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/personaje_historico/eliminar/' . $id_personaje);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'Error al eliminar el personaje! '.$th);
            return redirect('personajes');
        }
        Session::flash('mensaje', 'Personaje eliminado!');
        return redirect('personajes');
    }
    public function actualizar(Request $request, $id_personaje)
    {
        

        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'fecha_nacimiento' => ['required', 'string', 'max:10'],
            'descripcion' => ['required', 'string', 'max:550'],
        ]);

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/personaje_historico'
        ]);
        try {
            $personaje = $client->request(
                'PUT',
                'https://api.destinofusagasuga.gov.co/api/personaje_historico/actualizar/' . $id_personaje,
                [
                    'json' => [

                        'nombre' => $request->nombre,
                        'fecha_nacimiento' => $request->fecha_nacimiento,
                        'descripcion' => $request->descripcion,


                    ]

                ]
            );
        } catch (\Throwable $th) {

            Session::flash('mensaje', 'Error al actualizar el personaje! ');
            return redirect('personajes');
        }
        Session::flash('mensaje', 'Personaje actualizado! ');
        return redirect('personajes');
    }
}
