<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SimbolosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $simbolo = HTTP::get('https://api.destinofusagasuga.gov.co/api/simbolo/mostrar_simbolos');
            //pasamos los datos a un arreglo

            $simboloArray = $simbolo->json();

            //pasamos el arreglo a la vista
            return view('simbolo.index', compact('simboloArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la informacion de los simbolos');
            return view('simbolo.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('simbolo.register');
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
            'descripcion' => ['required', 'string', 'max:550'],
            'imagenSimbolo.*' => ['required|image'],

        ]);
        
        if ($request->hasFile('imagenSimbolo')) {
            $imagenSimbolo = $request->file('imagenSimbolo');
            $simbolo = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/simbolo/registrar'
            ]);

            try {
                $nombreArchivo = uniqid() . $imagenSimbolo->getClientOriginalName();
                $urlImagenes['url'] = $nombreArchivo;
                //SEND A NEW RESTAURANT
                 $simbolo->request('POST', 'https://api.destinofusagasuga.gov.co/api/simbolo/registrar', [
                    'multipart' => [

                    [
                        'name' => 'nombre' ,
                        'contents' =>  $request->nombre
                    ],

                   
                    [
                        'name' => 'descripcion' ,
                        'contents' =>  $request->descripcion
                    ],


                    [
                        'name' => 'link_foto_simbolo', // name value requires by endpoint
                        'contents' => fopen($imagenSimbolo, 'r'),
                        'filename' => $nombreArchivo,
                        //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                    ], 
                    ]

                ]);

                // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
                     
            } catch (\Throwable $th) {

                return 'NO se registro' . $th->getMessage();
            }

           
        }else{
            return 'Debe seleccionar una imagen';
        }



        Session::flash('mensaje', 'simbolo registrado! ');
        return redirect('simbolo');
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
    public function edit($id_simbolo)
    {
        $foto_simbolos = DB::table('multimedia')->where('fk_id_simbolo', $id_simbolo)->get();
                try {
                    
            $simbolo = HTTP::get('https://api.destinofusagasuga.gov.co/api/simbolo/mostrar_simbolo/'.$id_simbolo);
    //pasamos los datos a un arreglo
    $responseSimbolo = $simbolo->json();
    $response = $responseSimbolo['informacion'];

    //pasamos el arreglo a la vista
                  // return $response;
    return view('simbolo.edit', compact('response','foto_simbolos'));


                } catch (\Throwable $th) {
                  
                }

 

        return view('simbolo.edit');
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
    public function destroy($id_simbolo)
    {

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/simbolo'
        ]);
        try {
            $user = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/simbolo/eliminar/' . $id_simbolo);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'Error al eliminar el simbolo! '.$th);
            return redirect('simbolo');
        }
        Session::flash('mensaje', 'simbolo eliminado!');
        return redirect('simbolo');
    }
    public function actualizar(Request $request, $id_simbolo)
    {
        

        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'descripcion' => ['required', 'string', 'max:550'],
        ]);

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/simbolo'
        ]);
        try {
            $simbolo = $client->request(
                'PUT',
                'https://api.destinofusagasuga.gov.co/api/simbolo/actualizar/' . $id_simbolo,
                [
                    'json' => [

                        'nombre' => $request->nombre,
                        'descripcion' => $request->descripcion,
                        


                    ]

                ]
            );
        } catch (\Throwable $th) {

            Session::flash('mensaje', 'Error al actualizar el simbolo! ');
            return redirect('simbolo');
        }
        Session::flash('mensaje', 'simbolo actualizado! ');
        return redirect('simbolo');
    }
}
