<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
	protected $fillable = ['prefix', 'name', 'logo', 'status', 'disable_message', 'description', 'admin_email', 'contact_number', 'contact_email', 'contact_address', 'google_code', 'alexa_code', 'analytics_code', 'setad_code', 'etemad_code', 'senf_code', 'keyword'];
}
