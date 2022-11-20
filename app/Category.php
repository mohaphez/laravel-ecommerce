<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
	use SoftDeletes;
	use Sluggable;
	use SluggableScopeHelpers;
	protected $dates    = ['deleted_at'];
	protected $table    = 'categories';
	protected $fillable = ['name', 'id'];
	public function sluggable() {
		return [
			'slug'    => [
				'source' => 'name'
			]
		];
	}
	public function subcategory() {
		return $this->hasMany('App\SubCategory', 'category_id');
	}

	public function product() {
		return $this->hasMany('App\Product', 'category_id');
	}
}
