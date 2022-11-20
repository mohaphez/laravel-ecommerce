<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model {
	protected $table    = 'sub_menus';
	protected $fillable = ['name', 'id', 'menu_header_id'];
	protected $hidden = ["created_at", "updated_at","id","menu_header_id"];
	public function menuheader() {
		return $this->belongsTo('App\Menu');
	}
}
