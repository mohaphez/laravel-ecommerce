<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model {
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	public function product() {
		return $this->belongTo('App\Product');
	}
}
