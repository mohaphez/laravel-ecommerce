<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	protected $table    = 'menus';
	protected $fillable = ['name', 'id'];
	protected $hidden = ["created_at", "updated_at","id"];
	public function menuheader() {
		return $this->hasMany('App\MenuHeader', 'menu_id');
	}
}
