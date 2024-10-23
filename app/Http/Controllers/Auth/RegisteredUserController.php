<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use GuzzleHttp\Client;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'birthday' => ['required', 'string', 'max:10'],
            'documento'=> ['required',  'unique:users'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        
        $client = new Client([

            'base_uri' => 'http://192.168.20.47:8000/api/auth/register'
        ]);

        try {

            //SEND A NEW RESTAURANT
            $user = $client->request('POST', 'http://192.168.20.47:8000/api/auth/register', [
                'json' => [

                    
                         'nombre' => $request->name,
                    
                         'email' => $request->email,
                
                         'fecha_nacimiento' => $request->birthday,
                   
                         'documento' => $request->documento,
                    
                         'ciudad_residencia'=> $request->city,
                    
                         'password' => $request->password,

                         'tipo_usuario' => 1,
                    
                                    ]

            ]);
            event(new Registered($user));
            // AGREGAR VISTA DECENTE A ERROR DE DE CONEXION A LA API
        } catch (Exception $e) {

            return 'NO se registro' . $e->getMessage();
        }
        





    //    $user = User::create([
      //      'name' => $request->name,
        //    'email' => $request->email,
          //  'password' => Hash::make($request->password),
        //]);

      

        //PARA HACER LOGIN AUTOMATICAMENTE DESPUES DE REGISTRARSE
        //Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
