<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'title' => 'administrador',
        	'description' => 'Este usuario cuenta con permisos de super administrador'
        ]);

        DB::table('roles')->insert([
            'title' => 'editor',
            'description' => 'Este usuario cuenta con permisos para crear/editar/eliminar configuraciones de la sección Página Web.'
        ]);

        DB::table('roles')->insert([
            'title' => 'comprador',
            'description' => 'Este usuario cuenta con permisos para comprar dentro de la página web.'
        ]);

        DB::table('roles')->insert([
            'title' => 'blogger',
            'description' => 'Este usuario cuenta con permisos para crear/editar/eliminar los distintos posts que pertenecen al blog.'
        ]);
    }
}
