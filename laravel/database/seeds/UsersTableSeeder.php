<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //Insertion des info user pour simplifier le developement de l'app
        DB::table('users')->insert(
            array(
                'name' => 'alain',
                'email' => 'alain@a.com',
                'photo' => 'alain.jpg',
                'password' => '$2y$10$sCEgrZke8uedGVZOrYJ/U.xIGQEAxjpw9BBZBHWFtfOoD/lXIboFO',
                'telephone' => '5145551234'
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'caroline',
                'email' => 'caroline@a.com',
                'photo' => 'caroline.jpg',
                'password' => '$2y$10$sCEgrZke8uedGVZOrYJ/U.xIGQEAxjpw9BBZBHWFtfOoD/lXIboFO',
                'telephone' => '5145554567'
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'mathieu',
                'email' => 'mathieu@a.com',
                'photo' => 'mathieu.jpg',
                'password' => '$2y$10$NfqJ9GkVhAIzCV2/jehjz.9FCp5nn7XvekDaD1hvNY3FoA3Q.fQOe',
                'telephone' => '5145556789'
            )
        );
    }
}
