<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slideshow extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['title', 'url', 'image_link', 'description', 'weight', 'alt'];
}
