<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 =>
            array(
                'name' => 'IT Plus',
                'email' => 'admin@venus.com',
                'number' => '8619777091',
                'password' => '$2y$10$VcbOY0PSo8U62azgGWzuy.ExOInNMso0HpCpqXbr3BdMGadiC5qVe',
                'type' => 'Admin',
            ),
        ));
    }
}
