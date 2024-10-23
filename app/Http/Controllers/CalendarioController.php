<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Calendario;
use GuzzleHttp\Psr7;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {


            $calendario = HTTP::get('https://api.destinofusagasuga.gov.co/api/calendario/mostrar_calendario');
            //pasamos los datos a un arreglo

            $calendarioArray = $calendario->json();

            //pasamos el arreglo a la vista
            return view('calendario.index', compact('calendarioArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información ');
            return view('calendario.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendario.register');
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

            'titulo' => 'required|max:80',
            'descripcion' => 'required|max:1200',
            'direccion' => 'required|max:300',
            'ruta' => 'required|max:300',
            'imagencalendario[].*' => 'required|image',

        ]);

        $urlImagenes = [];

        if ($request->hasFile('imagencalendario')) {
            $imagenescalendario = $request->file('imagencalendario');


            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/calendario'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/calendario/registrar', [
                    'json' => [

                        'titulo' =>  $request->titulo,

                        'descripcion' => $request->descripcion,

                        'direccion' => $request->direccion,

                        'ruta' => $request->ruta,

                    ]

                ]);

                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar ' . $e->getMessage());
                return redirect()->route('calendario.index');
            }
            if ($response->getStatusCode() == 200) {
                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/calendario/ultima_calendario');
                //pasamos los datos a un arreglo
                
                
                $lastcalendarioID = $getLastID->json();

                //SEND MULTIMEDIA 
                foreach ($imagenescalendario as $itemcalendario) {
                    $nombreArchivocalendario = uniqid() . $itemcalendario->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivocalendario;
                    $client = new Client([

                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                    $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_calendario',
                                'contents' =>  $lastcalendarioID['informacion'][0]['calendario']['id']
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemcalendario, 'r'),
                                'filename' => $nombreArchivocalendario,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        }

        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('calendario.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    public function actualizar(Request $request, $id)
    {


        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/calendario'
        ]);
        try {
            $request->validate([

                'titulo' => 'required|max:80',
                'descripcion' => 'required|max:1200',
                'direccion' => 'required|max:300',
                'ruta' => 'required|max:300',
                'imagencalendario[].*' => 'required|image',

            ]);


            $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/calendario/actualizar/' . $id, [
                'json' => [

                    'titulo' =>  $request->titulo,

                    'descripcion' => $request->descripcion,

                    'direccion' => $request->direccion,

                    'ruta' => $request->ruta,
                ]

            ]);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró actualizar '. $th->getMessage());
            return redirect('calendario');
        }
        return redirect('calendario');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto_calendario = DB::table('multimedia')->where('fk_id_calendario', $id)->get();
        try {
            

            $calendario = HTTP::get('https://api.destinofusagasuga.gov.co/api/calendario/mostrar_calendario/' . $id);
            //pasamos los datos a un arreglo
            $responsecalendario = $calendario->json();

            //pasamos el arreglo a la vista
            $response = $responsecalendario['informacion'];
            return view('calendario.edit', compact('response','foto_calendario'));
        } catch (\Throwable $th) {
            Session::flash('mensajee', '' . $th->getMessage());
            return view('calendario.edit', compact('response', 'foto_calendario'));
        }
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
    public function destroy($id)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/calendario'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/calendario/eliminar/'. $id);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se logró eliminar' . $e->getMessage();
        }
        return redirect('calendario');

    }
}
