<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = [
		'name', 'address', 'codeposti', 'user_id','province_id','city_id'
	];
	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

	public function province() {
		return $this->belongsTo(Province::class);
	}
    public function city() {
		return $this->belongsTo(City::class);
	}
}
