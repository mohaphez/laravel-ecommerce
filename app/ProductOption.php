<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
	protected $fillable = [
		'product_id', 'name', 'value', 'price'
	];
    public function product() {
		return $this->belongTo('App\Product');
	}
}
