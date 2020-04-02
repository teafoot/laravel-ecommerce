<?php

namespace App;

use App\OrderItems;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = [];
	protected $dates = ["date"];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function orderItems() {
		return $this->hasMany(OrderItems::class);
	}

	public function products() {
		return $this->belongsToMany(Product::class, "order_items");
	}
}
