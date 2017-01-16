<?php

use Illuminate\Database\Seeder;
use Sisventas\User;
use Illuminate\Support\Facades\DB;

class SemillaUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
        	'name'=>'Sergio Alejandro Herrera',
        	'email'=>'sergioaleg_34@hotmail.com',
        	'password'=> bcrypt('amaterasu9404'),
        	]);
    }
}
