<?php

use App\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			AdminUser::create([
				'id' => 1000,
				'name' => 'pedro',
				'email' => 'pedro@gmail.com',
				'password' => '$2y$10$kFOzGDN3h9fPrUZ7o6748.4vpHbY0l8OSR/dUiP2TPNET4r9FtMWa',
				'status' => 1
			]);
    }
}
