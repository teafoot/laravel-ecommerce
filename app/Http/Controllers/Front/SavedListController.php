<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SavedListController extends Controller
{
	public function moveToCart($id) {
		$item = Cart::instance("saveForLater")->get($id);
		Cart::instance("saveForLater")->remove($id);

		$collection = Cart::instance("default")->search(function($cartItem, $rowId) use ($item) {
			return $cartItem->id === $item->id;
		});

		if ($collection->isNotEmpty()) {
			return redirect()->back()->with('msg', 'Item already exists in cart.');
		}

		Cart::instance("default")->add($item->id, $item->name, $item->qty, $item->price)->associate('App\Product');
		return redirect()->back()->with('msg', 'Item has been moved to cart.');
	}

	public function removeSavedItem($id) {
		Cart::instance("saveForLater")->remove($id);

		return redirect()->back()->with('msg', 'Item has been removed from saved list.');
	}
}
