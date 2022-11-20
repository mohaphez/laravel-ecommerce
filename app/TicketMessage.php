<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $fillable = [
		'message', 'body', 'status', 'user_id', 'ticket_id','sender'
	];

	public function user() {
		return $this->belongsTo('App\User');
    }
    public function ticket() {
		return $this->belongsTo('App\Ticket', 'ticket_id');
	}
}
