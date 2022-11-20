<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuHeader extends Model {
	protected $table    = 'menu_headers';
	protected $fillable = ['name', 'id', 'menu_id'];
	protected $hidden = ["created_at", "updated_at","id","menu_id"];
	public function menu() {
		return $this->belongsTo('App\Menu');
	}

	public function submenu() {
		return $this->hasMany('App\SubMenu', 'menu_header_id');
	}
}
