<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderByLink extends Model
{
    protected $fillable = [
		'id','user_id', 'address_id', 'phone', 'sendType','optionType','status','payStatus','cost','discount','trackingCode','payment_id','postCost'
	];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function address() {
		return $this->belongsTo(Address::class);
	}

}
