<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
	public function __construct() {
		$this->middleware('guest:admin')->except('logout');
	}

	public function index() {
		return view('admin.login');
	}

	public function store(Request $request) {
		$request->validate([
			'email' => 'required|email',
			'password' => 'required'
		]);

		$credentials = $request->only('email', 'password');
		if (!Auth::guard('admin')->attempt($credentials)) {
			return back()->withErrors([
				'message' => 'Wrong credentials, please try again.'
			]);
		}

		session()->flash('msg', 'You have been logged in.');
		return redirect(route('admin.home'));
	}

	public function logout() {
		auth()->guard('admin')->logout();

		session()->flash('msg', 'You have been logged out.');
		return redirect(route('admin.login'));
	}
}
