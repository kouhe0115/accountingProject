<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->truncate();
        DB::table('orders')->insert([
            [
                'user_id'      => 1,
                'shop_id'      => 1,
                'order_name'   => 'ジントニック',
                'order_price'  => 1000,
                'date'         => Carbon::now(),
                'created_at'   => Carbon::now()
            ],
            [
                'user_id'      => 2,
                'shop_id'      => 1,
                'order_name'   => 'アリア',
                'order_price'  => 1300,
                'date'         => Carbon::now(),
                'created_at'   => Carbon::now()
            ],
            [
                'user_id'      => 3,
                'shop_id'      => 1,
                'order_name'   => 'ジンソニック',
                'order_price'  => 1000,
                'date'         => Carbon::now(),
                'created_at'   => Carbon::now()
            ]
        ]);

    }
}
