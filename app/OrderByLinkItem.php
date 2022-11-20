<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderByLinkItem extends Model
{
    protected $fillable = [
		'id','orderByLink_id', 'link', 'number', 'description','status','cost','unitPrice','img','title'
	];

}
