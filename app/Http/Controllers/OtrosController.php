<?php

namespace App\Http\Controllers;


use GuzzleHttp\Psr7;
use App\Models\Otrosservicios;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use function PHPUnit\Framework\isEmpty;

class OtrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MOSTRAR TODOS LOS OTROS SERVICIOS
        //link del api
        try {
            $otrosservicios = HTTP::get('https://api.destinofusagasuga.gov.co/api/otrosservicios');
            //pasamos los datos a un arreglo
            $otrosserviciosArray = $otrosservicios->json();  
            //pasamos el arreglo a la vista
                return view('otrosservicios.index', compact('otrosserviciosArray'));
            
            
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la información '.$th);
            return view('otrosservicios.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //MOSTRAR TODOS LOS TIPOS DE otrosservicios
        //link del api
        try {
            $types = HTTP::get('https://api.destinofusagasuga.gov.co/api/tiposservicio');
            //pasamos los datos a un arreglo
            $otrosTypeArray = $types->json();
            //pasamos el arreglo a la vista
            return view('otrosservicios.form', compact('otrosTypeArray'));
        } catch (\Throwable $th) {
            return view('otrosservicios.form');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rutaotrosservicios = $request->file('imagenOtro');       
        if ($rutaotrosservicios == '') {
            Session::flash('mensaje', 'Revise los campos!');
        }   
        $request->validate([
            'nombre' => 'required|max:50',
            'telefono' => 'required|max:10',
            'horario' => 'required|max:70',
            'link' => 'required|max:70',
            'direccion' => 'required|max:70',
            'descripcion' => 'required|max:700',
            'tiposservicio' => 'required|max:50',
            'imagenOtro[].*' => 'required|image',
        ]);

        //VARIABLES FORM REQUEST
        $nombre = $request->nombre;
        $telefono = $request->telefono;
        $horario = $request->horario;
        $link = $request->link;
        $direccion = $request->direccion;
        $descripcion = $request->descripcion;
        $tiposservicio = $request->tiposservicio;
        $imagenOtro = $request->imagenOtro; 
        $urlImagenes = [];
        if ($request->hasFile('imagenOtro')) {
            $imagenesOtro = $request->file('imagenOtro');
            $client = new Client([
                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/otrosservicios'
            ]);
            try {
                    $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/otrosservicios/regi', [
                    'json' => [
                        'nombre' =>  $nombre,
                        'telefono' => $telefono,
                        'horario' => $horario,
                        'link' => $link,
                        'direccion' => $direccion,
                        'descripcion' => $descripcion,
                        'tiposservicio' => $tiposservicio,
                    ]
                ]);
                //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'No se logró registrar '. $e->getMessage());
                return redirect()->route('otrosservicios.index');
                
            }
            if (200 == $response->getStatusCode()) {
                $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/otrosservicios/last');
                //pasamos los datos a un arreglo
                $lastotrostID = $getLastID->json();
                foreach ($imagenesOtro as $itemOtros) {
                    $nombreArchivoOtros = uniqid() . $itemOtros->getClientOriginalName();
                    $urlImagenes[]['url'] = $nombreArchivoOtros;
                    
                    $client = new Client([
                        'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                    ]);


                        $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                        'multipart' => [
                            [
                                'name' => 'fk_id_servicio',
                                'contents' =>  $lastotrostID['id']
                            ],
                            [
                                'name' => 'link_foto', // name value requires by endpoint
                                'contents' => fopen($itemOtros, 'r'),
                                'filename' => $nombreArchivoOtros,
                                //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                            ],
                        ]
                    ]);
                }
            }
        } 






        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('otrosservicios.index');
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
     * @param  \App\Models\Otrosservicios  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto_otros = DB::table('multimedia')->where('fk_id_servicio', $id)->get(); 
        
        try {
           
            $otrosservicios = HTTP::get('https://api.destinofusagasuga.gov.co/api/otrosservicios/rest/'.$id);
            
            //pasamos los datos a un arreglo
            $responseOtrosservicios= $otrosservicios->json();
            
            //pasamos el arreglo a la vista
            $response = $responseOtrosservicios['informacion'];
            // dd($response);
            $otrosTypeArray = [];
    
            $types = HTTP::get('https://api.destinofusagasuga.gov.co/api/tiposservicio');
            //pasamos los datos a un arreglo

            $otrosTypeArray = $types->json();        
            
        //  dd($foto_plates);
        //     dd($id);
        // dd($response);
            return view('otrosservicios.edit', compact('response','otrosTypeArray','foto_otros'));
            } catch (\Throwable $th) {
                Session::flash('mensajee', ''. $th->getMessage());
                return view('otrosservicios.edit', compact('response','otrosTypeArray','foto_otros'));
            }      
    }

    
    public function update(Request $request, $id)
    {
        //
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

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/otrosservicios'
            ]);
            try {
                $request->validate([
    
                    'nombre' => 'required|max:50',
                    'telefono' => 'required|max:10',
                    'horario' => 'required|max:70',
                    'link' => 'required|max:70',
                    'direccion' => 'required|max:70',
                    'descripcion' => 'required|max:700',
                    'tiposservicio' => 'required|max:50',
                    'imagenOtro[].*' => 'required|image',
        
                ]);         
                    $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/otrosservicios/actualizar/'.$id. [
                    'json' => [
                            
                                'nombre' =>  $request->nombre,
                                'telefono' => $request->telefono,
                                'horario' => $request->horario,
                                'link' => $request->link,
                                'direccion' => $request->direccion,
                                'descripcion' => $request->descripcion,
                                'tiposservicio' =>  $request->tiposservicio,
                    ]
                ]);
                
                $body = $response->getBody();
                $arr_body = json_decode($body);
            } catch (Exception $e) {
                Session::flash('mensaje', 'No se logró actualizar '. $e->getMessage());
                return redirect(url('otrosservicios'));
                
            }
           
            return redirect('otrosservicios');
        
        //$datos = request()->except(['_token','_method']);
        
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
            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/otrosservicios'
        ]);
        try {
            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/otrosservicios/eliminar/'. $id);
            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {
            return 'No se carg[o' . $e->getMessage();
        }
        return redirect('otrosservicios');
    }
    public function eliminar($id)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/otrosservicios'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/otrosservicios/eliminar/'.$id);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'No se carg[o' . $e->getMessage();
        }
        return redirect('otrosservicios');
    }
}
