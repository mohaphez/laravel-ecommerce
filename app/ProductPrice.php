<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model {
	protected $fillable = ['price', 'product_id', 'marketer_price'];
	public function product() {
		return $this->belongTo('App\Product');
	}
}
