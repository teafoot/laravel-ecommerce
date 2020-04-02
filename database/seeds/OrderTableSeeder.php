<?php

use App\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Order::create([
      	'id' => 1000,
      	'user_id' => 1000,
      	'date' => Carbon::today(),
      	'address' => 'street 1',
      	'status' => 0
      ]);

      Order::create([
      	'id' => 1001,
      	'user_id' => 1000,
      	'date' => Carbon::today(),
      	'address' => 'street 1',
      	'status' => 0
      ]);
    }
}
