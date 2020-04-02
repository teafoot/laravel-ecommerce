<?php

namespace App\Http\Controllers\Back;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	public function index() {
		$orders = Order::all();
		return view("admin.orders.index", compact("orders"));
	}

	public function show($id) {
		$order = Order::find($id);
		return view("admin.orders.details", compact("order"));
	}

	public function pending($id) {
		$order = Order::find($id);
		$order->update([
			'status' => 0
		]);

		session()->flash('msg', 'Order has been set to pending.');

		return redirect()->back();
	}

	public function confirm($id) {
		$order = Order::find($id);
		$order->update([
			'status' => 1
		]);

		session()->flash('msg', 'Order has been set to confirmed.');

		return redirect()->back();
	}
}
