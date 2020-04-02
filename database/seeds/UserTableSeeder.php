<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'id' => 1000,
    		'name' => 'kevin',
				'email' => 'kevin@gmail.com',
				'password' => '$2y$10$kFOzGDN3h9fPrUZ7o6748.4vpHbY0l8OSR/dUiP2TPNET4r9FtMWa',
				'status' => 1
    	]);
    }
}
