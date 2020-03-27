<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SlipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slips')->truncate();
        DB::table('slips')->insert([
            [
                'user_id'      => 1,
                'shop_id'      => 1,
                'start_time'   => '17:00',
                'end_time'     => '03:00',
                'is_visit'     => 0,
                'date'         => Carbon::now(),
            ],
            [
                'user_id'      => 1,
                'shop_id'      => 1,
                'start_time'   => '17:00',
                'end_time'     => '03:00',
                'is_visit'     => 0,
                'date'         => Carbon::now(),
            ],
            [
                'user_id'      => 1,
                'shop_id'      => 1,
                'start_time'   => '17:00',
                'end_time'     => '03:00',
                'is_visit'     => 0,
                'date'         => Carbon::now(),
            ]
        ]);

    }
}
