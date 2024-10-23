<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([

            
            'nombre' => 'Admin',
            'email' => 'admin@admin.com',
            'fecha_nacimiento' => '1998-02-17',
            'documento' => '111111',
            'ciudad_residencia' => 'Fusagasugá',
            'tipo_usuario' => '1',
            'password' => bcrypt('Admin123'),
         

           

        ]);
    }
}
//php artisan db:seed --class=AdminSeeder