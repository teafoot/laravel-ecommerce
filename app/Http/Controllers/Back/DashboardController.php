<?php

namespace App\Http\Controllers\Back;

use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function index() {
		$product = new Product;
		$user = new User;
		$order = new Order;

		return view("admin.dashboard", compact("product", "user", "order"));
	}
}
