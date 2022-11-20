<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;

use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
 
class SubCategory extends Model {

	use Sluggable;
	use SluggableScopeHelpers;
	protected $dates    = ['deleted_at'];
	protected $fillable = ['name', 'slug', 'category_id'];
	public function sluggable() {
		return [
			'slug'    => [
				'source' => 'name'
			]
		];
	}
	public function category() {
		return $this->belongsTo('App\Category');
	}
	public function product() {
		return $this->hasMany('App\Product', 'subcategory_id');
	}
}
