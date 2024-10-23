<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7;
use App\Models\Cafe;
use App\Models\RedSocial;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isEmpty;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //MOSTRAR TODOS LOS CAFE
        try {
            $cafes = HTTP::get('https://api.destinofusagasuga.gov.co/api/cafe');
            //pasamos los datos a un arreglo

            $cafesArray = $cafes->json();

            //pasamos el arreglo a la vista

            return view('cafe.index', compact('cafesArray'));
        } catch (Exception $e) {
            Session::flash('mensaje', 'No se logró cargar la información ');
            return view('cafe.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cafe.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //dd($request->file('imagen'));

        //$nombreArchivo = uniqid() . $request->file('imagen')->getClientOriginalName();
        //return $request->file('imagen');
        //return $request->all();
        Session::flash('mensaje', 'Registro guardado!');

        //return redirect()->route('restaurante.index');

        //validacion del formulario
        $request->validate([

            'nameCafe' => 'required|max:50',
            'inputAddress' => 'required|max:70',
            'inputHorario' => 'required|max:70',
            'historia' => 'required|max:700',
            'origen_cafe' => 'required|max:500',
            'imagenCafe.*' => 'required|image',

        ]);

        //VARIABLES FORM REQUEST
        $nameCafe = $request->nameCafe;
        $inputAddress = $request->inputAddress;
        $inputHorario = $request->inputHorario;
        $historia = $request->historia;
        $pagina_web = $request->pagina_web;
        $red_social = $request->social;
        $origen_cafe = $request->origen_cafe;
        $imagenCafe = $request->imagenCafe;

        //$= $request->;

        //return $request->file('imagen');
        //$contador = 0;
        $urlImagenes = [];
        $urlImagesPlate = [];
        if ($request->hasFile('imagenCafe')) {

            //IMAGENES CAFE
            $imagenesCafe = $request->file('imagenCafe');


            //dd($imagenes);

            //arreglo en el cual se guardarán los servicios seleccionados
            $arrayServicios = [];


            // return $request->servicio_adicional;


            $arreglo = $request->servicio_adicional;
            foreach ($arreglo as $key => $value) {

                array_push($arrayServicios, $value);
            }


            // DEFINIMOS LAS VARIABLES DE LOS SERVICIOS A 2 YA QUE EL 2 SERá tomado como desactivado y 1 como activado
            $pagos = 2;
            $musica = 2;
            $banio  = 2;
            $wifi = 2;
            $ninguno = 2;
            $otroServicio = 2;



            //  LOS SERVICIOS LOS ESTOY RECIBIENDO COMO UNA RREGLO, NECESITO ASIGNARLOS COMO UNA CADENA DE TEXTO NADA MAS
            $servicios = '';
            if ($request->servicio_adicional  != null) {
                foreach ($request->servicio_adicional as  $value) {

                    if (empty($servicios)) {
                        $servicios =  $value;
                    } else {
                        $servicios = $servicios . ', ' .  $value;
                    }
                }



                foreach ($request->servicio_adicional as  $value) {

                    if ($value == 'pagos_digitales') {
                        $pagos = 1;
                    }
                    if ($value == 'musica_vivo') {
                        $musica = 1;
                    }
                    if ($value == 'zona_wifi') {
                        $wifi = 1;
                    }
                    if ($value == 'ninguno') {
                        $ninguno = 1;
                    }
                    if ($value == 'otro') {
                        $otroServicio = 1;
                    }
                    if ($value == 'banio') {
                        $banio = 1;
                    }
                }
            }

            // DEFINIMOS LAS VARIABLES DE EL MENU A 2 YA QUE EL 2 SERá tomado como desactivado y 1 como activado
            $pasteleria = 2;
            $licores = 2;
            $comidas_rapidas = 2;
            $helados = 2;
            $otro =  2;

            $menu = $request->menu;

            if ($request->menu == 'pasteleria') {
                $pasteleria = 1;
            } else if ($request->menu == 'licores') {
                $licores = 1;
            } else if ($request->menu == 'comidas_rapidas') {
                $comidas_rapidas = 1;
            } else if ($request->menu == 'helados') {
                $helados = 1;
            } else if ($request->menu == 'otro') {
                $otro = 1;
            }

            $response = '';

            $client = new Client([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/cafe'
            ]);

            try {

                //SEND A NEW RESTAURANT
                $response = $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/cafe/registrar', [

                    'json' => [


                        'nombre' => $nameCafe,
                        'direccion' => $inputAddress,
                        'historia' => $historia,
                        'origen_cafe' => $origen_cafe,
                        'horario_atencion' => $inputHorario,

                        'pagina_web' => $pagina_web,

                        'pasteleria' => $pasteleria,

                        'licores' => $licores,

                        'comidas_rapidas' =>  $comidas_rapidas,

                        'helados' => $helados,

                        'menu' => $menu,

                        'otro'  => $otro,

                        //  'menu' => $menu,

                        'banio' => $banio,

                        'pagos_digitales' => $pagos,

                        'musica_vivo'  => $musica,

                        'zona_wifi' => $wifi,

                        'ninguno' => $ninguno,

                        'otro_servicio' => $otroServicio,

                        'servicios' => $servicios
                        //  'servicios' => $arrayServicios



                    ]

                ]);

                // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
            } catch (Exception $e) {
                Session::flash('mensajee', 'Error al registrar el café! ' . $e->getMessage());
                return redirect('cafe');
                //return 'Error al registrar' . $e->getMessage();
            }

            if ($response != null) {



                if (200 == $response->getStatusCode()) {
                    //GET  ID




                    $getLastID = HTTP::get('https://api.destinofusagasuga.gov.co/api/cafe/last/ca');
                    //pasamos los datos a un arreglo
                    $lastCafeID = $getLastID->json();
                    //$lastCafeID['id_cafe']

                    
                    if (!empty($red_social)) {

              
                        foreach ($red_social as  $value) {
                            $redesSociales = new RedSocial();
                            $redesSociales->fk_id_cafe = $lastCafeID['id_cafe'];
                            $redesSociales->link_red = $value;
                            $redesSociales->save();
                        }
                    }



                    //SEND MULTIMEDIA CAFE
                    foreach ($imagenesCafe as $itemCafe) {
                        $nombreArchivoCafe = uniqid() . $itemCafe->getClientOriginalName();
                        $urlImagenes[]['url'] = $nombreArchivoCafe;
                        $client = new Client([

                            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/multimedia'
                        ]);


                        $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/multimedia/registrar', [
                            'multipart' => [
                                [
                                    'name' => 'fk_id_cafe',
                                    'contents' => $lastCafeID['id_cafe']
                                ],
                                [
                                    'name' => 'link_foto', // name value requires by endpoint
                                    'contents' => fopen($itemCafe, 'r'),
                                    'filename' => $nombreArchivoCafe,
                                    //                     //'headers' => array('Content-Type' => mime_content_type($ruta))
                                ],
                            ]
                        ]);
                    }
                }
            }
        }
        Session::flash('mensaje', 'Registro guardado!');

        //return $contador;

        return redirect()->route('cafe.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $cafe = HTTP::get('https://api.destinofusagasuga.gov.co/api/cafe/' . $id);
        //pasamos los datos a un arreglo
        $responseCafe = $cafe->json();

        //pasamos el arreglo a la vista
        $response = $responseCafe['informacion'];




        $redesSociales = DB::select('SELECT * from red_social WHERE fk_id_cafe = ' . $id);
        $foto_cafes = DB::table('multimedia')->where('fk_id_cafe', $id)->get();
        // if ($redesSociales == null) {
        //    return 'Somos vacios';
        // }
        // return $redesSociales;
        // foreach ($response as $value) {
        //     foreach ($value['ruta'] as $value) {
        //         return ($value['id_ruta']);
        //     }

        // }

        return view('cafe.edit', compact('response', 'redesSociales','foto_cafes'));
    }
    public function actualizar(Request $request, $id_cafe, $id_menu, $id_servicio_adicional)
    {


        //arreglo en el cual se guardarán los servicios seleccionados
        $arrayServicios = [];


        // return $request->servicio_adicional;
        $menu = $request->menu;
        $servicios = '';
        $pagos = 2;
        $musica = 2;
        $banio  = 2;
        $wifi = 2;
        $ninguno = 2;
        $otroServicio = 2;
        if ($request->servicio_adicional != null) {
            foreach ($request->servicio_adicional as  $value) {

                if (empty($servicios)) {
                    $servicios =  $value;
                } else {
                    $servicios = $servicios . ', ' .  $value;
                }
            }
            $arreglo = $request->servicio_adicional;




            foreach ($arreglo as $key => $value) {

                array_push($arrayServicios, $value);
            }



            foreach ($request->servicio_adicional as  $value) {

                if ($value == 'pagos_digitales') {
                    $pagos = 1;
                }
                if ($value == 'musica_vivo') {
                    $musica = 1;
                }
                if ($value == 'zona_wifi') {
                    $wifi = 1;
                }
                if ($value == 'ninguno') {
                    $ninguno = 1;
                }
                if ($value == 'otro') {
                    $otroServicio = 1;
                }
                if ($value == 'banio') {
                    $banio = 1;
                }
            }
        }
        $red_social = $request->social;


        $pasteleria = 2;
        $licores = 2;
        $comidas_rapidas = 2;
        $helados = 2;
        $otro =  2;

        if ($request->menu == 'pasteleria') {
            $pasteleria = 1;
        } else if ($request->menu == 'licores') {
            $licores = 1;
        } else if ($request->menu == 'comidas_rapidas') {
            $comidas_rapidas = 1;
        } else if ($request->menu == 'helados') {
            $helados = 1;
        } else if ($request->menu == 'otro') {
            $otro = 1;
        }


        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/cafe'
        ]);
        try {
            $red = DB::table('red_social')->where('fk_id_cafe', $id_cafe)->delete();

            foreach ($red_social as  $value) {
                $redesSociales = new RedSocial();
                $redesSociales->fk_id_cafe = $id_cafe;
                $redesSociales->link_red = $value;
                $redesSociales->save();
            }

            $response = '';
            $response = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/cafe/actualizar/' . $id_cafe . '/' . $id_menu . '/' . $id_servicio_adicional, [
                'json' => [

                    'nombre' =>  $request->nameCafe,
                    'direccion' =>  $request->inputAddress,
                    ' historia' => $request->historyCafe,
                    // 'telefono' =>  $request->inputPhone,
                    'horario_atencion' =>  $request->inputHorario,
                    'origen_cafe' => $request->origenCafe,
                    'pagina_web' =>  $request->paginaWeb,
                    // servicios adicionales
                    'pagos_digitales' => $pagos,
                    'musica_vivo' => $musica,
                    'banio' => $banio,
                    'zona_wifi' => $wifi,
                    'ninguno' => $ninguno,
                    'otro_servicio' => $otroServicio,
                    'servicios' => $servicios,
                    //menu
                    'menu' => $menu,
                    'pasteleria' => $pasteleria,
                    'licores' => $licores,
                    'comidas_rapidas' => $comidas_rapidas,
                    'helados' => $helados,
                    'otro' => $otro,



                ]
            ]);
            $body = $response->getBody();
            $arr_body = json_decode($body);








            // $red_social_consulta = DB::select('SELECT * FROM red_social WHERE fk_id_cafe = ' . $id_cafe);

            // foreach ($red_social as  $value) {
            //     $redesSociales = new RedSocial();
            //     $redesSociales->link_red = $value;
            //     $redesSociales->save();
            // }
        } catch (Exception $e) {
            Session::flash('mensajee', 'Error al actualizar el café! ' . $e->getMessage());
            return redirect('cafe');
        }
        Session::flash('mensaje', 'Café actualizado! ');
        return redirect('cafe');
    }

    public function actualizarRedes(Request $request, $id)
    {
        $red_social = $request->social;
        return $red_social;
        $red = DB::table('red_social')->where('fk_id_cafe', $id)->delete();


        foreach ($red_social as  $value) {
            $redesSociales = new RedSocial();
            $redesSociales->fk_id_cafe = $id;
            $redesSociales->link_red = $value;
            $redesSociales->save();
        }


        Session::flash('mensaje', 'Café actualizado! ');
        return redirect('cafe');
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
    public function destroy($id_cafe, $id_menu, $id_servicio)
    {
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/cafe'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $response = $client->request('DELETE', 'https://api.destinofusagasuga.gov.co/api/cafe/eliminar/' . $id_cafe . '/' . $id_menu . '/' . $id_servicio);

            //AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {
            Session::flash('mensajee', 'Error al eliminar el café! ' . $e->getMessage());
            return redirect('cafe');
        }
        Session::flash('mensaje', 'Café eliminado');
        return redirect('cafe');
    }
    public function elimnarRedView($id)
    {
        $redesSociales = DB::select('SELECT * from red_social WHERE fk_id_cafe = ' . $id);



        return view('cafe.eliminar_red', compact('redesSociales'));
    }
    public function eliminarRedSocial($id, $id_cafe)
    {

        $redesSociales = RedSocial::find($id);

        if ($redesSociales) {

            $redesSociales->delete();
        }

        return Redirect::back()->with('message', 'Operation Successful !');
    }
    public function registrarRed(Request $request, $id)
    {
        $red_social = $request->social;
        foreach ($red_social as  $value) {
            $redesSociales = new RedSocial();
            $redesSociales->fk_id_cafe = $id;
            $redesSociales->link_red = $value;
            $redesSociales->save();
        }
        return Redirect::back()->with('message', 'Operation Successful !');
    }
}