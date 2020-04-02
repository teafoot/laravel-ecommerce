<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
	public function __construct() {
		$this->middleware('guest')->except('store');
	}

	public function index() {
		return view("front.registration.index");
	}

	public function store(Request $request) {
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
			'address' => 'required'
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'address' => $request->address,
			'status' => 1
		]);

		auth()->login($user);

		return redirect(route("user.profile"));
	}
}
