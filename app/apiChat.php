<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class apiChat extends Model
{
	protected $fillable = [
		'user_id', 'txt', 'sender', 'read'
	];
    public function user() {
		return $this->belongsTo('App\User');
	} 
}
