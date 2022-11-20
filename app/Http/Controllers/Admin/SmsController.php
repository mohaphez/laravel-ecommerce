<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Smsir;

class SmsController extends Controller {
	/**
	 * [send_show show send sms form]
	 * @return [type] [description]
	 */
	public function send_show() {
		return view('vendor.smsir.sms-send');
	}
	/**
	 * [add_group description]
	 */
	public function add_group() {
		return view('vendor.smsir.sms-add-group');
	}
	/**
	 * [send_group_show description]
	 * @return [type] [description]
	 */
	public function send_group_show() {
		return view('vendor.smsir.sms-send-group');
	}
	/**
	 * [send_sms description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function send_sms(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'mobile' => 'required',
					'text'   => 'required'
				]);
		}
		$mobiles = explode("-", $request['mobile']);
		foreach ($mobiles as $mobile) {
			Smsir::send($request['text'], $mobile);
		}
	}
	/**
	 * [add_group_store description]
	 * @param Request $request [description]
	 */
	public function add_group_store(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'name'   => 'required',
					'family' => 'required',
					'mobile' => 'required',
				]);
			Smsir::addToCustomerClub($request['sex'], $request['name'], $request['family'], $request['mobile']);
		}
	}
	/**
	 * [send_group_sms description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function send_group_sms(Request $request) {
		if ($request->ajax()) {
			$this->validate($request, [
					'text' => 'required',
				]);
			sendToCustomerClub($request['text']);
		}

	}
}
