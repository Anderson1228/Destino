<?php

namespace App\Http\Controllers;

use App\Models\Senderismo;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class SenderismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {


            $senderismo = HTTP::get('https://api.destinofusagasuga.gov.co/api/senderismo/mostrar_senderismos');
            //pasamos los datos a un arreglo

            $senderismoArray = $senderismo->json();

            //pasamos el arreglo a la vista

            return view('senderismo.index', compact('senderismoArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información ');
            return view('senderismo.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $typesArray = array(
            1=> 'Hoteles', 2=>'Alojamiento rural fincas',3=>'Centro vacacionales', 4=>'Glamping Camping', 5=>'Parque tematicos', 6=>'Agencia de viages y operadores turisticos', 7=> 'Guias de Turismo',
            8=> 'Transporte turistico',9=> 'Rutas turisticas'
         );


        return view('senderismo.register', compact('typesArray'));
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

            'nombre' => 'required|max:80',
            'descripcion' => 'required|max:1200',
            'link_ubicacion' => 'required|max:300',
            'imagensenderismo[].*' => 'required|image',

        ]);
        

        $urlImagenes = [];

        if ($request->hasFile('imagensenderismo')) {

            $arrayAccesos = [];
            $arreglo = $request->acceso;
            foreach ($arreglo as  $value) {

                array_push($arrayAccesos, $value);
            }


            $caminando = 2;
            $cicla = 2;
            $carro = 2;
            $moto = 2;

            foreach ($request->acceso as  $value) {


                if ($value == 'cicla') {
                    $cicla = 1;
                }
                if ($value == 'carro') {
                    $carro = 1;
                }
                if ($value == 'moto') {
                    $moto = 1;
                }
                if ($value == 'caminando') {
                    $caminando = 1;
                }
            }

            $imagenessenderismo = $request->file('imagensenderismo');


            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/senderismo'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/senderismo/registrar', [
                    'json' => [

                        'nombre' =>  $request->nombre,
                        'descripcion' => $request->descripcion,
                        'caracteristica' => $request->caracteristica,
                        'link_ubicacion' => $request->link_ubicacion,
                        'cicla' => $cicla,
                        'carro' => $carro,
                        'moto' => $moto,
                        'caminando' => $caminando,
                        'tipo_turismo' => $request->typeTurismo


                    ]

                ]);

                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar ' . $e->getMessage());
                return redirect()->route('restaurante.index');
            }
            if ($response->getStatusCode() == 200) {
                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/senderismo/ultima_senderismo');
                //pasamos los datos a un arreglo


                $lastsenderismoID = $getLastID->json();

                //SEND MULTIMEDIA 
                foreach ($imagenessenderismo as $itemsenderismo) {
                    $nombreArchivosenderismo = uniqid() . $itemsenderismo->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivosenderismo;
                    $client = new Client([

                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                    $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_senderismo',
                                'contents' =>  $lastsenderismoID['id_senderismo']
                            ],

                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemsenderismo, 'r'),
                                'filename' => $nombreArchivosenderismo,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        }

        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('senderismo.index');
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
    public function edit($id_senderismo)
    {
        $foto_senderismos = DB::table('multimedia')->where('fk_id_senderismo', $id_senderismo)->get();
        try {


            $senderismo = HTTP::get('https://api.destinofusagasuga.gov.co/api/senderismo/mostrar_senderismo/' . $id_senderismo);
            //pasamos los datos a un arreglo
            $responsesenderismo = $senderismo->json();

            //pasamos el arreglo a la vista
            $response = $responsesenderismo['informacion'];

            $typesArray = array(
                1=> 'Hoteles', 2=>'Alojamiento rural fincas',3=>'Centro vacacionales', 4=>'Glamping Camping', 5=>'Parque tematicos', 6=>'Agencia de viages y operadores turisticos', 7=> 'Guias de Turismo',
                8=> 'Transporte turistico',9=> 'Rutas turisticas'
             );


            //return $response;

            return view('senderismo.edit', compact('response','typesArray','foto_senderismos'));
        } catch (\Throwable $th) {
            return $th;
            Session::flash('mensajee', '' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id_senderismo)
    {




        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/senderismo'
        ]);
        try {
            $request->validate([

                'nombre' => 'required|max:80',
                'descripcion' => 'required|max:1200',
                'link_ubicacion' => 'required|max:300',
                'caracteristica' => 'required|max:50',
               



            ]);

            $arrayAccesos = [];
            $arreglo = $request->acceso;
            $caminando = 2;
            $cicla = 2;
            $carro = 2;
            $moto = 2;
            if ($arreglo != null) {

                foreach ($arreglo as  $value) {

                    array_push($arrayAccesos, $value);
                }




                foreach ($request->acceso as  $value) {


                    if ($value == 'cicla') {
                        $cicla = 1;
                    }
                    if ($value == 'carro') {
                        $carro = 1;
                    }
                    if ($value == 'moto') {
                        $moto = 1;
                    }
                    if ($value == 'caminando') {
                        $caminando = 1;
                    }
                }
            }
            $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/senderismo/actualizar/' . $id_senderismo, [
                'json' => [

                    'nombre' =>  $request->nombre,

                    'descripcion' => $request->descripcion,

                    'link_ubicacion' => $request->link_ubicacion,
                    'caracteristica' => $request->caracteristica,
                    'cicla' => $cicla,
                    'carro' => $carro,
                    'moto' => $moto,
                    'caminando' => $caminando,
                    'tipo_turismo' => $request->typeTurismo

                ]

            ]);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró actualizar ' . $th->getMessage());
            return redirect('senderismo');
        }
        return redirect('senderismo');
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
    public function destroy($id_senderismo)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/senderismo'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/senderismo/eliminar/' . $id_senderismo);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se logró eliminar' . $e->getMessage();
        }
        return redirect('senderismo');
    }
}
