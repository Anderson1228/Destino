<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Hamburguesa;
use App\Models\Festival;
use App\Models\Voto;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class QrController extends Controller
{
    
    public function getElementoAsignado(Request $request){

      

     $hamburguesa = DB::table('hamburguesas')
    ->where('hamburguesas.id','=',$request->id)
    ->select('hamburguesas.*')
    ->first();
    // $voto = DB::table('votos')
    // ->where('votos.id','=',$request->id)
    // ->select('votos.*')
    // ->first();
    // $user = DB::table('users')
    // ->where('users.id_user','=',$request->id)
    // ->select('users.*')
    // ->first();

//dd('hola');
        $input = [];
        $input['id'] = $hamburguesa->id;
        $input['restaurante'] = $hamburguesa->restaurante;
        $input['nombre_hamburguesa'] = $hamburguesa->nombre_hamburguesa;
        $festival = Festival::create($input);
    

        //$data = "El Qr escaneado pertenece a un elemento: $usuarios->nombusuario, identificado con las placas: $usuarios->ndocumento";
        //dd($elementoinventario,$movimientoinv);

     
            return response()->json(
                [
                    'restaurante' => $hamburguesa->restaurante,
                    'nombre_hamburguesa'=> $hamburguesa->nombre_hamburguesa,


                ] 
                ,200,[]
            );
        }
        //validar id de elemento (que exista en DB)

        /**
         * hacer consultas de informacion que necesito con ese id
         *
         * retornar campos encontrados en formato JSON
         */


    }

