<?php

namespace App\Http\Controllers;

use App\Models\Hamburguesa;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class HamburguesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {


           
            //pasamos los datos a un arreglo

            $hamburguesasArray = Hamburguesa::all();

            //pasamos el arreglo a la vista

            return view('hamburguesas.index', compact('hamburguesasArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información ');
            return view('hamburguesas.index');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



        return view('hamburguesas.register');
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

            'restaurante' => 'required|max:120',
            'direccion' => 'required|max:120',
            'telefono' => 'required|max:120',
            'horario' => 'required|max:120',
            'nombre_hamburguesa' => 'required|max:120',
            'ingredientes' => 'required|max:1200',
            'linkruta' => 'required|max:500',
            'imagenhamburguesas[].*' => 'required|image',

        ]);
        

        $urlImagenes = [];

        if ($request->hasFile('imagenhamburguesas')) {

            $imageneshamburguesas = $request->file('imagenhamburguesas');


            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/hamburguesas'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/hamburguesas/registrar', [
                    'json' => [

                        'restaurante' => $request->restaurante,
                        'direccion' => $request->direccion,
                        'telefono' => $request->telefono,
                        'horario' => $request->horario,
                        'nombre_hamburguesa' => $request->nombre_hamburguesa,
                        'ingredientes' => $request->ingredientes,
                        'linkruta' => $request->linkruta,
                        


                    ]

                ]);

                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar ' . $e->getMessage());
                return redirect()->route('hamburguesas.index');
            }
            if ($response->getStatusCode() == 200) {
                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/hamburguesas/ultima_hamburguesas');
                //pasamos los datos a un arreglo


                $lasthamburguesasID = $getLastID->json();

                //SEND MULTIMEDIA 
                foreach ($imageneshamburguesas as $itemhamburguesas) {
                    $nombreArchivohamburguesas = uniqid() . $itemhamburguesas->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivohamburguesas;
                    $client = new Client([

                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                    $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_hamburguesas',
                                'contents' =>  $lasthamburguesasID['id']
                            ],

                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemhamburguesas, 'r'),
                                'filename' => $nombreArchivohamburguesas,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        }

        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('hamburguesas.index');
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
        $foto_hamburguesas = DB::table('multimedia')->where('fk_id_hamburguesas', $id)->get();
        try {


            $hamburguesas = HTTP::get('https://api.destinofusagasuga.gov.co/api/hamburguesas/mostrar_hamburguesas/' . $id);
            //pasamos los datos a un arreglo
            $responsehamburguesas = $hamburguesas->json();

            //pasamos el arreglo a la vista
            $response = $responsehamburguesas['informacion'];

            


            //return $response;

            return view('hamburguesas.edit', compact('response','foto_hamburguesas'));
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
    public function actualizar(Request $request, $id)
    {




        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/hamburguesas'
        ]);
        try {
            $request->validate([
                'restaurante' => 'required|max:120',
                'direccion' => 'required|max:120',
                'telefono' => 'required|max:120',
                'horario' => 'required|max:120',
                'nombre_hamburguesa' => 'required|max:120',
                'ingredientes' => 'required|max:1200',
                'linkruta' => 'required|max:500',


            ]);

            
            $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/hamburguesas/actualizar/' . $id, [
                'json' => [

                        'restaurante' => $request->restaurante,
                        'direccion' => $request->direccion,
                        'telefono' => $request->telefono,
                        'horario' => $request->horario,
                        'nombre_hamburguesa' => $request->nombre_hamburguesa,
                        'ingredientes' => $request->ingredientes,
                        'linkruta' => $request->linkruta,

                ]

            ]);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró actualizar ' . $th->getMessage());
            return redirect('hamburguesas');
        }
        return redirect('hamburguesas');
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
    public function destroy($id)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/hamburguesas'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/hamburguesas/eliminar/' . $id);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se logró eliminar' . $e->getMessage();
        }
        return redirect('hamburguesas');
    }
}
