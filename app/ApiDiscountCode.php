<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ApiDiscountCode extends Model
{
    protected $fillable = ['id', 'status', 'type', 'price', 'code', 'expire_at'];
}
