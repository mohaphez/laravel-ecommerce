<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCode extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['id', 'user_id', 'status', 'type', 'price', 'code', 'expire_at'];
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
}
