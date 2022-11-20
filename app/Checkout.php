<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
		'cartNum','shaba','name','price','status','refId'
	];
}
