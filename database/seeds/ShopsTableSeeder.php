<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('shops')->truncate();
        DB::table('shops')->insert([
            [
                'name'          => 'c&d',
                'email'         => 'c&d@test.com',
                'password'      => Hash::make('11111111'),
                'address'       => '京都市下京区',
                'start_time'    => '17:00',
                'end_time'      => '03:00',
                'genre'         => 'ジン',
                'comment'       => 'ジンのお店',
                'seats'         => 11,
                'created_at'    => Carbon::now(),
            ],
            [
                'name'          => 'c&d2',
                'email'         => 'c&d2@test.com',
                'password'      => Hash::make('22222222'),
                'address'       => '京都市下京区',
                'start_time'    => '17:00',
                'end_time'      => '04:00',
                'genre'         => 'ジン',
                'comment'       => 'ジンのお店',
                'seats'         => 11,
                'created_at'    => Carbon::now(),
            ],
            [
                'name'          => 'c&d3',
                'email'         => 'c&d3@test.com',
                'password'      => Hash::make('33333333'),
                'address'       => '京都市下京区',
                'start_time'    => '17:00',
                'end_time'      => '05:00',
                'genre'         => 'ジン',
                'comment'       => 'ジンのお店',
                'seats'         => 11,
                'created_at'    => Carbon::now(),
            ]
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
