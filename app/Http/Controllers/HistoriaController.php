<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historia;
use GuzzleHttp\Psr7;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //link del api
        try {


            $historia = HTTP::get('https://api.destinofusagasuga.gov.co/api/historia/mostrar_historia');
            //pasamos los datos a un arreglo

            $historiaArray = $historia->json();

            //pasamos el arreglo a la vista
            return view('historia.index', compact('historiaArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información ');
            return view('historia.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historia.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|max:80',
            'descripcion' => 'required|max:1200',
            'link_ubicacion' => 'required|max:300',
            'imagenHistoria[].*' => 'required|image',

        ]);

        $urlImagenes = [];

        if ($request->hasFile('imagenHistoria')) {
            $imagenesHistoria = $request->file('imagenHistoria');


            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/historia'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/historia/registrar', [
                    'json' => [

                        'title' =>  $request->title,

                        'descripcion' => $request->descripcion,

                        'link_ubicacion' => $request->link_ubicacion,


                    ]

                ]);

                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar ' . $e->getMessage());
                return redirect()->route('restaurante.index');
            }
            if ($response->getStatusCode() == 200) {
                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/historia/ultima_historia');
                //pasamos los datos a un arreglo
                
                $lastHistoriaID = $getLastID->json();
               
                                //SEND MULTIMEDIA 
                foreach ($imagenesHistoria as $itemHistoria) {
                    $nombreArchivoHistoria = uniqid() . $itemHistoria->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivoHistoria;
                    $client = new Client([

                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                    $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_historia',
                                'contents' =>  $lastHistoriaID['informacion'][0]['historia']['id_historia']
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemHistoria, 'r'),
                                'filename' => $nombreArchivoHistoria,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        }

        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('historia.index');
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
    public function edit($id)
    {
        $foto_historias = DB::table('multimedia')->where('fk_id_historia', $id)->get();
        try {
            

            $historia = HTTP::get('https://api.destinofusagasuga.gov.co/api/historia/mostrar_historia/' . $id);
            //pasamos los datos a un arreglo
            $responseHistoria = $historia->json();

            //pasamos el arreglo a la vista
            $response = $responseHistoria['informacion'];

            return view('historia.edit', compact('response','foto_historias'));
        } catch (\Throwable $th) {
            report($th);
            Session::flash('mensajee', '' . $th->getMessage());
            return view('historia.edit', compact('response', 'foto_historias'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id_historia)
    {


        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/historia'
        ]);
        try {
            $request->validate([

                'title' => 'required|max:80',
                'descripcion' => 'required|max:1200',
                'link_ubicacion' => 'required|max:300',
                'imagenHistoria[].*' => 'required|image',

            ]);


            $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/historia/actualizar/' . $id_historia, [
                'json' => [

                    'title' =>  $request->title,

                    'descripcion' => $request->descripcion,

                    'link_ubicacion' => $request->link_ubicacion,


                ]

            ]);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró actualizar '. $th->getMessage());
            return redirect('historia');
        }
        return redirect('historia');
    }
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
    public function destroy($id_historia)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/historia'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/historia/eliminar/'. $id_historia);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se logró eliminar' . $e->getMessage();
        }
        return redirect('historia');


    }
}
