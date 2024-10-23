<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PatrimonioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $patrimonio = HTTP::get('https://api.destinofusagasuga.gov.co/api/patrimonio/mostrar_patrimonios');
            //pasamos los datos a un arreglo

            $patrimonioArray = $patrimonio->json();
            
            //pasamos el arreglo a la vista
            return view('patrimonio.index', compact('patrimonioArray'));
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la informacion de los patrimonios');
            return view('patrimonio.index');
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
            1=> 'Casona', 2=>'Monumento',3=>'Cultura'
         );

        return view('patrimonio.register',compact ('typesArray'));
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
            'fecha_creacion' => ['required', 'string', 'max:10'],
            'descripcion' => ['required', 'string', 'max:550'],
            'imagenpatrimonio.*' => 'required|image',
            'direccion' => ['required', 'string', 'max:200'],
            'link_ruta' => ['required', 'string', 'max:300'],

        ]);
        
        if ($request->hasFile('imagenpatrimonio')) {
            $imagenpatrimonio = $request->file('imagenpatrimonio');
            $patrimonio = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/patrimonio/registrar'
            ]);

            try {
                $nombreArchivo = uniqid() . $imagenpatrimonio->getClientOriginalName();
                $urlImagenes['url'] = $nombreArchivo;
                //SEND A NEW RESTAURANT
                 $patrimonio->request('POST', 'https://api.destinofusagasuga.gov.co/api/patrimonio/registrar', [
                    'multipart' => [

                    [
                        'name' => 'nombre' ,
                        'contents' =>  $request->nombre
                    ],

                    [
                        'name' => 'fecha_creacion' ,
                        'contents' =>  $request->fecha_creacion
                    ],
                    [
                        'name' => 'descripcion' ,
                        'contents' =>  $request->descripcion
                    ],

                    [
                        'name' => 'direccion' ,
                        'contents' =>  $request->direccion
                    ],
                    [
                        'name' => 'link_ruta' ,
                        'contents' =>  $request->link_ruta
                    ],
                    [
                    
                            'name' => 'tipo_patrimonio' ,
                            'contents' => $request->typePatrimonio
                    ],

                    [
                        'name' => 'link_foto_patrimonio', // name value requires by endpoint
                        'contents' => fopen($imagenpatrimonio, 'r'),
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


        Session::flash('mensaje', 'patrimonio registrado! ');
        return redirect('patrimonio');
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
    public function edit($id_patrimonio)
    {

        $foto_patrimonios = DB::table('multimedia')->where('fk_id_patrimonio', $id_patrimonio)->get();
                try {
                    $typesArray = array(
                        1=> 'Casona', 2=>'Monumento',3=>'Cultura'
                     );
            $patrimonio = HTTP::get('https://api.destinofusagasuga.gov.co/api/patrimonio/mostrar_patrimonio/'.$id_patrimonio);
    //pasamos los datos a un arreglo
    $responsepatrimonio = $patrimonio->json();
    $response = $responsepatrimonio['informacion'];
    //return $response;

    //pasamos el arreglo a la vista
                  // return $response;
    return view('patrimonio.edit', compact('response', 'typesArray', 'foto_patrimonios'));


                } catch (\Throwable $th) {
                  
                }

 

        return view('patrimonio.edit');
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
    public function destroy($id_patrimonio)
    {

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/patrimonio'
        ]);
        try {
            $user = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/patrimonio/eliminar/' . $id_patrimonio);
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'Error al eliminar el patrimonio! '.$th);
            return redirect('patrimonio');
        }
        Session::flash('mensaje', 'patrimonio eliminado!');
        return redirect('patrimonio');
    }
    public function actualizar(Request $request, $id_patrimonio)
    {
        

        $request->validate([
            'nombre' => ['required', 'string', 'max:80'],
            'fecha_creacion' => ['required', 'string', 'max:10'],
            'descripcion' => ['required', 'string', 'max:550'],
            'link_ruta' => ['required', 'string', 'max:300'],
            'direccion' => ['required', 'string', 'max:200'],
            
        ]);

        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/patrimonio'
        ]);
        try {
            $patrimonio = $client->request(
                'PUT',
                'https://api.destinofusagasuga.gov.co/api/patrimonio/actualizar/' . $id_patrimonio,
                [
                    'json' => [

                        'nombre' => $request->nombre,
                        'fecha_creacion' => $request->fecha_creacion,
                        'descripcion' => $request->descripcion,
                        'direccion' => $request->direccion,
                        'link_ruta' => $request->link_ruta,
                        'tipo_patrimonio' =>$request->typePatrimonio


                    ]

                ]
            );
        } catch (\Throwable $th) {

            Session::flash('mensaje', 'Error al actualizar el patrimonio! '.$th);
            return redirect('patrimonio');
        }
        Session::flash('mensaje', 'patrimonio actualizado! ');
        return redirect('patrimonio');
    }
}
