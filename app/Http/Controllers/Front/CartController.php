<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
	public function index() {
		return view("front.cart.index");
	}

	public function store(Request $request) {
		$collection = Cart::instance("default")->search(function($cartItem, $rowId) use ($request) {
			return $cartItem->id === $request->id;
		});

		if ($collection->isNotEmpty()) {
			return redirect()->back()->with('msg', 'Item already exists in your cart.');
		}

		Cart::instance("default")->add($request->id, $request->name, 1, $request->price)->associate('App\Product');
		return redirect()->back()->with('msg', 'Item has been added to cart.');
	}

	public function saveForLater($id) {
		$item = Cart::instance("default")->get($id);
		Cart::instance("default")->remove($id);

		$collection = Cart::instance("saveForLater")->search(function($cartItem, $rowId) use ($item) {
			return $cartItem->id === $item->id;
		});

		if ($collection->isNotEmpty()) {
			return redirect()->back()->with('msg', 'Item already exists in your saved list.');
		}

		Cart::instance("saveForLater")->add($item->id, $item->name, $item->qty, $item->price)->associate('App\Product');
		return redirect()->back()->with('msg', 'Item has been saved for later.');
	}

	public function removeItem($id) {
		Cart::instance("default")->remove($id);

		return redirect()->back()->with('msg', 'Item has been removed from cart.');
	}

	public function update(Request $request) {
		$validator = Validator::make($request->all(), [
			'quantity' => 'required|numeric|between:1,5'
		]);

		if ($validator->fails()) {
			session()->flash('error', 'Quantity must be between 1 and 5.');
			return response()->json(['success' => false]);
		}

		Cart::update($request->row_id, $request->quantity);

		session()->flash('msg', 'Item quantity has been updated.');
		return response()->json(['success' => true]);
	}
}
