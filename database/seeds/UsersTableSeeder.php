<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'          => 'test',
                'email'         => 'test@test.com',
                'password'       => Hash::make('11111111'),
                'remember_token' => str_random(10),
                'created_at'    => Carbon::now(),
            ],
            [
                'name'          => 'test2',
                'email'         => 'test2@test.com',
                'password'       => Hash::make('22222222'),
                'remember_token' => str_random(10),
                'created_at'    => Carbon::now(),
            ],
            [
                'name'          => 'test3',
                'email'         => 'test3@test.com',
                'password'       => Hash::make('33333333'),
                'remember_token' => str_random(10),
                'created_at'    => Carbon::now(),
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
