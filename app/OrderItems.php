<?php

namespace App;

use App\Order;
use App\Product;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
	protected $guarded = [];

  public function order() {
  	return $this->belongsTo(Order::class);
  }

  public function products() {
  	return $this->hasMany(Product::class);
  }
}
