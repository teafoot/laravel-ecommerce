<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Routes
Route::prefix("admin")->group(function() {
	Route::middleware("auth:admin")->group(function() {
		// Dashboard
		Route::get("/" , "Back\DashboardController@index")->name("admin.home");

		// Products
		Route::resource("/products", "Back\ProductController");

		// Orders
		Route::resource("/orders", "Back\OrderController");
		Route::post("/orders/{order}/pending", "Back\OrderController@pending")->name("orders.pending");
		Route::post("/orders/{order}/confirm", "Back\OrderController@confirm")->name("orders.confirm");

		// Users
		Route::resource("/users", "Back\UserController");
		Route::post("/users/{user}/block", "Back\UserController@block")->name("users.block");
		Route::post("/users/{user}/activate", "Back\UserController@activate")->name("users.activate");

		Route::get("logout", "Back\AdminUserController@logout")->name("admin.logout");
	});

	// Admin Login
	Route::get("/login", "Back\AdminUserController@index")->name("admin.login");
	Route::post("/login", "Back\AdminUserController@store")->name("admin.login");
});

// Frontend Routes

// Home
Route::get("/", "Front\HomeController@index")->name("user.home");

// User Registration
Route::get("/user/register", "Front\RegistrationController@index")->name("user.register");
Route::post("/user/register", "Front\RegistrationController@store")->name("user.register");

// User Login/Logout
Route::get("/user/login", "Front\SessionsController@index")->name("user.login");
Route::post("/user/login", "Front\SessionsController@store")->name("user.login");
Route::get("/user/logout", "Front\SessionsController@logout")->name("user.logout");

// User Profile
Route::get("/user/profile", "Front\UserProfileController@index")->name("user.profile");
Route::get("/user/orders/{order}", "Front\UserProfileController@showOrder")->name("user.show_order");

// Cart
Route::get("/cart", "Front\CartController@index")->name("user.cart");
Route::post("/cart", "Front\CartController@store")->name("user.cart");

Route::put("/cart/{item}/update", "Front\CartController@update")->name("user.cart.item.update");
Route::post("/cart/{item}/save-for-later", "Front\CartController@saveForLater")->name("user.cart.item.save_for_later");
Route::delete("/cart/{item}/remove", "Front\CartController@removeItem")->name("user.cart.item.remove");

Route::get("/cart/empty", function() {
	Cart::instance('default')->destroy();
})->name("user.cart.empty");

// Save for Later List
Route::post("/saved-list/{item}/move-to-cart", "Front\SavedListController@moveToCart")->name("user.saved.item.move_to_cart");
Route::delete("/saved-list/{item}/remove", "Front\SavedListController@removeSavedItem")->name("user.saved.item.remove");

// Checkout
Route::group(['middleware' => 'auth.checkout'], function() {
	Route::get("/checkout", "Front\CheckoutController@index")->name("user.checkout");
	Route::post("/checkout", "Front\CheckoutController@store")->name("user.checkout");
});