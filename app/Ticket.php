<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Verta;

class Ticket extends Model {
	protected $fillable = [
		'title', 'body', 'status', 'user_id', 'code'
	];

	public function user() {
		return $this->belongsTo('App\User', 'user_id');
	}
	public function ticket_message() {
		return $this->hasMany('App\TicketMessage', 'ticket_id');
	}
	public function replydate() {
		$v = new Verta($this->updated_at);
		return $v->format('H:i Y-n-j');
	}
}
