<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['id', 'description', 'color', 'product_id'];
	protected $hidden = ["created_at", "updated_at","product_id","deleted_at"];
	public function product() {
		return $this->belongTo('App\Product');
	}

}
