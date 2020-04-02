<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItems;
use Carbon\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	public function __construct() {
		$this->middleware("auth.checkout");
	}

	public function index() {
		return view("front.checkout.index");
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'address' => 'required',
			'city' => 'required',
			'province' => 'required',
			'postal' => 'required',
			'phone' => 'required',
			'name_card' => 'required'
		]);

		$contents = Cart::instance('default')->content()->map(function($item) {
			return 'NAME: ' . $item->model->name . ' QUANTITY: ' . $item->qty;
		})->values()->toJson();
		$cart_total = Cart::instance('default')->total();
		$cart_quantity = Cart::instance('default')->count();

		if ($cart_total > 0) {
			Stripe::charges()->create([
		    'amount' => $cart_total,
		    'currency' => 'USD',
		    'source' => $request->stripeToken,
		    'description' => '',
		    'metadata' => [
		    	'contents' => $contents,
		    	'quantity' => $cart_quantity
		    ]
			]);

			// Insert into orders and order items table
			$order = Order::create([
				'user_id' => auth()->user()->id,
				'date' => Carbon::now(),
				'address' => $request->address,
				'status' => 0
			]);

			foreach (Cart::instance('default')->content() as $item) {
				$total_price = $item->price * $item->qty;
				OrderItems::create([
					'order_id' => $order->id,
					'product_id' => $item->model->id,
					'quantity' => $item->qty,
					'price' => $total_price
				]);
			}

			Cart::instance('default')->destroy();

			return redirect()->back()->with("msg", "Order has been processed successfully.");
		}
	}
}
