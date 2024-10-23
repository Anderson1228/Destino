<?php

namespace App\Http\Controllers;

use App\Models\General;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('imagenLogo', 'Logo guardado!');

        $request->validate([
            'imagenLogo' => 'required|image',

        ]);

       

            if ($request->hasFile('imagenLogo')) {
                
                $imagenLogo = $request->file('imagenLogo');
                $nombreArchivoLogo = uniqid() . $imagenLogo->getClientOriginalName();
                

                $client = new Client([

                    'base_uri' => 'https://api.destinofusagasuga.gov.co/api/logo'
                ]);
                try{

                    $client->request('POST', 'https://api.destinofusagasuga.gov.co/api/logo/registrar', [
                        'multipart' => [
                            [
                                'name' => 'link_logo',
                                'contents' =>  fopen($imagenLogo, 'r'),
                                'filename' => $nombreArchivoLogo,
                            ],
                        ],
                        ]);

                }catch (Exception $e) {
                    Session::flash('imagenLogo', 'NO  se logró guardar el logo!');
                    return redirect()->route('restaurante.index');
                  
                }

            }
            Session::flash('imagenLogo', 'Logo guardado!');

            return redirect()->route('restaurante.index');


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
        //
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
        //
    }
}
