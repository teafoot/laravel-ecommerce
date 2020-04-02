<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
	public function __construct() {
		$this->middleware('guest')->except('store', 'logout');
	}

	public function index() {
		return view("front.sessions.index");
	}

	public function store(Request $request) {
		$rules = [
			'email' => 'required|email',
			'password' => 'required'
		];
		$request->validate($rules);

		$data = request(['email', 'password']);
		if (!auth()->attempt($data)) {
			return back()->withErrors([
				'message' => 'Wrong credentials, please try again.'
			]);
		}

		return redirect(route('user.profile'));
	}

	public function logout() {
		auth()->logout();

		session()->flash("msg", "You have logged out successfully.");
		return redirect(route("user.login"));
	}
}
