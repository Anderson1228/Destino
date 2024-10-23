<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ActualizarFotoRequest;

use App\Models\Multimedia;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $multimedia = Multimedia::find($id);
        
         return view ('foto.index', \compact('multimedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_multi)
    {   
        $multimedia=Multimedia::find($id_multi);
           
         //return $request;
         $request->validate([
            
            'link_foto.*' => 'required|image',

        ]);

        
        if ($request->hasFile('link_foto')) {
           
            $link_foto = $request->file('link_foto');
            
            // $image = "data:image/png;base64,".base64_encode(file_get_contents($link_foto));
      
            // // dd($image);

            // $a = base64_decode($image);
            // $b = array();
            // foreach(str_split($a) as $c)
            //     $b[] = sprintf("%08b", ord($c));
                
            //     $cadenaEncriptada = Crypt::encryptString($b[]);
                
            $cliente = new Client([
               

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia/actualizar'
            ]);

            try {
                $nombreArchivo = uniqid() . $link_foto->getClientOriginalName();
                $urlImagenes['url'] = $nombreArchivo;
                //SEND A NEW RESTAURANT
                $r = $cliente->request('POST','https://api.destinofusagasuga.gov.co/api/multimedia/actualizar/'.$id_multi, [
                    
                    'multipart' => [
                    [
                        'name' => 'link_foto', // name value requires by endpoint
                        'contents' => fopen($link_foto, 'r'),
                        'filename' => $nombreArchivo,
                        //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                    ], 
                    ]

                ]);

                // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API                     
            } catch (\Throwable $th) {

                return 'NO se actualizo' . $th->getMessage();
            }

        }else{
            return 'Debe seleccionar una imagen';
        }



        Session::flash('mensaje', 'foto registrado! ');
        return redirect('restaurante');
    }
    

        // dd($request->link_foto_restaurante);
       
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
