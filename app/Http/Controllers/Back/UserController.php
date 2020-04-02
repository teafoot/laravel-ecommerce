<?php

namespace App\Http\Controllers\Back;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function index() {
		$users = User::all();
		return view("admin.users.index", compact("users"));
	}

	public function show($id) {
		$user = User::find($id);
		$orders = Order::where("user_id", $id)->get();
		return view("admin.users.details", compact("orders", "user"));
	}

	public function block($id) {
		$user = User::find($id);
		$user->update([
			'status' => 0
		]);

		session()->flash('msg', 'User has been blocked.');

		return redirect()->back();
	}

	public function activate($id) {
		$user = User::find($id);
		$user->update([
			'status' => 1
		]);

		session()->flash('msg', 'User has been activated.');

		return redirect()->back();
	}
}
