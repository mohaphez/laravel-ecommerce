<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductComment extends Model {
	use SoftDeletes;
	protected $dates    = ['deleted_at'];
	protected $table    = 'product_comments';
	protected $fillable = ['id', 'title', 'comment', 'reply_comment', 'like', 'user_id', 'product_id', 'reply_user_id', 'status'];
	protected $hidden = ["created_at", "updated_at","id","product_id","deleted_at"];

	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}

	public function user_reply() {
		return $this->belongsTo('App\User', 'reply_user_id');
	}

	public function product() {
		return $this->belongsTo('App\Product', 'product_id');
	}
}
