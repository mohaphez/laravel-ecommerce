<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiBasket extends Model
{
    protected $fillable = ['user_id', 'product_id', 'number'];
}
