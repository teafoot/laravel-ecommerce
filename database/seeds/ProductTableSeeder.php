<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Product::create([
      	'id' => 1000,
      	'name' => 'Nike shoe',
      	'description' => 'Brand new',
      	'image' => '001_pexels-photo.jpg',
      	'price' => 100,
      ]);

      Product::create([
      	'id' => 1001,
      	'name' => 'Adidas shoe',
      	'description' => 'Brand new',
      	'image' => 'boot-leather-shoe-old-60619.jpeg',
      	'price' => 200,
      ]);
    }
}
