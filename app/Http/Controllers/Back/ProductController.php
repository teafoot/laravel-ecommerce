<?php

namespace App\Http\Controllers\Back;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
	public function index() {
		$products = Product::all();
		return view("admin.products.index", compact("products"));
	}

	public function create() {
		$product = new Product;
		return view("admin.products.create", compact("product"));
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required',
			'price' => 'required|numeric',
			'description' => 'required',
			'image' => 'image|required'
		]);

		if ($request->hasFile('image')) {
			$image = $request->image;
			$image->move('backend/uploads', $image->getClientOriginalName());
		}

		Product::create([
			'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description,
			'image' => $request->image->getClientOriginalName()
		]);

		$request->session()->flash('msg', 'Your product has been added.');

		return redirect(route('products.index'));
  }

  public function show($id) {
  	$product = Product::find($id);	
		return view("admin.products.details", compact("product"));
  }

  public function edit($id) {
  	$product = Product::find($id);
  	return view("admin.products.edit", compact("product"));
  }

  public function update(Request $request, $id) {
  	$product = Product::find($id);

  	$request->validate([
  		"name" => "required",
  		"price" => "required",
  		"description" => "required"
  	]);

  	if ($request->hasFile("image")) {
  		if (file_exists(public_path("/backend/uploads/") . $product->image) && $product->image != '') {
  			unlink(public_path("/backend/uploads/") . $product->image);
  		}

  		$request->image->move("backend/uploads", $request->image->getClientOriginalName());
  		$product->image = $request->image->getClientOriginalName();
  	}

  	$product->update([
  		'name' => $request->name,
			'price' => $request->price,
			'description' => $request->description,
			'image' => $product->image
  	]);

  	$request->session()->flash("msg", "Product has been updated.");

  	return redirect(route('products.index'));
  }

  public function destroy($id) {
  	$product = Product::find($id);

  	if (file_exists(public_path("/backend/uploads/") . $product->image) && $product->image != '') {
			unlink(public_path("/backend/uploads/") . $product->image);
		}

  	Product::destroy($id);

  	session()->flash("msg", "Product has been deleted.");

  	return redirect(route('products.index'));
  }
}
