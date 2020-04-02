<?php

namespace App;

use App\OrderItems;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function orderItems() {
    	return $this->belongsTo(OrderItems::class);
    }
}
