<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\User;
use App\Order;

class VisitorController extends Controller {
	public function index() {
		$visitors = User::all();
		return view('Admin.visitor.visitor', compact('visitors'));
	}
	public function user($id) {
		$user = User::findOrFail($id);
		$orders = Order::select('status','created_at','pay_method','id')->where('user_id',$id)->orderBy('status','ASC')->get();
		return view('Admin.visitor.user', compact('user','orders'));
	}
}
