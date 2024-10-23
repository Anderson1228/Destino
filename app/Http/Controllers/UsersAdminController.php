<?php

namespace App\Http\Controllers;
use GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//MOSTRAR TODOS LOS RESTAURANTES
        //link del api
        try {

                $users = HTTP::get('https://api.destinofusagasuga.gov.co/api/usuarios');
            //pasamos los datos a un arreglo
    
            $usersArray = $users->json();
                 
            //pasamos el arreglo a la vista
            return view ('adminUser.index' , compact('usersArray'));
    
            
            
        } catch (\Throwable $th) {
            Session::flash('mensaje', 'No se logró cargar la informacion de los usuarios');
            return view ('adminUser.index');
            
        }
       


       
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
    public function edit($id_user)
    {
        
        $user = HTTP::get('https://api.destinofusagasuga.gov.co/api/usuarios/user/'.$id_user);
        //pasamos los datos a un arreglo
        $responseUser = $user->json();

        //pasamos el arreglo a la vista
        $responseu = $responseUser['informacion'];


        
   
        // foreach ($response as $value) {
        //     foreach ($value['ruta'] as $value) {
        //         return ($value['id_ruta']);
        //     }
          
        // }
      
        return view('adminUser.edit', compact('responseu'));
    }

    public function actualizar (Request $request, $id_user){

                
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthday' => ['required', 'string', 'max:10'],
            'documento'=> ['required',  'unique:users'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        
        $client = new Client([

            'base_uri' => 'https://api.destinofusagasuga.gov.co/api/usuarios'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $user = $client->request('PUT', 'https://api.destinofusagasuga.gov.co/api/usuarios/actualizar/'.$id_user, [
                'json' => [

                    
                         'nombre' => $request->name,
                    
                         'email' => $request->email,
                
                         'fecha_nacimiento' => $request->birthday,
                   
                          'documento' => $request->documento,
                    
                         'ciudad_residencia'=> $request->city,

                         //'password' => $request->password,
                    
                                    ]

            ]);
            event(new Registered($user));
            // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {
            Session::flash('mensaje', 'Error al actualizar el usuario! ');
            return redirect ('users_admin');
        }

        Session::flash('mensaje', 'Usuario actualizado! ');
            return redirect ('users_admin');
        




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
        $client = new Client ([

                'base_uri' => 'https://api.destinofusagasuga.gov.co/api/usuarios'
        ]);
        try {
            $user = $client->request('DELETE' , 'https://api.destinofusagasuga.gov.co/api/usuarios/eliminar/'.$id ,[

                

            ]);

        } catch (\Throwable $th) {
            Session::flash('mensaje', 'Error al eliminar el usuario!');
            return redirect ('users_admin');
       
           

        }
        Session::flash('mensaje', 'Usuario eliminado!');
        return redirect ('users_admin');

    }
}
