<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountProduct extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['id', 'type', 'price', 'finished_at', 'started_at', 'product_id', 'tprice'];
	public function product() {
		return $this->belongTo('App\Product', 'product_id');
	}
}
