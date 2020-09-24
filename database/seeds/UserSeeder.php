<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name' => 'Administrador',
        	'email' => 'admin@admin.com',
            'apellido' => 'admin',
            'phone' => '000',
        	'password' => Hash::make('admin'),
        	'role_id' => 1,
            'cms' => 1,
        ]);
    }
}
