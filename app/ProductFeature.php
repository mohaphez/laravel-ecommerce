<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model {
	protected $dates    = ['deleted_at'];
	protected $fillable = ['item', 'value', 'product_id'];
	protected $hidden = ["created_at", "updated_at","id","product_id","deleted_at"];
	public function product() {
		return $this->belongTo('App\Product');
	}

}
