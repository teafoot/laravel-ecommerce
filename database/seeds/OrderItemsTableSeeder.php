<?php

use App\OrderItems;
use App\Product;
use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$product_price1 = Product::find(1000)->price;
    	$product_price2 = Product::find(1001)->price;
    	$product_quantity = 2;

      OrderItems::create([
      	'id' => 1000,
      	'order_id' => 1000,
      	'product_id' => 1000,
      	'quantity' => $product_quantity,
      	'price' => $product_quantity * $product_price1
      ]);

      OrderItems::create([
      	'id' => 1001,
      	'order_id' => 1000,
      	'product_id' => 1001,
      	'quantity' => $product_quantity,
      	'price' => $product_quantity * $product_price2
      ]);

      OrderItems::create([
      	'id' => 1002,
      	'order_id' => 1001,
      	'product_id' => 1000,
      	'quantity' => $product_quantity,
      	'price' => $product_quantity * $product_price1
      ]);

      OrderItems::create([
      	'id' => 1003,
      	'order_id' => 1001,
      	'product_id' => 1001,
      	'quantity' => $product_quantity,
      	'price' => $product_quantity * $product_price2
      ]);
    }
}
