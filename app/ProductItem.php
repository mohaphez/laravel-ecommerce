<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductItem extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['name', 'items'];
	public function product() {
		return $this->hasMany('App\Product');
	}
}
